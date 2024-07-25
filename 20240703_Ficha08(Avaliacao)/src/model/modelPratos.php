<?php

require_once 'connection.php';

class Prato {
    function addPrato($nome, $preco, $tipoPrato, $foto) {
        global $conn;
            $msg = "";
            $sql = "";
            $resp = $this -> uploads($foto);
            $resp = json_decode($resp, TRUE);
            if($resp['flag']){
                $sql = "INSERT INTO pratos (nome, preco, idTipo, foto) 
                VALUES ('".$nome."', '".$preco."', '".$tipoPrato."', '".$resp['target']."');";           
            }else{
                $sql = "INSERT INTO pratos (nome, preco, idTipo, foto) 
                VALUES ('".$nome."', '".$preco."', '".$tipoPrato."');";
            }    
            if ($conn->query($sql) === TRUE) {
            $msg = "Registro efetuado com sucesso.";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
            return $msg;
    }

    function getInfoPrato($id) {
        global $conn;
        $msg = "";
        $sql = "SELECT * FROM pratos WHERE id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $conn->close();
        return json_encode($row);
    }

    function gravarEdicaoPrato($id, $nome, $preco, $idTipo, $foto){
        global $conn;
        $msg = "";
        $sql = "";
        $resp = $this -> uploads($foto);
        $resp = json_decode($resp, TRUE);
        if($resp['flag']){
            $sql = "UPDATE pratos SET nome='".$nome."', preco='".$preco."', idTipo='".$idTipo."', foto='".$resp['target']."' WHERE id='".$id."';";           
        }else{
            $sql = "UPDATE pratos SET nome='".$nome."', preco='".$preco."', idTipo='".$idTipo."' WHERE id='".$id."';";
        }    
        if ($conn->query($sql) === TRUE) {
        $msg = "Registro efetuado com sucesso.";
        } else {
        $msg = "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
        return $msg;
    }

    function listarPratos($pagina){
        global $conn;
        $msg = "";
        $sql = "SELECT pratos.*, tipoprato.descricao FROM pratos, tipoprato WHERE pratos.idTipo = tipoprato.id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['id']."</th>";
                $msg .= "<td><img class='imgPratos' src='".$row['foto']."'></td>";
                $msg .= "<td>".$row['nome']."</td>";
                $msg .= "<td>".$row['preco']."€</td>";
                $msg .= "<td>".$row['descricao']."</td>";
                if ($pagina==1) {
                    $msg .= "<td><button type='button' class='btn btn-warning' onclick ='getInfoPrato(".$row['id'].")'><i class='fa fa-pencil'></button></td>";
                    $msg .= "<td><button type='button' class='btn btn-danger' onclick ='excluirPrato(".$row['id'].")'><i class='fa fa-trash'></i></button></td>";
                } else if ($pagina==2){
                    $msg .= "<td><input class='form-check-input' type='checkbox' value='".$row['id']."' id='checkPrato".$row['id']."'></td>";
                }
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

    function excluirPrato($id){
        global $conn;
        $msg = "";
        $valida = "SELECT cozinha.idPrato FROM cozinha WHERE idPrato = '$id'";
        $result = $conn->query($valida);
        if ($result->num_rows > 0) {
            $msg = "Este prato não pode ser excluído pois já foi pedido à uma cozinha.";
        } else {
            $sql = "DELETE FROM pratos WHERE id = '$id'";
            if ($conn->query($sql) === TRUE) {
                $msg = "Registro excluído com sucesso.";
            } else {
                $msg = "Error: ". $sql. "<br>". $conn->error;
            }
        }
        $conn->close();
        return $msg;
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
