
<?php

    require_once 'connection.php';

    class Cliente{

        function addCliente($nifCliente, $nomeCliente, $localCliente, $emailCliente, $telCliente){

            global $conn;

            $msg = "";

            $sql = "INSERT INTO clientes (nifCliente, nomeCliente, localCliente, emailCliente, telCliente) 
            VALUES ('".$nifCliente."', '".$nomeCliente."', '".$localCliente."', '".$emailCliente."', '".$telCliente."');";

            if ($conn->query($sql) === TRUE) {
            $msg = "Adicionado com sucesso!";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();

            return $msg;

        }

        function listarClientes(){

            global $conn;
            $msg = "";
            $sql = "SELECT * FROM clientes";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['idCliente']."</th>";
                $msg .= "<td>".$row['nifCliente']."</td>";
                $msg .= "<td>".$row['nomeCliente']."</td>";
                $msg .= "<td>".$row['localCliente']."</td>";
                $msg .= "<td>".$row['emailCliente']."</td>";
                $msg .= "<td>".$row['telCliente']."</td>";
                $msg .= "<td><button type='button' class='btn btn-danger' onclick ='removerCliente(".$row['idCliente'].")'>Remover</button></td>";
                $msg .= "<td><button type='button' class='btn btn-primary' onclick ='getDadosCliente(".$row['idCliente'].")'>Editar</button></td>";
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
        
        function removerCliente($idCliente){
            global $conn;

            $msg = "";

            $sql = "DELETE FROM clientes WHERE idCliente = '".$idCliente."';";

            if ($conn->query($sql) === TRUE) {
            $msg = "Removido com sucesso";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();

            return $msg;

        }

        function getDadosCliente($idCliente){
            global $conn;

            $sql = "SELECT * FROM clientes WHERE idCliente =".$idCliente.";";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        
            $conn->close();

            return json_encode($row);

        }

        function guardaEdicaoCliente($idCliente, $nifCliente, $nomeCliente, $localCliente, $emailCliente, $telCliente){

            global $conn;

            $msg = "";

            $sql = "UPDATE clientes SET 
            nifCliente = '".$nifCliente."' , nomeCliente = '".$nomeCliente."' , localCliente = '".$localCliente."', emailCliente = '".$emailCliente."', telCliente = '".$telCliente."'
            WHERE idCliente =".$idCliente.";";

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

            $msg = '<option value="0">Escolha um Cliente</option>';
    
            $sql = "SELECT * FROM clientes;";
            $result = $conn->query($sql);   
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $msg .= "<option value='".$row['idCliente']."'>".$row['nifCliente']." - ".$row['nomeCliente']."</option>";
                }
            }
            $conn->close();
    
            return $msg;
        }

    }
?>