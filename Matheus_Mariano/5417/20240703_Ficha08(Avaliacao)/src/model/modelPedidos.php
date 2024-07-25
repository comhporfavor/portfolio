<?php

require_once 'connection.php';

class Pedido {
    function addPedido($reserva, $pratos) {
        global $conn;
        $msg = "";        
        $result = $conn->query("SELECT idMesa FROM reserva WHERE id = $reserva");
        if ($result === FALSE) {
            $msg = "Erro na consulta de seleção de mesa: " . $conn->error;
            return $msg;
        }        
        if ($result->num_rows > 0) {
            $mesa = $result->fetch_assoc();
            $sql = "INSERT INTO pedido (idMesa, idEstado) VALUES ('".$mesa['idMesa']."', 4)";
            if ($conn->query($sql) === TRUE) {
                // Capturar o ID do novo pedido
                $idPedido = $conn->insert_id;
                // Inserir cada prato na tabela cozinha
                foreach ($pratos as $prato) {
                    $sql2 = "INSERT INTO cozinha (idPedido, idPrato) VALUES ('".$idPedido."', '".$prato."')";
                    if ($conn->query($sql2) !== TRUE) {
                        $msg = "Erro ao enviar à cozinha: " . $conn->error;
                        break;
                    }
                }
                if ($msg == "") {
                    $msg = "Pedido registrado e enviado à cozinha";
                }
            } else {
                $msg = "Erro ao inserir pedido: " . $conn->error;
            }
        } else {
            $msg = "Reserva não encontrada";
        }
        $conn->close();
        return $msg;
    }

    function listarPedidos(){
        global $conn;
        $msg = "";
        $sql = "SELECT pedido.id AS idPedido, estadopedido.descricao AS estadoPedido, pratos.nome AS nomePrato,
            mesas.nome AS nomeMesa, pedido.idEstado 
            FROM pedido, cozinha, mesas, estadopedido, pratos
            WHERE cozinha.idPedido = pedido.id AND
            cozinha.idPrato = pratos.id AND 
            pedido.idMesa = mesas.id AND
            pedido.idEstado = estadopedido.id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['idPedido']."</th>";
                $msg .= "<td>".$row['nomeMesa']."</td>";
                $msg .= "<td>".$row['nomePrato']."</td>";
                if ($row['idEstado'] == 1) {
                    $msg .= "<td><button type='button' class='btn btn-warning' onclick='getInfoPedido(".$row['idPedido'].")'>".$row['estadoPedido']."</button></td>";
                } else if ($row['idEstado'] == 2) {
                    $msg .= "<td><button type='button' class='btn btn-success' onclick='getInfoPedido(".$row['idPedido'].")'>".$row['estadoPedido']."</button></td>";
                } else if ($row['idEstado'] == 3) {
                    $msg .= "<td><button type='button' class='btn btn-secondary' onclick='getInfoPedido(".$row['idPedido'].")'>".$row['estadoPedido']."</button></td>";
                } else if ($row['idEstado'] == 4) {
                    $msg.= "<td><button type='button' class='btn btn-danger' onclick='getInfoPedido(".$row['idPedido'].")'>".$row['estadoPedido']."</button></td>";
                }
                $msg .= "<td><button type='button' class='btn btn-danger' onclick='excluirPedido(".$row['idPedido'].")'><i class='fa fa-trash'></i></button></td>";
                $msg .= "<td><button type='button' class='btn btn-success' onclick='encerrarPedido(".$row['idPedido'].")'><i class='fa fa-check'></i></button></td>";
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

    function getInfoPedido($id){
        global $conn;
        $sql = "SELECT cozinha.idPedido, estadopedido.descricao AS estadoPedido,
            mesas.nome AS nomeMesa, pedido.idEstado 
            FROM pedido, cozinha, mesas, estadopedido, pratos
            WHERE pedido.id = ".$id." AND cozinha.idPedido = pedido.id 
            AND pedido.idMesa = mesas.id AND pedido.idEstado = estadopedido.id;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            $msg = "Pedido não encontrado";
        }
        $conn->close();
        if ($row != null){
            return $row;
        } else {
            return $msg;
        }
    }

