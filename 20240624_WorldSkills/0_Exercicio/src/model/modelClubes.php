<?php
    require_once 'connection.php';
    
    class Clube{
        function addClube($nomeClube, $localClube, $emailClube, $anoFund, $telClube, $logotipo){
            global $conn;
            $msg = "";
            $sql = "";
            $resp = $this -> uploads($logotipo);
            $resp = json_decode($resp, TRUE);
            if($resp['flag']){
                $sql = "INSERT INTO clubes (nomeClube, localClube, emailClube, anoFund, telClube, logotipo) 
                VALUES ('".$nomeClube."', '".$localClube."', '".$emailClube."', '".$anoFund."', '".$telClube."', '".$resp['target']."');";           
            }else{
                $sql = "INSERT INTO clubes (nomeClube, localClube, emailClube, anoFund, telClube) 
                VALUES ('".$nomeClube."', '".$localClube."', '".$emailClube."', '".$anoFund."', '".$telClube."');";
            }    
            if ($conn->query($sql) === TRUE) {
            $msg = "Registo efetuado com sucesso.";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
            return $msg;
        }

        

        function listarClubes(){
            global $conn;
            $msg = "";
            $sql = "SELECT * FROM clubes";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['idClube']."</th>";
                $msg .= "<td><img class='logoClube' src='".$row['logotipo']."'></td>";
                $msg .= "<td>".$row['nomeClube']."</td>";
                $msg .= "<td>".$row['localClube']."</td>";
                $msg .= "<td>".$row['anoFund']."</td>";
                $msg .= "<td>".$row['emailClube']."</td>";
                $msg .= "<td>".$row['telClube']."</td>";
                $msg .= "<td><button type='button' class='btn btn-danger' onclick ='removerClube(".$row['idClube'].")'>Remover</button></td>";
                $msg .= "<td><button type='button' class='btn btn-primary' onclick ='getDadosClube(".$row['idClube'].")'>Editar</button></td>";
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
        
        function removerClube($idClube){
            global $conn;
            $msg = "";
            $sql = "DELETE FROM clubes WHERE idClube = '".$idClube."';";
            if ($conn->query($sql) === TRUE) {
            $msg = "Removido com sucesso";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
            return $msg;
        }

        function getDadosClube($idClube){
            global $conn;
            $sql = "SELECT * FROM clubes WHERE idClube =".$idClube.";";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $conn->close();
            return json_encode($row);
        }

        function guardaEdicaoClube($nomeClube, $localClube, $emailClube, $anoFund, $telClube, $logotipo){
            global $conn;
            $msg = "";
            $sql = "";
            $resp = $this -> uploads($logotipo);
            $resp = json_decode($resp, TRUE);
            if($resp['flag']){
                $sql = "UPDATE clubes SET (nomeClube, localClube, emailClube, anoFund, telClube, logotipo) 
                VALUES ('".$nomeClube."', '".$localClube."', '".$emailClube."', '".$anoFund."', '".$telClube."', '".$resp['target']."')
                WHERE idClube =".$idClube.";";           
            }else{
                $sql = "UPDATE clubes SET (nomeClube, localClube, emailClube, anoFund, telClube) 
                VALUES ('".$nomeClube."', '".$localClube."', '".$emailClube."', '".$anoFund."', '".$telClube."')
                WHERE idClube =".$idClube.";";
            } 
            if ($conn->query($sql) === TRUE) {
            $msg = "Edição efetuada";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
            return $msg;
        }

        function getSelect(){
            global $conn;
            $msg = '<option value="0">Escolha um Clube</option>';
            $sql = "SELECT * FROM clubes;";
            $result = $conn->query($sql);   
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $msg .= "<option value='".$row['idClube']."'>".$row['nomeClube']."</option>";
                }
            }
            $conn->close();
            return $msg;
        }

        function uploads($logotipo){
            $dir = "../imagens/";
            $dir1 = "src/imagens/";
            $flag = false;
            $targetBD = "";
            if(!is_dir($dir)){
                if(!mkdir($dir, 0777, TRUE)){
                    die ("Erro não é possivel criar o diretório");
                }
            }
            if(array_key_exists('logotipo', $logotipo)){
                if(is_array($logotipo)){
                    if(is_uploaded_file($logotipo['logotipo']['tmp_name'])){
                        $fonte = $logotipo['logotipo']['tmp_name'];
                        $ficheiro = $logotipo['logotipo']['name'];
                        $end = explode(".",$ficheiro);
                        $extensao = end($end);       
                        $newName ="_logotipo".date("YmdHis").".".$extensao;       
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