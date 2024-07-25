<?php

require_once 'connection.php';

class Produto {
    function addProduto($descricao, $valor, $tipo, $foto, $stock) {
        global $conn;
        $msg = "";
        $sql = "";
        $resp = $this->uploads($foto);
        $resp = json_decode($resp, TRUE);
        $img = $resp['flag'] ? $resp['target'] : null;
        $stmt = $conn->prepare("INSERT INTO product (descricao, valor, id_type, img, stock) 
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sdisi", $descricao, $valor, $tipo, $img, $stock);    
        if ($stmt->execute()) {
            $msg = "Registro efetuado com sucesso.";
            $id = $stmt->insert_id;
            $this->validaStock($id, $stock);
        } else {
            $msg = "Error: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
        return $msg;
    }

    function listarProdutos() {
        global $conn;
        $msg = "";
        $sql = "SELECT product.*, type_product.descricao AS tipoProduto, product_state.descricao AS estado 
            FROM product , type_product, product_state
            WHERE product.id_type = type_product.id AND product.id_estado = product_state.id;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg.= "<tr>";
                $msg.= "<th scope='row'>".$row['id']."</th>";
                $msg.= "<td><img src='".$row['img']."' alt='foto".$row['descricao']."'></td>";
                $msg.= "<td>".$row['descricao']."</td>";
                $msg.= "<td>".$row['tipoProduto']."</td>";
                $msg.= "<td>".$row['valor']."</td>";
                $msg.= "<td>".$row['stock']."</td>";
                $msg.= "<td>".$row['estado']."</td>";
                $msg.= "<td><button type='button' class='btn btn-warning' 
                        onclick ='editarProduto(".$row['id'].")'><i class='fa fa-pencil'></i></button></td>";
                $msg.= "<td><button type='button' class='btn btn-danger' 
                        onclick ='excluirProduto(".$row['id'].")'><i class='fa fa-trash'></i></button></td>";
                $msg.= "</tr>";
            }
        } else {
            $msg.= "<tr>";
            $msg.= "<caption scope='row'><strong>Sem resultados</strong></caption>";
            $msg.= "</tr>";
        }
        $conn->close();
        return $msg;
    }

    function validaStock($id, $stock) {
        global $conn;
        $stmt = $conn->prepare("SELECT stock FROM product WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $sql2 = $result['stock'] > 0 ? "UPDATE product SET id_estado = 1 WHERE id = ?" 
            : "UPDATE product SET id_estado = 2 WHERE id = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $stmt->close();
        $stmt2->close();
    }

    function uploads($foto) {
        $dir = "../imagens/";
        $dir1 = "src/imagens/";
        $flag = false;
        $targetBD = "";
        error_log("Verificando diretório...");
        if (!is_dir($dir)) {
            if (!mkdir($dir, 0777, TRUE)) {
                die ("Erro: não é possível criar o diretório");
            }
        }
        error_log("Verificando arquivo de foto...");
        if (array_key_exists('foto', $foto)) {
            if (is_array($foto) && is_uploaded_file($foto['foto']['tmp_name'])) {
                error_log("Arquivo de foto encontrado...");
                $fonte = $foto['foto']['tmp_name'];
                $ficheiro = $foto['foto']['name'];
                $end = explode(".", $ficheiro);
                $extensao = end($end);       
                $newName = "foto" . date("YmdHis") . "." . $extensao;       
                $target = $dir . $newName;
                $targetBD = $dir1 . $newName;    
                if (move_uploaded_file($fonte, $target)) {
                    error_log("Arquivo movido com sucesso...");
                    $flag = true;
                }
                $this->wFicheiro($target);        
            } else {
                error_log("O arquivo de foto não foi carregado corretamente.");
            }
        } else {
            error_log("Nenhum arquivo de foto foi enviado.");
        }      
        return json_encode(array(
            "flag" => $flag,
            "target" => $targetBD
        ));
    }

    function wFicheiro($texto) {
        $file = '../logs.txt';
        if (file_put_contents($file, $texto . "\n", FILE_APPEND) === false) {
            die("Erro ao escrever no arquivo de log");
        }
    }
}

?>
