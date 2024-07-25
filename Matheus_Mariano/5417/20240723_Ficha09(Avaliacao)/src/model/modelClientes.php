<?php

require_once 'connection.php';

class Cliente {

    function addCliente($nif, $nome, $morada, $telefone, $email, $tipo) {
        global $conn;
        $msg = "";
        $verifica = "SELECT * FROM client WHERE nif = '$nif';";
        $valida = $conn->query($verifica);
        if ($valida->num_rows > 0) {
            $msg = "Cliente já existe!";
        } else {
            $sql = "INSERT INTO client (nif, nome, morada, telefone, email, id_type) 
            VALUES ('$nif', '$nome', '$morada', '$telefone', '$email', '$tipo')"; 
            if ($conn->query($sql) === TRUE) {
                $msg = "Cliente registrado!";
            } else {
                $msg = "Error: " . $sql . "<br>" . $conn->error;
            }
        }       
        $conn->close();
        return $msg;
    }

    function listarClientes(){
        global $conn;
        $msg = "";
        $sql = "SELECT client.*, type_client.descricao AS tipoCliente FROM client, type_client 
            WHERE client.id_type = type_client.id;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['nif']."</th>";
                $msg .= "<td>".$row['nome']."</td>";
                $msg .= "<td>".$row['morada']."</td>";
                $msg .= "<td>".$row['telefone']."</td>";
                $msg .= "<td>".$row['email']."</td>";
                $msg .= "<td>".$row['tipoCliente']."</td>";
                $msg .= "<td><button type='button' class='btn btn-warning' 
                    onclick ='getInfoCliente(".$row['nif'].")'><i class='fa fa-pencil'></i></button></td>";
                $msg.= "<td><button type='button' class='btn btn-danger' 
                    onclick ='excluirCliente(".$row['nif'].")'><i class='fa fa-trash'></i></button></td>";
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

    function getInfoCliente($nif) {
        global $conn;
        $msg = "";
        $sql = "SELECT client.*, type_client.descricao AS tipoCliente 
            FROM client, type_client WHERE nif = '$nif';";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $conn->close();
        return json_encode($row);
    }

    function gravarEdicaoCliente($oldNif, $nif, $nome, $morada, $telefone, $email, $tipo){
        global $conn;
        $msg = "";
        $sql = "UPDATE client SET nif='".$nif."', nome='".$nome."', morada='".$morada."', 
            telefone='".$telefone."', email='".$email."', id_type = '".$tipo."' WHERE nif=".$oldNif;
        if ($nif == $oldNif) {
            if ($conn->query($sql) === TRUE) {
                $msg = "Cliente atualizado com sucesso.";
            }
        } else {
            $verifica = "SELECT * FROM client WHERE nif = '$nif' AND nif <> '$oldNif';";
            $valida = $conn->query($verifica);
            if ($valida->num_rows > 0) {
                $msg = "Cliente já existe!";
            } else {
                if ($conn->query($sql) === TRUE) {
                    $msg = "Cliente tualizado com sucesso.";
                } else {
                    $msg = "Error: ". $sql. "<br>". $conn->error;
                }
            }
        $conn->close();
        return $msg;
        }
    }

    function excluirCliente($nif){
        global $conn;
        $msg = "";
        $sql = "DELETE FROM client WHERE nif = '$nif'";
        if ($conn->query($sql) === TRUE) {
            $msg = "Cliente excluído com sucesso.";
        } else {
            $msg = "Error: ". $sql. "<br>". $conn->error;
        }
        $conn->close();
        return $msg;
    }

}

?>
