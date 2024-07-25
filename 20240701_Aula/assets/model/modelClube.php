<?php

require_once 'connection.php';

class Clube{

    function registaClube($nome, $anoFundacao, $tel, $email, $localidade, $logo){

        global $conn;
        $msg = "";
        $flag = true;

            $sql = "INSERT INTO clubes (anoF, email, nome, localidade, telefone) VALUES ('".$anoFundacao."', '".$email."','".$nome."','".$localidade."','".$tel."')";

            if ($conn->query($sql) === TRUE) {
                $id = mysqli_insert_id($conn);
                $resp = $this ->  uploads($logo, $id);
                $resp = json_decode($resp, TRUE);

                if($resp['flag']){
                    $resUpdate = $this -> updateLogo($resp['target'], $id);
                    
                    $resUpdate = json_decode($resUpdate, TRUE);

                    $msg = $resUpdate['msg'];

                }else{
                    $msg = "Registado com Sucesso mas sem logotipo";
                }

                
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

    function updateLogo($diretorio, $id){
        global $conn;
        $msg = "";
        $flag = true;

        $sql = "UPDATE clubes SET logo = '".$diretorio."' WHERE id = ".$id;

        if ($conn->query($sql) === TRUE) {
            $msg = "Registado com Sucesso";
        } else {
            $flag = false;
            $msg = "Error: " . $sql . "<br>" . $conn->error;
        }

        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));

        return($resp);
    }

    function getListaClubes(){

        global $conn;
        $msg = "";
        session_start();

        $sql = "SELECT * FROM clubes";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'><img class='img-thumbnail' src='".$row['logo']."'></th>";
                $msg .= "<th scope='row'>".$row['anoF']."</th>";
                $msg .= "<td>".$row['nome']."</td>";
                $msg .= "<td>".$row['email']."</td>";
                $msg .= "<td>".$row['telefone']."</td>";
                $msg .= "<td>".$row['localidade']."</td>";
                $msg .= "<td><button class='btn btn-warning' onclick ='getDadosClube(".$row['id'].")'><i class='fa fa-pencil'></i></button></td>";
                if($_SESSION['tipo']==1){
                    $msg .= "<td><button class='btn btn-danger' onclick ='removerClube(".$row['id'].")'><i class='fa fa-trash'></i></button></td>";
                }else{
                    $msg .= "<td>sem permissao</td>";
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
            $msg .= "</tr>";
        }
        $conn->close();

        return ($msg);
    }

    function removeClube($id){
        global $conn;
        $msg = "";
        $flag = true;

        $sql = "DELETE FROM clubes WHERE id = ".$id;

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

    function getDadosClube($id){
        global $conn;
        $msg = "";
        $row = "";

        $sql = "SELECT * FROM clubes WHERE id =".$id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            $row = $result->fetch_assoc();
        }

        $conn->close();

        return (json_encode($row));

    }


    function guardaEditClube($nome, $anoFundacao, $tel, $email, $localidade, $id, $logo){
        
        global $conn;
        $msg = "";
        $flag = true;
        $sql = "";

        $resp = $this -> uploads($logo, $id);
        $resp = json_decode($resp, TRUE);

        if($resp['flag']){
            $sql = "UPDATE clubes SET nome = '".$nome."', anoF = '".$anoFundacao."',telefone = '".$tel."',email = '".$email."',localidade = '".$localidade."', logo = '".$resp['target']."' WHERE id =".$id;
        }else{
            $sql = "UPDATE clubes SET nome = '".$nome."', anoF = '".$anoFundacao."',telefone = '".$tel."',email = '".$email."',localidade = '".$localidade."' WHERE id =".$id;
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

    function getSelectClube(){
        global $conn;
        $msg = "<option selected>Escolha um Clube</option>";

        $sql = "SELECT id, nome FROM clubes";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<option value='".$row['id']."'>".$row['nome']."</option>"; 
            }
        } else {
            $msg = "<option value='-1'>Sem Clubes registados</option>"; 

        }
        $conn->close();

        return ($msg);
    }



    function uploads($img, $id){

        $dir = "../imagens/clube".$id."/";
        $dir1 = "assets/imagens/clube".$id."/";
        $flag = false;
        $targetBD = "";
    
        if(!is_dir($dir)){
            if(!mkdir($dir, 0777, TRUE)){
                die ("Erro não é possivel criar o diretório");
            }
        }
      if(array_key_exists('logotipo', $img)){
        if(is_array($img)){
          if(is_uploaded_file($img['logotipo']['tmp_name'])){
            $fonte = $img['logotipo']['tmp_name'];
            $ficheiro = $img['logotipo']['name'];
            $end = explode(".",$ficheiro);
            $extensao = end($end);
    
            $newName = "clube".date("YmdHis").".".$extensao;
    
            $target = $dir.$newName;
            $targetBD = $dir1.$newName;
    
            $flag = move_uploaded_file($fonte, $target);
            
          } 
        }
      }
        return (json_encode(array(
          "flag" => $flag,
          "target" => $targetBD
        )));
    
    
    }
}


?>