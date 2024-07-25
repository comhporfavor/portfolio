<?php

require_once 'connection.php';

class Jogador{

    function registaJogador($numJogador, $nome, $idade, $telefone, $email, $morada, $clube, $foto){
    
        global $conn;
        $msg = "";
        $flag = true;
        $sql = "";

        $resp = $this -> uploads($foto, $clube, $numJogador);
        $resp = json_decode($resp, TRUE);

        if($resp['flag']){
            $sql = "INSERT INTO jogadores (num, nome, email, idade, morada, tel, idclube, foto) VALUES ('".$numJogador."', '".$nome."','".$email."','".$idade."','".$morada."','".$telefone."','".$clube."','".$resp['target']."')";
        }else{
            $sql = "INSERT INTO jogadores (num, nome, email, idade, morada, tel, idclube) VALUES ('".$numJogador."', '".$nome."','".$email."','".$idade."','".$morada."','".$telefone."','".$clube."')";
        }

        if ($conn->query($sql) === TRUE) {
            $msg = "Registado com sucesso!";
        } else {
            $flag = false;
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            $this -> wFicheiroError(date("Y-m-d H:i:s")." - ".$conn->error);
        }
       

        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));
          
        $conn->close();

        return($resp);

    }

    function getListaJogadores(){

        global $conn;
        $msg = "";
        session_start();

        $sql = "SELECT jogadores.*, clubes.nome as clubeJogador FROM jogadores, clubes WHERE jogadores.idclube = clubes.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['num']."</th>";
                $msg .= "<th scope='row'><img class='img-thumbnail' src='".$row['foto']."'></th>";
                $msg .= "<th scope='row'>".$row['nome']."</th>";
                $msg .= "<td>".$row['email']."</td>";
                $msg .= "<td>".$row['tel']."</td>";
                $msg .= "<td>".$row['morada']."</td>";
                $msg .= "<td>".$row['clubeJogador']."</td>";
                $msg .= "<td>".$row['idade']."</td>";
                $msg .= "<td><button class='btn btn-warning' onclick ='getDadosJogador(".$row['num'].")'><i class='fa fa-pencil'></i></button></td>";
                if($_SESSION['tipo'] == 1){
                    $msg .= "<td><button class='btn btn-danger' onclick ='removerJogador(".$row['num'].")'><i class='fa fa-trash'></i></button></td>";
                }else{
                    $msg .= "<td><button class='btn btn-secondary' onclick ='erroPermissao()'><i class='fa fa-trash'></i></button></td>";
                }
                $msg .= "</tr>";
            }
        } else {
            $msg .= "<tr>";
            $msg .= "<td>Sem Registos</td>";
            $msg .= "<th scope='row'></th>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "</tr>";
        }
        $conn->close();

        return ($msg);
    }

    function removerJogador($num){
        global $conn;
        $msg = "";
        $flag = true;

        $sql = "DELETE FROM jogadores WHERE num = ".$num;

        if ($conn->query($sql) === TRUE) {
            $msg = "Removido com Sucesso";
        } else {
            $flag = false;
            $msg = "Error: " . $sql . "<br>" . $conn->error;
        }

        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));
          
        $conn->close();

        return($resp);
    }

    function getDadosJogador($num){
        global $conn;
        $msg = "";
        $row = "";

        $sql = "SELECT * FROM jogadores WHERE num =".$num;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            $row = $result->fetch_assoc();
        }

        $conn->close();

        return (json_encode($row));

    }


    function guardaEditJogador($numJogador, $nome, $idade, $telefone, $email, $morada, $clube, $numOld, $foto){
        
        global $conn;
        $msg = "";
        $flag = true;
        $sql = "";

        $resp = $this -> uploads($foto, $clube, $numJogador);
        $resp = json_decode($resp, TRUE);

        if($resp['flag']){
            $sql = "UPDATE jogadores SET num = '".$numJogador."',nome = '".$nome."', idade = '".$idade."',tel = '".$telefone."',email = '".$email."',morada = '".$morada."', foto = '".$resp['target']."' WHERE num =".$numOld;
        }else{
            $sql = "UPDATE jogadores SET num = '".$numJogador."',nome = '".$nome."', idade = '".$idade."',tel = '".$telefone."',email = '".$email."',morada = '".$morada."' WHERE num =".$numOld;

        }

        if ($conn->query($sql) === TRUE) {
            $msg = "Editado com Sucesso";
        } else {
            $flag = false;
            $msg = "Error: " . $sql . "<br>" . $conn->error;
        }

        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));
          
        $conn->close();

        return($resp);

    }


    function uploads($img, $idclube, $num){

        $dir = "../imagens/clube".$idclube."/jogadores/";
        $dir1 = "assets/imagens/clube".$idclube."/jogadores/";
        $flag = false;
        $targetBD = "";
    
        if(!is_dir($dir)){
            if(!mkdir($dir, 0777, TRUE)){
                die ("Erro não é possivel criar o diretório");
            }
        }
      if(array_key_exists('foto', $img)){
        if(is_array($img)){
          if(is_uploaded_file($img['foto']['tmp_name'])){
            $fonte = $img['foto']['tmp_name'];
            $ficheiro = $img['foto']['name'];
            $end = explode(".",$ficheiro);
            $extensao = end($end);
    
            $newName = $num."_jogador".date("YmdHis").".".$extensao;
    
            $target = $dir.$newName;
            $targetBD = $dir1.$newName;

            $this -> wFicheiro($target);
    
            $flag = move_uploaded_file($fonte, $target);
            
          } 
        }
      }
        return (json_encode(array(
          "flag" => $flag,
          "target" => $targetBD
        )));
    
    
    }

    function wFicheiro($texto){
        $file = '../logs.txt';
        // Open the file to get existing content
        $current = file_get_contents($file);
        // Append a new person to the file
        $current .= $texto."\n";
        // Write the contents back to the file
        file_put_contents($file, $current);
    }

    function wFicheiroError($texto){
        $file = '../error.txt';
        // Open the file to get existing content
        $current = file_get_contents($file);
        // Append a new person to the file
        $current .= $texto."\n";
        // Write the contents back to the file
        file_put_contents($file, $current);
    }
}


?>