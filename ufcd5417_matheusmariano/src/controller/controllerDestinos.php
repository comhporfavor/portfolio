<?php

require_once '../model/modelDestinos.php'; 

$destino = new Destino();

if ($_POST['op'] == 1) {
    $resultado = $destino->addDestino(
        $_POST['descricao'],
        $_POST['localidade'],
        $_POST['observacoes'],
        $_POST['valor'],
        $_FILES,
    );
    echo ($resultado);
}

if ($_POST['op'] == 2) {
    $resultado = $destino->listarDestinos();
    echo ($resultado);
}

?>
