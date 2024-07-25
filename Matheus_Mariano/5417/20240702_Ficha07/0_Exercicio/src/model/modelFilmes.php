<?php
    require_once 'connection.php';
    
    class Filme{
        function addTipo($descTipoFilme){
            global $conn;
            $msg = "";
                $sql = "INSERT INTO tipofilme (descTipoFilme) 
                VALUES ('".$descTipoFilme."');";    
            if ($conn->query($sql) === TRUE) {
            $msg = "Registo efetuado com sucesso.";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
            return $msg;
        }

        function getTipos(){
            global $conn;
            $msg = '<option value="0">Escolha um Tipo</option>';
            $sql = "SELECT * FROM tipofilme;";
            $result = $conn->query($sql);   
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $msg .= "<option value='".$row['idTipoFilme']."'>".$row['descTipoFilme']."</option>";
                }
            }
            $conn->close();
            return $msg;
        }
        
        function addFilme($nomeFilme, $anoFilme, $descFilme, $tipoFilme, $cartaz){
            global $conn;
            $msg = "";
            $sql = "";
            $resp = $this -> uploads($cartaz);
            $resp = json_decode($resp, TRUE);
            if($resp['flag']){
                $sql = "INSERT INTO filmes (nomeFilme, anoFilme, descFilme, tipoFilme, cartaz) 
                VALUES ('".$nomeFilme."', '".$anoFilme."', '".$descFilme."', '".$tipoFilme."', '".$resp['target']."');";           
            }else{
                $sql = "INSERT INTO filmes (nomeFilme, anoFilme, descFilme, tipoFilme) 
                VALUES ('".$nomeFilme."', '".$anoFilme."', '".$descFilme."', '".$tipoFilme."');";
            }    
            if ($conn->query($sql) === TRUE) {
            $msg = "Registo efetuado com sucesso.";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
            return $msg;      
        }

        function getFilmes(){
            global $conn;
            $msg = "<option value='0'>Escolha um Filme</option>";
            $sql = "SELECT * FROM filmes;";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $msg.= "<option value='".$row['idFilme']."'>".$row['nomeFilme']." - ".$row['anoFilme']."</option>";
                }
            }
            $conn->close();
            return $msg;
        }
        
        function getInfoFilme($idFilme){
            global $conn;
            $sql = "SELECT * FROM filmes WHERE idFilme =".$idFilme.";";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $conn->close();
            return json_encode($row);
        }

        function gravarEdicaoFilme($idFilme, $nomeFilme, $anoFilme, $descFilme, $tipoFilme, $cartaz){
            global $conn;
            $msg = "";
            $sql = "";
            $resp = $this -> uploads($cartaz);
            $resp = json_decode($resp, TRUE);
            if($resp['flag']){
                $sql ="UPDATE filmes SET nomeFilme = '".$nomeFilme."', anoFilme = '".$anoFilme."', descFilme = '".$descFilme."', tipoFilme = '".$tipoFilme."', 
                cartaz = '".$resp['target']."' WHERE idFilme = '".$idFilme."';";           
            }else{
                $sql ="UPDATE filmes SET nomeFilme = '".$nomeFilme."', anoFilme = '".$anoFilme."', descFilme = '".$descFilme."', tipoFilme = '".$tipoFilme."' 
                WHERE idFilme = '".$idFilme."';";
            }    
            if ($conn->query($sql) === TRUE) {
            $msg = "Edição efetuada";
            } else {
            $msg = "Error: ". $sql. "<br>". $conn->error;
            }                 
            return $msg;
        }

        function listarFilmes(){
            global $conn;
            $msg = "";
            $sql = "SELECT * FROM filmes, tipofilme WHERE filmes.tipoFilme = idTipoFilme ; " ;
            $result = $conn->query($sql);
            if ($result->num_rows > 0) { 
                while($row = $result->fetch_assoc()) {
                    $msg .= "<tr>";
                    $msg .= "<th scope='row'>".$row['idFilme']."</th>";
                    $msg .= "<td><img class='img-responsive cartaz' src='".$row['cartaz']."'></td>";
                    $msg .= "<td>".$row['nomeFilme']."</td>";
                    $msg .= "<td>".$row['anoFilme']."</td>";
                    $msg .= "<td>".$row['descTipoFilme']."</td>";
                    $msg .= "<td>".$row['descFilme']."</td>";
                    $msg .= "<td><button type='button' class='btn btn-danger' onclick ='removerFilme(".$row['idFilme'].")'>Remover</button></td>";
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

        function removerFilme($idFilme){
            global $conn;
            $msg = "";
            $sql = "DELETE FROM filmes WHERE idFilme = '".$idFilme."';";
            if ($conn->query($sql) === TRUE) {
            $msg = "Removido com sucesso";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
            return $msg;
        }

        function uploads($cartaz){
            $dir = "../imagens/";
            $dir1 = "src/imagens/";
            $flag = false;
            $targetBD = "";
            if(!is_dir($dir)){
                if(!mkdir($dir, 0777, TRUE)){
                    die ("Erro não é possivel criar o diretório");
                }
            }
            if(array_key_exists('cartaz', $cartaz)){
                if(is_array($cartaz)){
                    if(is_uploaded_file($cartaz['cartaz']['tmp_name'])){
                        $fonte = $cartaz['cartaz']['tmp_name'];
                        $ficheiro = $cartaz['cartaz']['name'];
                        $end = explode(".",$ficheiro);
                        $extensao = end($end);       
                        $newName ="cartaz".date("YmdHis").".".$extensao;       
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

        function countFilmes(){
            global $conn;
            $sql = "SELECT COUNT(*) as total FROM filmes;";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $conn->close();
            $msg = "Temos ".$row['total']." filmes registrados";
            return $msg;
        }
    }
?>