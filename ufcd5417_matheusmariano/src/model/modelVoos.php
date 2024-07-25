<?php

require_once 'connection.php';

class Voo {

    function addVoo($descricao, $id_aviao, $id_destino, $estado) {
        global $conn;
        $msg = "";
        $sql = "INSERT INTO voo (descricao, id_aviao, id_destino, estado) 
            VALUES ('$descricao', '$id_aviao', '$id_destino', '$estado')"; 
            if ($conn->query($sql) === TRUE) {
                $msg = "Voo registrado!";
            } else {
                $msg = "Error: " . $sql . "<br>" . $conn->error;
            }     
        $conn->close();
        return $msg;
    }

    function listarVoos(){
        global $conn;
        $msg = "";
        $sql = "SELECT voo.*, aviao.matricula AS aviaoVoo, destino.localidade AS destinoVoo 
            FROM voo, aviao, destino 
            WHERE voo.id_aviao = aviao.id AND voo.id_destino = destino.id;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['id']."</th>";
                $msg .= "<td>".$row['descricao']."</td>";
                $msg .= "<td>".$row['aviaoVoo']."</td>";
                $msg .= "<td>".$row['destinoVoo']."</td>";
                $msg .= "<td>".$row['estado']."</td>";
                $msg .= "<td><button type='button' class='btn btn-warning' 
                    onclick ='getInfoVoo(".$row['id'].")'><i class='fa fa-pencil'></i></button></td>";
                $msg .= "<td><button type='button' class='btn btn-danger'
                    onclick ='excluirVoo(".$row['id'].")'><i class='fa fa-trash'></button></td>";    
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

    function getInfoVoo($id) {
        global $conn;
        $msg = "";
        $sql = "SELECT voo.*, aviao.matricula AS aviaoVoo, destino.localidade AS destinoVoo 
            FROM voo, aviao, destino 
            WHERE voo.id = '$id' AND voo.id_aviao = aviao.id AND voo.id_destino = destino.id;";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $conn->close();
        return json_encode($row);
    }

    function gravarEdicaoVoo($id, $descricao, $id_aviao, $id_destino, $estado) {
        global $conn;
        $msg = "";
        $sql = "UPDATE voo SET descricao='$descricao', id_aviao='$id_aviao', id_destino='$id_destino', 
        estado='$estado' WHERE id='$id';";
        if ($conn->query($sql) === TRUE) {
            $msg = "Voo atualizado com sucesso.";
        } else {
            $msg = "Error: ". $sql. "<br>". $conn->error;
        }
        $conn -> close();
        return $msg;
    }

    function excluirVoo($id) {
        global $conn;
        $msg = "";
        $verifica = "SELECT * FROM agendamento WHERE id_voo='$id';";
        $valida = $conn->query($verifica);
        if ($valida->num_rows > 0) {
            $msg = "Voo não pode ser excluído, pois existem agendamentos associados.";
        } else {
            $sql = "DELETE FROM voo WHERE id='$id';";
            if ($conn->query($sql) === TRUE) {
                $msg = "Voo excluído com sucesso.";
            } else {
                $msg = "Error: ". $sql. "<br>". $conn->error;
            }
    
        }
        $conn->close();
        return $msg;
    }
}

?>
