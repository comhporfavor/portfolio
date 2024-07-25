<?php

require_once 'connection.php';

class Cliente {
    function valida($nif) {
        global $conn;
        $sql = "SELECT * FROM clientes WHERE nif = '$nif'"; // Corrigido para retornar apenas o NIF relevante
        $result = $conn->query($sql);
        $clientes = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $clientes[] = $row;
            }
        }
        $conn->close();
        return $clientes;
    }

    function addCliente($nif, $nome, $morada, $telefone, $email) {
        global $conn;
        $msg = "";
        $sql = "INSERT INTO clientes (nif, nome, morada, telefone, email) VALUES ('$nif', '$nome', '$morada', '$telefone', '$email')"; 
        if ($conn->query($sql) === TRUE) {
            $msg = "Cliente registado com sucesso.";
        } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
        return $msg;
    }

    function getInfoCliente($nif) {
        global $conn;
        $msg = "";
        $sql = "SELECT * FROM clientes WHERE nif = '$nif'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $conn->close();
        return json_encode($row);
    }

    function gravarEdicaoCliente($nif, $nome, $morada, $telefone, $email, $oldNif){
        global $conn;
        $msg = "";
        $sql = "UPDATE clientes SET nif='".$nif."', nome='".$nome."', morada='".$morada."', telefone='".$telefone."', email='".$email."' WHERE nif=".$oldNif;
        if ($conn->query($sql) === TRUE) {
            $msg = "Cliente actualizado com sucesso.";
        } else {
            $msg = "Error: ". $sql. "<br>". $conn->error;
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
            while ($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['nif']."</th>";
                $msg .= "<td>".$row['nome']."</td>";
                $msg .= "<td>".$row['morada']."</td>";
                $msg .= "<td>".$row['telefone']."</td>";
                $msg .= "<td>".$row['email']."</td>";
                $msg .= "<td><button type='button' class='btn btn-warning' onclick ='getInfoCliente(".$row['nif'].")'>Editar</button></td>";
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

}
?>
