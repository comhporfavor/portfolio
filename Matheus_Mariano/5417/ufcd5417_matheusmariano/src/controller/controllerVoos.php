<?php

require_once '../model/modelVoos.php'; 

$Voo = new Voo();

if ($_POST['op'] == 1) {
    $resultado = $Voo->addVoo(
        $_POST['descricao'],
        $_POST['id_aviao'],
        $_POST['id_destino'],
        $_POST['estado'],
    );
    echo ($resultado);
}

if ($_POST['op'] == 2) {
    $resultado = $Voo->listarVoos();
    echo ($resultado);
}

if ($_POST['op'] == 3) {
    $resultado = $Voo->getInfoVoo($_POST['nif']);
    echo ($resultado);
}

if ($_POST['op'] == 4) {
    $resultado = $Voo->gravarEdicaoVoo(
        $_POST['id'],
        $_POST['descricao'],
        $_POST['id_aviao'],
        $_POST['id_destino'],
        $_POST['estado'],
    );
    echo ($resultado);
}

if ($_POST['op'] == 5) {
    $resultado = $Voo->excluirVoo($_POST['id']);
    echo ($resultado);
}


?>
