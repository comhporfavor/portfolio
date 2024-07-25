<?php

require_once 'connection.php';

class Produto{

    function registarProduto($ref, $nome, $descricao, $preco, $tipo, $foto){

        global $conn;
        $msg = "";
        $sql = "";

        $resp = $this -> uploads($foto);
        $resp = json_decode($resp, TRUE);

        if($resp['flag']){
            
            $sql = "INSERT INTO produtos (ref, nome, preco, descricao, tipo, img) 
            VALUES ('".$ref."', '".$nome."', '".$preco."', '".$descricao."', '".$tipo."','".$resp['target']."');";
        
        }else{
            $sql = "INSERT INTO produtos (ref, nome, preco, descricao, tipo) 
            VALUES ('".$ref."', '".$nome."', '".$preco."', '".$descricao."', '".$tipo."');";
        }

        

        if ($conn->query($sql) === TRUE) {
        $msg = "Registo efetuado com sucesso.";
        } else {
        $msg = "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();

        return $msg;
    }

    function listarProdutos(){

        global $conn;
        $msg = "<table class='table'>";
        $msg .= "<thead>";
        $msg .= "<tr>";
        $msg .= "<th scope='col'>Imagem</th>";
        $msg .= "<th scope='col'>Referência</th>";
        $msg .= "<th scope='col'>Nome</th>";
        $msg .= "<th scope='col'>Descrição</th>";
        $msg .= "<th scope='col'>Preço</th>";
        $msg .= "<th scope='col'>Tipo</th>";
        $msg .= "<th scope='col'>Remover</th>";
        $msg .= "<th scope='col'>Editar</th>";
        $msg .= "</tr>";
        $msg .= "</thead>";
        $msg .= "<tbody>";

        $sql = "SELECT produtos.*, tipo_produtos.descricao AS tipo_descr FROM produtos, tipo_produtos 
        WHERE tipo_produtos.id = produtos.tipo;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $msg .= "<tr>";
            $msg .= "<td><img src=".$row['img']." class='img-thumbnail img-size'></td>";
            $msg .= "<th scope='row'>".$row['ref']."</th>";
            $msg .= "<td>".$row['nome']."</td>";
            $msg .= "<td>".$row['descricao']."</td>";
            $msg .= "<td>".$row['preco']."</td>";
            $msg .= "<td>".$row['tipo_descr']."</td>";
            $msg .= "<td><button type='button' class='btn btn-danger' onclick='removerProduto(".$row['ref'].")'>Remover</button></td>";
            $msg .= "<td><button type='button' class='btn btn-primary' onclick='getDadosProduto(".$row['ref'].")'>Editar</button></td>";
            $msg .= "</tr>";
        }
        } else {
            $msg .= "<tr>";
            $msg .= "<th scope='row'>Sem resultados</th>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "</tr>";
        }
        $conn->close();
        $msg .= "</tbody>";
        $msg .= "</table>";

        return $msg;
    }

    function removerProduto($id){

        global $conn;
        $msg = "";

        // sql to delete a record
        $sql = "DELETE FROM produtos WHERE ref = '".$id."';";

        if ($conn->query($sql) === TRUE) {
            $msg = "Removido com sucesso!";
        } else {
            $msg = "Error deleting record: " . $conn->error;
        }

        $conn->close();

        return $msg;
    }

    function getDadosProduto($id){

        global $conn;

        $sql = "SELECT * FROM produtos WHERE ref = '".$id."';";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();


        $conn->close();

        return json_encode($row);

    }

    function editProduto($ref, $nome, $descricao, $preco, $oldRef, $tipo){

        global $conn;
        $msg = "";

        $sql = "UPDATE produtos 
        SET nome = '".$nome."', ref = '".$ref."',  preco = '".$preco."',  descricao = '".$descricao."' ,  tipo = '".$tipo."' 
        WHERE ref = '".$oldRef."';";

        if ($conn->query($sql) === TRUE) {
            $msg = "Editado com sucesso!";
        } else {
            $msg = "Error deleting record: " . $conn->error;
        }

        $conn->close();

        return $msg;
    }

    function getTiposProduto(){

        global $conn;
        $msg = "<option value = '-1'>Escolha uma opção</option>";
        
        $sql = "SELECT * FROM tipo_produtos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $msg .= "<option value = '".$row['id']."'>".$row['descricao']."</option>";
        }
        } else {
            $msg .= "<option value = '-1'>Sem tipos registados</option>";
        }
        $conn->close();
        return $msg;
    }


    function uploads($img){

        $dir = "../imagens/";
        $dir1 = "src/imagens/";
        $flag = false;
        $targetBD = "";
    
        if(!is_dir($dir)){
            if(!mkdir($dir, 0777, TRUE)){
                die ("Erro não é possivel criar o diretório");
            }
        }
      if(array_key_exists('imagem', $img)){
        if(is_array($img)){
          if(is_uploaded_file($img['imagem']['tmp_name'])){
            $fonte = $img['imagem']['tmp_name'];
            $ficheiro = $img['imagem']['name'];
            $end = explode(".",$ficheiro);
            $extensao = end($end);
    
            $newName ="_produto".date("YmdHis").".".$extensao;
    
            $target = $dir.$newName;
            $targetBD = $dir1.$newName;

            $this -> wFicheiro($target);
    
            $flag = move_uploaded_file($fonte, $target);
            
          } 
        }
      }
        return (json_encode(array(
          "flag" => $flag,
          "target" => $targetBD
        )));
    
    
    }

    function wFicheiro($texto){
        $file = '../logs.txt';
        // Open the file to get existing content
        $current = file_get_contents($file);
        // Append a new person to the file
        $current .= $texto."\n";
        // Write the contents back to the file
        file_put_contents($file, $current);
    }
}
?>