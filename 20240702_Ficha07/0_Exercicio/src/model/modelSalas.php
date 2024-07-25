<?php
    require_once 'connection.php';
    
    class Sala{
        
        function addSala($descSala, $cineSala){
            global $conn;
            $msg = "";
                $sql = "INSERT INTO salas (descSala, cineSala)
                VALUES ('".$descSala."', '".$cineSala."');";
            if($conn->query($sql) === TRUE) {
                $msg = "Registo efetuado com sucesso.";
            } else {
                $msg = "Error: ". $sql. "<br>". $conn->error;
            }
            $conn->close();
            return $msg;            
        }

        function getSalas(){
            global $conn;
            $msg = "<option value='0'>Escolha uma Sala</option>";
            $sql = "SELECT * FROM cinemas, salas WHERE cineSala = idCinema;";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $msg.= "<option value='".$row['idSala']."'>".$row['nomeCinema']." - ".$row['descSala']."</option>";
                }
            }
            $conn->close();
            return $msg;
        }
        
        function getInfoSala($idSala){
            global $conn;
            $sql = "SELECT * FROM salas WHERE idSala =".$idSala.";";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $conn->close();
            return json_encode($row);
        }

        function gravarEdicaoSala($idSala, $descSala, $cineSala){
            global $conn;
            $msg = "";
            $sql = "UPDATE salas SET descSala = '".$descSala."', cineSala = '".$cineSala."' WHERE idSala = '".$idSala."';";
            if ($conn->query($sql) === TRUE) {
            $msg = "Edição efetuada";
            } else {
            $msg = "Error: ". $sql. "<br>". $conn->error;
            }                 
            return $msg;
        }

        function listarSalas(){
            global $conn;
            $msg = "";
            $sql = "SELECT * FROM salas, cinemas WHERE cineSala = idCinema ; " ;
            $result = $conn->query($sql);
            if ($result->num_rows > 0) { 
                while($row = $result->fetch_assoc()) {
                    $msg .= "<tr>";
                    $msg .= "<th scope='row'>".$row['idSala']."</th>";
                    $msg .= "<td>".$row['descSala']."</td>";
                    $msg .= "<td>".$row['nomeCinema']."</td>";
                    $msg .= "<td><button type='button' class='btn btn-danger' onclick ='removerSala(".$row['idSala'].")'>Remover</button></td>";
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

        function removerSala($idSala){
            global $conn;
            $msg = "";
            $sql = "DELETE FROM salas WHERE idSala = '".$idSala."';";
            if ($conn->query($sql) === TRUE) {
            $msg = "Removido com sucesso";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
            return $msg;
        }
    }
?>