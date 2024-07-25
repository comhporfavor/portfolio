<?php
    require_once 'connection.php';
    
    class Cinema{
        function registraLocal($descLocal){
            global $conn;
            $msg = "";
                $sql = "INSERT INTO locais (descLocal) 
                VALUES ('".$descLocal."');";    
            if ($conn->query($sql) === TRUE) {
            $msg = "Registo efetuado com sucesso.";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
            return $msg;
        }

        function selectLocal(){
            global $conn;
            $msg = '<option value="0">Escolha um Local</option>';
            $sql = "SELECT * FROM locais;";
            $result = $conn->query($sql);   
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $msg .= "<option value='".$row['idLocal']."'>".$row['descLocal']."</option>";
                }
            }
            $conn->close();
            return $msg;
        }
        
        function registraCinema($nomeCinema, $localCinema){
            global $conn;
            $msg = "";
                $sql = "INSERT INTO cinemas (nomeCinema, localCinema)
                VALUES ('".$nomeCinema."', '".$localCinema."');";
            if($conn->query($sql) === TRUE) {
                $msg = "Registo efetuado com sucesso.";
            } else {
                $msg = "Error: ". $sql. "<br>". $conn->error;
            }
            $conn->close();
            return $msg;            
        }

        function getCinemas(){
            global $conn;
            $msg = "<option value='0'>Escolha um Cinema</option>";
            $sql = "SELECT * FROM cinemas;";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $msg.= "<option value='".$row['idCinema']."'>".$row['nomeCinema']."</option>";
                }
            }
            $conn->close();
            return $msg;
        }
        
        function getInfoCinema($idCinema){
            global $conn;
            $sql = "SELECT * FROM cinemas WHERE idCinema =".$idCinema.";";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $conn->close();
            return json_encode($row);
        }

        function gravarEdicaoCinema($nomeCinema, $localCinema, $idCinema){
            global $conn;
            $msg = "";
            $sql = "UPDATE cinemas SET nomeCinema = '".$nomeCinema."', localCinema = '".$localCinema."' WHERE idCinema = '".$idCinema."';";
            if ($conn->query($sql) === TRUE) {
            $msg = "Edição efetuada";
            } else {
            $msg = "Error: ". $sql. "<br>". $conn->error;
            }                 
            return $msg;
        }

        function listarCinemas(){
            global $conn;
            $msg = "";
            $sql = "SELECT * FROM cinemas, locais WHERE localCinema = idLocal ; " ;
            $result = $conn->query($sql);
            if ($result->num_rows > 0) { 
                while($row = $result->fetch_assoc()) {
                    $msg .= "<tr>";
                    $msg .= "<th scope='row'>".$row['idCinema']."</th>";
                    $msg .= "<td>".$row['nomeCinema']."</td>";
                    $msg .= "<td>".$row['descLocal']."</td>";
                    $msg .= "<td><button type='button' class='btn btn-danger' onclick ='removerCinema(".$row['idCinema'].")'>Remover</button></td>";
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

        function removerCinema($idCinema){
            global $conn;
            $msg = "";
            $sql = "DELETE FROM cinemas WHERE idCinema = '".$idCinema."';";
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

        function countCinemas() {
            global $conn;
            $sql = "SELECT COUNT(*) AS total FROM cinemas;";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $conn->close();
            $msg = "Temos ".$row['total']." cinemas registrados";
            return $msg;
        }
    }
?>