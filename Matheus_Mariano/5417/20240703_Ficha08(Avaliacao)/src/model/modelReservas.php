<?php

require_once 'connection.php';

class Reserva {
    function addReserva($idCliente, $idMesa, $data, $hora) {
        global $conn;
        $msg = "";
        $verifica="SELECT * FROM reserva WHERE idMesa = '$idMesa' AND dataReserva = '$data' AND hora = '$hora'";
        $valida=$conn->query($verifica);
        if($valida->num_rows > 0){
            $msg = "Já existe uma reserva para a mesa no horário especificado.";
        }else{
            $sql = "INSERT INTO reserva (idCliente, idMesa, dataReserva, hora, estado) VALUES ('$idCliente', '$idMesa', '$data', '$hora', 3)";
            if ($conn->query($sql) === TRUE) {
                $msg = "Reserva efetuada com sucesso.";
            } else {
                $msg = "Error: ". $sql. "<br>". $conn->error;
            }
        }
        return $msg;
    }

    function getInfoReserva($id) {
        global $conn;
        $sql = "SELECT reserva.id AS idReserva, clientes.nome AS nomeCliente, mesas.nome AS nomeMesa, 
        reserva.dataReserva, reserva.hora, estadoreserva.descricao
        FROM reserva, clientes, mesas, estadoreserva
        WHERE reserva.id = '$id' AND reserva.idCliente = clientes.nif AND reserva.idMesa = mesas.id 
        AND reserva.estado = estadoreserva.id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $conn->close();
        return json_encode($row);
    }

    function gravarEdicaoReserva($id, $dataReserva, $hora, $estado){
        global $conn;
        $msg = "";
        $verifica="SELECT * FROM reserva WHERE idMesa = '$idMesa' AND dataReserva = '$dataReserva' 
        AND hora = '$hora'";
        $valida=$conn->query($verifica);
        if($valida->num_rows > 0){
            $msg = "Já existe uma reserva para a mesa no horário especificado.";
        }else{
            $sql = "UPDATE reserva SET dataReserva ='".$dataReserva."', hora='".$hora."', estado ='".$estado."'
            WHERE id=".$id;
            if ($conn->query($sql) === TRUE) {
                $msg = "Reserva atualizada com sucesso.";
            } else {
            $msg = "Error: ". $sql. "<br>". $conn->error;
            }
        }
        $conn->close();
        return $msg;
    }

    function listarReservas(){
        global $conn;
        $msg = "";
        $sql = "SELECT reserva.id AS idReserva, clientes.nome AS nomeCliente, mesas.nome AS nomeMesa, 
            reserva.dataReserva, reserva.hora, reserva.estado, estadoreserva.descricao
            FROM reserva, clientes, mesas, estadoreserva
            WHERE reserva.idCliente = clientes.nif AND 
            reserva.idMesa = mesas.id AND
            reserva.estado = estadoreserva.id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['idReserva']."</th>";
                $msg .= "<td>".$row['nomeCliente']."</td>";
                $msg .= "<td>".$row['nomeMesa']."</td>";
                $msg .= "<td>".$row['dataReserva']."</td>";
                $msg .= "<td>".$row['hora']."</td>";
                if ($row['estado'] == 1) {
                    $msg .= "<td><button type='button' class='btn btn-danger' onclick='getInfoReserva(".$row['idReserva'].")'>".$row['descricao']."</button></td>";
                } else if ($row['estado'] == 2) {
                    $msg .= "<td><button type='button' class='btn btn-success' onclick='getInfoReserva(".$row['idReserva'].")'>".$row['descricao']."</button></td>";
                } else if ($row['estado'] == 3) {
                    $msg .= "<td><button type='button' class='btn btn-warning' onclick='getInfoReserva(".$row['idReserva'].")'>".$row['descricao']."</button></td>";
                }
                $msg .= "<td><button type='button' class='btn btn-danger' onclick='excluirReserva(".$row['idReserva'].")'><i class='fa fa-trash'></i></button></td>";
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

    function excluirReserva($id){
        global $conn;
        $msg = [];
        $verifica = "SELECT * FROM reserva WHERE id = '$id'";
        $valida=$conn->query($verifica);
        $row = $valida->fetch_assoc();
        if($row['estado'] != 1){
            $msg[0] = "Não pode excluir uma reserva que não esteja cancelada.";
            $msg[1] = 1;
        } else {
            $sql = "DELETE FROM reserva WHERE id = '$id'";
            if ($conn->query($sql) === TRUE) {
                $msg[0] = "Registro excluído com sucesso.";
                $msg[1] = 2;
            } else {
                $msg = "Error: ". $sql. "<br>". $conn->error;
            }
        }
        $conn->close();
        return $msg;
    }

    function getReservas(){
        global $conn;
        $sql = "SELECT reserva.id AS idReserva, clientes.nome AS nomeCliente, mesas.nome AS nomeMesa,
         reserva.dataReserva, reserva.hora, reserva.estado
        FROM reserva, clientes, mesas WHERE estado != 1 AND reserva.idCliente = clientes.nif 
        AND reserva.idMesa=mesas.id;";
        $result = $conn->query($sql);
        $msg = "<option value='-1'>Escolha uma reserva</option>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= " <option value='".$row['idReserva']."'>".$row['nomeMesa']." - ".$row['nomeCliente']."
                - ".$row['dataReserva']." - ".$row['hora']."</option>";
            }
        } else {
            $msg = "Sem resultados";
        }
        $conn->close();
        return $msg;
    }
    
}
?>
