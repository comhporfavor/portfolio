
<?php

    require_once 'connection.php';

    class Projeto{

        function addProjeto($descProj, $tipoProj, $clienteProj){

            global $conn;

            $msg = "";

            $sql = "INSERT INTO projetos (descProj, tipoProj, clienteProj) 
            VALUES ('".$descProj."', '".$tipoProj."', '".$clienteProj."');";

            if ($conn->query($sql) === TRUE) {
            $msg = "Adicionado com sucesso!";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();

            return $msg;

        }

        function listarProjetos(){

            global $conn;
            $msg = "";
            $sql = "SELECT * FROM projetos, clientes WHERE projetos.clienteProj = clientes.idCliente";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['idProj']."</th>";
                $msg .= "<td>".$row['descProj']."</td>";
                $msg .= "<td>".$row['tipoProj']."</td>";
                $msg .= "<td>".$row['nifCliente']." - ".$row['nomeCliente']."</td>";
                $msg .= "<td><button type='button' class='btn btn-danger' onclick ='removerProjeto(".$row['idProj'].")'>Remover</button></td>";
                $msg .= "</tr>";
            }

            } else {
                $msg .= "<tr>";
                $msg .= "<th scope='row'> Sem resultados</th>";
                $msg .= "<td></td>";
                $msg .= "<td></td>";
                $msg .= "<td></td>";
                $msg .= "<td></td>";
                $msg .= "</tr>";
            }

            $conn->close();

            return $msg;
        }
        
        function removerProjeto($idProj){
            global $conn;

            $msg = "";

            $sql = "DELETE FROM projetos WHERE idProj = '".$idProj."';";

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