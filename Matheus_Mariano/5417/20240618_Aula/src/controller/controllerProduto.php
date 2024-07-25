<?php
require_once '../model/modelProduto.php';

$produto = new Produto();

if($_POST['op'] == 1){
    $resposta = $produto -> registarProduto(
        $_POST['ref'], 
        $_POST['nome'], 
        $_POST['descricao'], 
        $_POST['preco'], 
        $_POST['tipo'],
        $_FILES);
    echo($resposta);
}else if($_POST['op'] == 2){
    $resposta = $produto -> listarProdutos();
    echo($resposta);
}else if($_POST['op'] == 3){
    $resposta = $produto -> removerProduto($_POST['ref']);
    echo($resposta);
}else if($_POST['op'] == 4){
    $resposta = $produto -> getDadosProduto($_POST['ref']);
    echo($resposta);
}else if($_POST['op'] == 5){
    $resposta = $produto -> editProduto($_POST['ref'], $_POST['nome'], $_POST['descricao'], $_POST['preco'], $_POST['refOld'], $_POST['tipo']);
    echo($resposta);
}else if($_POST['op'] == 6){
    $resposta = $produto -> getTiposProduto();
    echo($resposta);
}
?>