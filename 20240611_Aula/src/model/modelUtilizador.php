
<?php

    require_once 'connection.php';

    class Utilizador{

        function registarUtilizador($nome, $morada, $telefone){

            global $conn;

            $msg = "";

            $sql = "INSERT INTO utilizador (nome, morada, telefone) VALUES ('".$nome."','".$morada."', '".$telefone."');";

            if ($conn->query($sql) === TRUE) {
            $msg = "Registado com sucesso!";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();

            return $msg;

        }

        function listaUtilizadores(){

            global $conn;
            $msg = "";

            $sql = "SELECT * FROM utilizador;";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['id']."</th>";
                $msg .= "<td>".$row['nome']."</td>";
                $msg .= "<td>".$row['morada']."</td>";
                $msg .= "<td>".$row['telefone']."</td>";
                $msg .= "<td><button type='button' class='btn btn-danger' onclick ='removerUser(".$row['id'].")'>Remover</button></td>";
                $msg .= "<td><button type='button' class='btn btn-primary' onclick ='editarUser(".$row['id'].")'>Editar</button></td>";
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
        
        function removerUtilizador($id){
            global $conn;

            $msg = "";

            $sql = "DELETE FROM utilizador WHERE id = ".$id.";";

            if ($conn->query($sql) === TRUE) {
            $msg = "Removido com sucesso";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();

            return $msg;

        }

        function getDadosUtilizador($id){
            global $conn;

            $sql = "SELECT * FROM utilizador WHERE id =".$id.";";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        
            $conn->close();

            return json_encode($row);

        }

        function guardaEdicaoUtilizador($nome, $morada, $telefone, $id){

            global $conn;

            $msg = "";

            $sql = "UPDATE utilizador SET 
            nome = '".$nome."' , morada = '".$morada."', telefone = '".$telefone."' 
            WHERE id =".$id.";";

            if ($conn->query($sql) === TRUE) {
            $msg = "Edição efetuada";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();

            return $msg;

        }
    }
?>