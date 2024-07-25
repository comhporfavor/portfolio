<?php
require_once '../model/modelProdutos.php';

$prod =  new Produto();

if($_POST['op'] == 1){
    $resultado = $prod -> addProduto($_POST['nomeProduto'], $_POST['tipoProduto'], $_POST['descProduto'], $_POST['precoProduto']);
    echo($resultado);
}else if($_POST['op'] == 2){
    $resultado = $prod -> listarProdutos();
    echo($resultado);
}else if($_POST['op'] == 3){
    $resultado = $prod -> removerProd($_POST['ref']);
    echo($resultado);
}else if($_POST['op'] == 4){
    $resultado = $prod -> getDadosProd($_POST['ref']);
    echo($resultado);
}else if($_POST['op'] == 5){
    $resultado = $prod -> guardaEdicaoProd($_POST['ref'], $_POST['nome'], $_POST['tipo'], $_POST['descricao'], $_POST['preco']);
    echo($resultado);
}

?>