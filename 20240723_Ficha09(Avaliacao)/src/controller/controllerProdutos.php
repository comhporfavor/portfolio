<?php

require_once '../model/modelProdutos.php'; 

$produto = new Produto();

if ($_POST['op'] == 1) {
    $resultado = $produto->addProduto(
                                $_POST['descricao'], 
                                $_POST['valor'], 
                                $_POST['tipo'], 
                                $_FILES,  
                                $_POST['stock']
                            );
    echo ($resultado);
}

if ($_POST['op'] == 2) {
    $resultado = $produto->listarProdutos();
    echo ($resultado);
}





?>