<?php

require_once '../model/modelPratos.php'; 

$prato = new Prato();

if ($_POST['op'] == 1) {
    $resultado = $prato->addPrato($_POST['nome'], $_POST['preco'], $_POST['tipoPrato'], $_FILES);
    echo ($resultado);
}    
if ($_POST['op'] == 2){
    $resultado = $prato->getInfoPrato($_POST['id']);
    echo ($resultado);
}
if ($_POST['op'] == 3){
    $resultado = $prato->gravarEdicaoPrato($_POST['id'], $_POST['nome'], $_POST['preco'], $_POST['idTipo'], $_FILES);
    echo ($resultado);
}
if ($_POST['op'] == 4){
    $resultado = $prato->listarPratos($_POST['pagina']);
    echo ($resultado);   
}
if ($_POST['op'] == 5){
    $resultado = $prato->excluirPrato($_POST['id']);
    echo ($resultado);
}

?>
