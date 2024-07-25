<?php
// teste de la base de datos
require_once 'connection.php';

class Cliente {

    function addCliente($nif, $nome, $morada, $telefone, $email, $idade, $tipo) {
        global $conn;
        $msg = "";
        $verificanif = "SELECT * FROM cliente WHERE nif = '$nif';";
        $validanif = $conn->query($verificanif);
        $verificamail = "SELECT * FROM cliente WHERE email = '$email';";
        $validamail = $conn->query($verificamail);
        if ($validanif->num_rows > 0) {
            $msg = "Cliente já existe!";
        } else if ($validamail->num_rows > 0) {
            $msg = "Email já existe!";
        } else {
            $sql = "INSERT INTO cliente (nif, nome, morada, telefone, email, idade, id_tipo) 
            VALUES ('$nif', '$nome', '$morada', '$telefone', '$email', '$tipo', '$tipo')"; 
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
        $sql = "SELECT cliente.*, tipo_cliente.descricao AS tipoCliente FROM cliente, tipo_cliente 
            WHERE cliente.id_tipo = tipo_cliente.id;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['nif']."</th>";
                $msg .= "<td>".$row['nome']."</td>";
                $msg .= "<td>".$row['morada']."</td>";
                $msg .= "<td>".$row['telefone']."</td>";
                $msg .= "<td>".$row['email']."</td>";
                $msg .= "<td>".$row['idade']."</td>";
                $msg .= "<td>".$row['tipoCliente']."</td>";
                $msg .= "<td><button type='button' class='btn btn-warning' 
                    onclick ='getInfoCliente(".$row['nif'].")'><i class='fa fa-pencil'></i></button></td>";
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
        $sql = "SELECT cliente.*, tipo_cliente.descricao AS tipoCliente 
            FROM cliente, tipo_cliente WHERE nif = '$nif';";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $conn->close();
        return json_encode($row);
    }

    function gravarEdicaoCliente($oldNif, $nif, $nome, $morada, $telefone, $email, $oldEmail, $idade, $tipo){
        global $conn;
        $msg = "";
        $verifcareserva = "SELECT * FROM agendamento WHERE id_cliente = '$oldNif';";
        $validareserva = $conn->query($verifcareserva);
        if ($validareserva->num_rows > 0) {
            $msg = "Não é possível alterar dados do cliente enquanto existem reservas associadas!";
        } else {
            $sql = "UPDATE client SET nif='".$nif."', nome='".$nome."', morada='".$morada."', 
                telefone='".$telefone."', email='".$email."', id_type = '".$tipo."' WHERE nif=".$oldNif;
            if ($nif == $oldNif && $email == $oldEmail) {
                if ($conn->query($sql) === TRUE) {
                    $msg = "Cliente atualizado com sucesso.";
                }
            } else {
                $verificanif = "SELECT * FROM cliente WHERE nif = '$nif';";
                $validanif = $conn->query($verificanif);
                $verificamail = "SELECT * FROM cliente WHERE email = '$email';";
                $validamail = $conn->query($verificamail);
                if ($validanif->num_rows > 0) {
                    $msg = "Cliente já existe!";
                } else if ($validamail->num_rows > 0) {
                    $msg = "Email já existe!";
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
    }

}

?>
