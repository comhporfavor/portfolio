<?php
require_once '../model/modelTipo.php';

$tipo = new TipoProduto();

if($_POST['op'] == 1){
    $resultado = $tipo -> addTipo($_POST['novoTipo']);
    echo($resultado);
} else if($_POST['op'] == 2){
    $resultado = $tipo -> getSelect();
    echo($resultado);
}


?>