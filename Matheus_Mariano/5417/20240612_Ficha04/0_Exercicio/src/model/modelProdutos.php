
<?php

    require_once 'connection.php';

    class Produto{

        function addProduto($nomeProduto, $tipoProduto, $descProduto, $precoProduto){

            global $conn;

            $msg = "";

            $sql = "INSERT INTO produtos (nome, tipo, descricao, preco) VALUES ('".$nomeProduto."', '".$tipoProduto."', '".$descProduto."', '".$precoProduto."');";

            if ($conn->query($sql) === TRUE) {
            $msg = "Adicionado com sucesso!";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();

            return $msg;

        }

        function listarProdutos(){

            global $conn;
            $msg = "";
            $sql = "SELECT * FROM produtos, tipos WHERE produtos.tipo = tipos.id;";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['ref']."</th>";
                $msg .= "<td>".$row['nome']."</td>";
                $msg .= "<td>".$row['descTipo']."</td>";
                $msg .= "<td>".$row['descricao']."</td>";
                $msg .= "<td>€".$row['preco']."</td>";
                $msg .= "<td><button type='button' class='btn btn-danger' onclick ='removerProd(".$row['ref'].")'>Remover</button></td>";
                $msg .= "<td><button type='button' class='btn btn-primary' onclick ='getDadosProd(".$row['ref'].")'>Editar</button></td>";
                $msg .= "</tr>";
            }

            } else {
                $msg .= "<tr>";
                $msg .= "<th scope='row'> Sem resultados</th>";
                $msg .= "<td></td>";
                $msg .= "<td></td>";
                $msg .= "<td></td>";
                $msg .= "<td></td>";
                $msg .= "</tr>";
            }

            $conn->close();

            return $msg;
        }
        
        function removerProd($ref){
            global $conn;

            $msg = "";

            $sql = "DELETE FROM produtos WHERE ref = '".$ref."';";

            if ($conn->query($sql) === TRUE) {
            $msg = "Removido com sucesso";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();

            return $msg;

        }

        function getDadosProd($ref){
            global $conn;

            $sql = "SELECT * FROM produtos WHERE ref =".$ref.";";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
        
            $conn->close();

            return json_encode($row);

        }

        function guardaEdicaoProd($ref, $nome, $tipo, $descricao, $preco){

            global $conn;

            $msg = "";

            $sql = "UPDATE produtos SET 
            nome = '".$nome."' , tipo = '".$tipo."' , descricao = '".$descricao."', preco = '".$preco."' 
            WHERE ref =".$ref.";";

            if ($conn->query($sql) === TRUE) {
            $msg = "Edição efetuada";
            } else {
            $msg = "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();

            return $msg;

        }
    }
?>