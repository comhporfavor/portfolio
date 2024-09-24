<?php

require_once 'connection.php';

class Agendamento {

function addAgendamento($id_cliente, $id_voo, $qtd_passageiros, $valor_total) {
    global $conn;
    $msg = "";
    $validaAgenda = $this->validaAgendamento($id_cliente, $id_voo);
    $validaAssentos = $this->validaAssentos($id_voo, $qtd_passageiros);
    if (!$validaAgenda) {
        $msg = "Este voo já possui um agendamento para este cliente.";
    } else if (!$validaAssentos) {
        $msg = "Número de assentos indisponível.";
    } else {
        $sql = "INSERT INTO agendamento (id_cliente, id_voo, qtd_passageiros, valor_total) 
                VALUES ('$id_cliente', '$id_voo', '$qtd_passageiros', '$valor_total')"; 
            if ($conn->query($sql) === TRUE) {
                $id_agendamento = $conn->insert_id;
                $this->atribuiLugares($id_agendamento, $id_voo, $qtd_passageiros);
                $msg = "Agendamento registrado com sucesso.";
            } else {
                $msg = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        $conn->close();
        return $msg;
    }

    function listarAgendamentos($id_voo){
        global $conn;
        $msg = "";
        $sql = "SELECT agendamento.*, cliente.nome AS clienteAgendamento, voo.descricao AS vooAgendamento, 
                destino.localidade AS destinoAgendamento 
            FROM agendamento, cliente, voo, destino 
            WHERE agendamento.id_voo = '$idvoo' AND agendamento.id_cliente = cliente.nif AND voo.id_destino = destino.id;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['id']."</th>";
                $msg .= "<td>".$row['clienteAgendamento']."</td>";
                $msg .= "<td>".$row['vooAgendamento']."</td>";
                $msg .= "<td>".$row['destinoAgendamento']."</td>";
                $msg .= "<td>".$row['qtd_passageiros']."</td>";
                $msg .= "<td><button type='button' class='btn btn-warning' 
                    onclick ='getInfoAgendamento(".$row['id'].")'><i class='fa fa-pencil'></i></button></td>";
                $msg .= "<td><button type='button' class='btn btn-danger'
                    onclick ='excluirAgendamento(".$row['id'].")'><i class='fa fa-trash'></i></button></td>";    
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

    function getInfoAgendamento($id) {
        global $conn;
        $msg = "";
        $sql = "SELECT agendamento.*, aviao.matricula AS aviaoAgendamento, destino.localidade AS destinoAgendamento 
            FROM agendamento, aviao, destino 
            WHERE agendamento.id = '$id' AND agendamento.id_aviao = aviao.id AND agendamento.id_destino = destino.id;";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $conn->close();
        return json_encode($row);
    }

    function excluirAgendamento($id) {
        global $conn;
        $msg = "";
        $verifica = "SELECT * FROM agendamento WHERE id_Agendamento='$id';";
        $valida = $conn->query($verifica);
        if ($valida->num_rows > 0) {
            $msg = "Agendamento não pode ser excluído, pois existem agendamentos associados.";
        } else {
            $sql = "DELETE FROM Agendamento WHERE id='$id';";
            if ($conn->query($sql) === TRUE) {
                $msg = "Agendamento excluído com sucesso.";
            } else {
                $msg = "Error: ". $sql. "<br>". $conn->error;
            }
        }
        $conn->close();
        return $msg;
    }

    function validaAgendamento($id_cliente, $id_voo) {
        global $conn;
        $flag= true;
        $sql = "SELECT * FROM agendamento WHERE id_cliente='$id_cliente' AND id_voo='$id_voo';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $flag = false;
        }
        $conn->close();
        return $flag;
    }

    function validaAssentos($id_voo, $qtd_passageiros) {
        global $conn;
        $flag = true;
        $sql = "SELECT COUNT(passageiros.id) AS total_ocupados
                FROM passageiros
                JOIN agendamento ON passageiros.id_agendamento = agendamento.id
                WHERE agendamento.id_voo = $id_voo;";
        $result = $conn->query($sql);
        $maxLugar = "SELECT MAX(id) AS capacidade FROM lugares";
        $maxLugarDisp = $conn->query($maxLugar);
        if ($result && $maxLugarDisp) {
            $row = $result->fetch_assoc();
            $lugares = $maxLugarDisp->fetch_assoc();   
            if ($lugares['capacidade'] - $row['total_ocupados'] < $qtd_passageiros) {
                $flag = false;
            }
        } else {
            $flag = false;
        }
        return $flag;
    }

    function atribuiLugares($id_agendamento, $id_voo, $qtd_passageiros) {
        global $conn;
        $getCliente = "SELECT cliente.nome, cliente.idade 
                       FROM cliente 
                       JOIN agendamento ON cliente.nif = agendamento.id_cliente 
                       WHERE agendamento.id = '$id_agendamento'";
        $result = $conn->query($getCliente);
        $row = $result->fetch_assoc();
        $getUltAtrib = "SELECT MAX(id_lugar) AS lugarDisp 
                           FROM passageiros 
                           JOIN agendamento ON passageiros.id_agendamento = agendamento.id 
                           WHERE agendamento.id_voo = '$id_voo'";
        $lugarDisp = $conn->query($getUltAtrib);
        $contador = $lugarDisp->fetch_assoc();
        $inicio = $contador['lugarDisp'] ? $contador['lugarDisp'] + 1 : 1;
        for ($i = $inicio; $i < $inicio + $qtd_passageiros; $i++) {
            $sql = "INSERT INTO passageiros (id_agendamento, nome, idade, id_lugar) 
                    VALUES ('$id_agendamento', '{$row['nome']}', '{$row['idade']}', '$i')";
            $atribui = $conn->query($sql);
            if ($atribui === FALSE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
                break;
            }
        }
    }
    
}

?>