    function listarPratosPedido($id){
        global $conn;
        $msg = "";
        $sql = "SELECT pratos.foto, pratos.nome AS nomePrato FROM pratos, pedido, cozinha 
        WHERE pedido.id = ".$id." AND cozinha.idPedido = pedido.id AND cozinha.idPrato = pratos.id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg.= "<tr>";
                $msg.= "<td><img class='imgPedido' src='".$row['foto']."'></th>";
                $msg.= "<td>".$row['nomePrato']."</td>";
                $msg.= "</tr>";
            }
        } else {
            $msg.= "<tr>";
            $msg.= "<caption scope='row'><strong>Sem resultados</strong></caption>";
            $msg.= "</tr>";
        }
        return $msg;
    }

    function gravarEdicaoPedido($idPedido, $idEstado){
        global $conn;
        $msg = "";
        if ($idEstado == 3){
            $msg ="Não pode alterar estado para encerrado";
        } else {
            $sql = "UPDATE pedido SET idEstado = ".$idEstado." WHERE id = ".$idPedido;
            if ($conn->query($sql) === TRUE) {
                $msg = "Pedido editado com sucesso";
            } else {
                $msg = "Erro ao editar pedido: ". $conn->error;
            }
        }
        $conn->close();
        return $msg;
    }

    function excluirPedido($id){
        global $conn;
        $msg = "";
        $verifica = "SELECT idEstado FROM pedido WHERE id = ".$id;
        $result = $conn->query($verifica);
        $row = $result->fetch_assoc();
        if ($row['idEstado']!= 4){
            $msg ="Não pode excluir pedido que já está Em execução";
        } else {
            $sql = "DELETE FROM pedido WHERE id = ".$id;
            if ($conn->query($sql) === TRUE) {
                $msg = "Pedido excluído com sucesso";
            } else {
                $msg = "Erro ao excluir pedido: ". $conn->error;
            }
        }
        $conn->close();
        return $msg;
    }

    function encerrarPedido($id){
        global $conn;
        $msg = "";
        $txt = null;
        $verifica = "SELECT idEstado FROM pedido WHERE id = ".$id;
        $result = $conn->query($verifica);
        $row = $result->fetch_assoc();
        if ($row['idEstado'] != 2){
            $msg = "Não pode encerrar pedido que não foi servido!";
        } else {
            $sql = "UPDATE pedido SET idEstado = 3 WHERE id = ".$id;
            if ($conn->query($sql) === TRUE) {
                $msg = "Pedido encerrado com sucesso";
                $txt = $this->gerarFatura($id);
            } else {
                $msg = "Erro ao encerrar pedido: ". $conn->error;
            }
        }
        $conn->close();
        return array(
            "msg" => $msg, 
            'txt' => $txt
        );
    }
    
    // Função para gerar a fatura
    function gerarFatura($idPedido){
        global $conn;
        $dir = "../faturas/";
        
        if (!is_dir($dir)) {
            if (!mkdir($dir, 0777, true)) {
                die("Erro: não é possível criar o diretório de faturas.");
            }
        }

        $dados = "SELECT pratos.nome AS nomePrato, preco, mesas.nome AS nomeMesa 
                  FROM pratos 
                  JOIN cozinha ON cozinha.idPrato = pratos.id 
                  JOIN pedido ON cozinha.idPedido = pedido.id 
                  JOIN mesas ON pedido.idMesa = mesas.id 
                  WHERE pedido.id = ?";

        $stmt = $conn->prepare($dados);
        $stmt->bind_param("i", $idPedido);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            die("Erro: Pedido não encontrado.");
        }

        $nomeMesa = "";
        $pratos = [];
        $total = 0;

        while ($row = $result->fetch_assoc()) {
            $nomeMesa = $row['nomeMesa'];
            $pratos[] = [
                'nome' => $row['nomePrato'],
                'preco' => $row['preco']
            ];
            $total += $row['preco'];
        }

        $filename = 'fatura_' . date('YmdHis') . '.txt';
        $filepath = $dir . $filename;

        $textContent = "Fatura de Mesa " . $nomeMesa . "\n\n";
        $textContent .= "Prato\t\tPreço\n";
        $textContent .= str_repeat("=", 40) . "\n";

        foreach ($pratos as $prato) {
            $textContent .= $prato['nome'] . "\t\t" . number_format($prato['preco'], 2, ',', '.') . " €\n";
        }

        $textContent .= str_repeat("=", 40) . "\n";
        $textContent .= "Total: " . number_format($total, 2, ',', '.') . " €\n";

        if (file_put_contents($filepath, $textContent) !== false) {
            return [
                'idPedido' => $idPedido,
                'nomeMesa' => $nomeMesa,
                'pratos' => $pratos,
                'total' => $total,
                'ficheiro' => $filepath
            ];
        } else {
            return false;
        }
    }
}
?>
