<?php

require_once 'connection.php';

class Destino {

    function addDestino($descricao, $localidade, $observacoes, $valor, $img_capa) {
        global $conn;
            $msg = "";
            $sql = "";
            $resp = $this -> uploads($img_capa);
            $resp = json_decode($resp, TRUE);
            if($resp['flag']){
                $sql = "INSERT INTO destino (descricao, localidade, observacoes, valor, img_capa) 
                VALUES ('".$descricao."', '".$localidade."', '".$observacoes."', '".$valor."', '".$resp['target']."');";           
            }else{
                $sql = "INSERT INTO destino (descricao, localidade, observacoes, valor) 
                VALUES ('".$descricao."', '".$localidade."', '".$observacoes."', '".$valor."');";
            }    
            if ($conn->query($sql) === TRUE) {
                $msg = "Registro efetuado com sucesso.";
            } else {
                $msg = "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
            return $msg;
    }

    function listarDestinos() {
        global $conn;
        $msg = "";
        $sql = "SELECT * FROM destino;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>" . htmlspecialchars($row['id']) . "</th>";
                $msg .= "<td>" . htmlspecialchars($row['descricao']) . "</td>";
                $msg .= "<td>" . htmlspecialchars($row['localidade']) . "</td>";
                $msg .= "<td>" . htmlspecialchars($row['observacoes']) . "</td>";
                $msg .= "<td>" . htmlspecialchars($row['valor']) . "€</td>";
                $msg .= "<td><button type='button' class='btn btn-info' onclick='mostrarModalFoto(
                    \"" . htmlspecialchars($row['img_capa']) . "\",
                    \"" . htmlspecialchars(addslashes($row['descricao'])) . "\")'>Ver Foto</button></td>";
                $msg .= "</tr>";
            }
        } else {
            $msg .= "<tr>";
            $msg .= "<td colspan='5'><strong>Sem resultados</strong></td>";
            $msg .= "</tr>";
        }
        $conn->close();
        return $msg;
    }
    

    function uploads($img_capa) {
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
        if (array_key_exists('img_capa', $img_capa)) {
            if (is_array($img_capa) && is_uploaded_file($img_capa['img_capa']['tmp_name'])) {
                error_log("Arquivo de foto encontrado...");
                $fonte = $img_capa['img_capa']['tmp_name'];
                $ficheiro = $img_capa['img_capa']['name'];
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
