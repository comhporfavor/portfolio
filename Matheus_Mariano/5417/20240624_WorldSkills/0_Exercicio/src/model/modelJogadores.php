<?php
    require_once 'connection.php';
    
    class Jogador {
        function addJogador($numFed, $nomeJog, $idadeJog, $moradaJog, $emailJog, $telJog, $clube, $fotoJog){
            global $conn;
            $msg = "";
            $sql = "";
            $resp = $this -> uploads($fotoJog);
            $resp = json_decode($resp, TRUE);
            if($resp['flag']){
                $sql = "INSERT INTO jogadores (numFed, nomeJog, idadeJog, moradaJog, emailJog, telJog, clube, fotoJog) 
                VALUES ('".$numFed."', '".$nomeJog."', '".$idadeJog."', '".$moradaJog."', '".$emailJog."', '".$telJog."', '".$clube."', '".$resp['target']."');";           
            }else{
                $sql = "INSERT INTO jogadores (numFed, nomeJog, idadeJog, moradaJog, emailJog, telJog, clube) 
                VALUES ('".$numFed."', '".$nomeJog."', '".$idadeJog."', '".$moradaJog."', '".$emailJog."', '".$telJog."', '".$clube."');";
            }    
            if ($conn->query($sql) === TRUE) {
            $msg = "Registo efetuado com sucesso.";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
            return $msg;
        }

        function listarJogadores(){
            global $conn;
            $msg = "";
            $sql = "SELECT * FROM jogadores, clubes WHERE jogadores.clube = clubes.idClube";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['numFed']."</th>";
                $msg .= "<td><img class='logoClube' src='".$row['logotipo']."'></td>";
                $msg .= "<td class='d-none'>".$row['nomeClube']."</td>";
                $msg .= "<td><img class='logoClube' src='".$row['fotoJog']."'></td>";
                $msg .= "<td>".$row['nomeJog']."</td>";
                $msg .= "<td>".$row['idadeJog']."</td>";
                $msg .= "<td>".$row['moradaJog']."</td>";
                $msg .= "<td>".$row['emailJog']."</td>";
                $msg .= "<td>".$row['telJog']."</td>";
                $msg .= "<td><button type='button' class='btn btn-danger' onclick ='removerJogador(".$row['numFed'].")'>Remover</button></td>";
                $msg .= "<td><button type='button' class='btn btn-primary' onclick ='getDadosJogador(".$row['numFed'].")'>Editar</button></td>";
                $msg .= "</tr>";
            }
            } else {
                $msg .= "<tr>";
                $msg .= "<caption scope='row'><strong>Sem resultados</strong></caption>";
                $msg .= "</tr>";
            }
            $conn->close();
            return $msg;
        }
        
        function removerJogador($numFed){
            global $conn;
            $msg = "";
            $sql = "DELETE FROM jogadores WHERE numFed = '".$numFed."';";
            if ($conn->query($sql) === TRUE) {
            $msg = "Removido com sucesso";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
            return $msg;
        }

        function getDadosJogador($numFed){
            global $conn;
            $sql = "SELECT * FROM jogadores WHERE numFed =".$numFed.";";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $conn->close();
            return json_encode($row);
        }

        function guardaEdicaoJogador($oldNumFed, $newNumFed, $nomeJog, $idadeJog, $moradaJog, $emailJog, $telJog, $clube, $fotoJog){
            global $conn;
            $msg = "";
            $sql = "";
            $resp = $this -> uploads($fotoJog);
            $resp = json_decode($resp, TRUE);
            if($resp['flag']){
                $sql = "UPDATE jogadores SET  (numFed, nomeJog, idadeJog, moradaJog, emailJog, telJog, clube, fotoJog) 
                VALUES ('".$newNumFed."', '".$nomeJog."', '".$idadeJog."', '".$moradaJog."', '".$emailJog."', '".$telJog."', '".$clube."', '".$resp['target']."')
                WHERE numFed =".$oldNumFed.";";           
            }else{
                $sql = "UPDATE jogadores SET  (numFed, nomeJog, idadeJog, moradaJog, emailJog, telJog, clube) 
                VALUES ('".$newNumFed."', '".$nomeJog."', '".$idadeJog."', '".$moradaJog."', '".$emailJog."', '".$telJog."', '".$clube."')
                WHERE numFed =".$oldNumFed.";";
            } 
            if ($conn->query($sql) === TRUE) {
            $msg = "Edição efetuada";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
            return $msg;
        }

        function uploads($fotoJog){
            $dir = "../imagens/";
            $dir1 = "src/imagens/";
            $flag = false;
            $targetBD = "";
            if(!is_dir($dir)){
                if(!mkdir($dir, 0777, TRUE)){
                    die ("Erro não é possivel criar o diretório");
                }
            }
            if(array_key_exists('fotoJog', $fotoJog)){
                if(is_array($fotoJog)){
                    if(is_uploaded_file($fotoJog['fotoJog']['tmp_name'])){
                        $fonte = $fotoJog['fotoJog']['tmp_name'];
                        $ficheiro = $fotoJog['fotoJog']['name'];
                        $end = explode(".",$ficheiro);
                        $extensao = end($end);       
                        $newName ="fotoJog".date("YmdHis").".".$extensao;       
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
    }
?>