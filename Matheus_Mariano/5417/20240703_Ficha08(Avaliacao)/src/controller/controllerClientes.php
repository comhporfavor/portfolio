<?php

require_once '../model/modelClientes.php'; 

$cliente = new Cliente();

if ($_POST['op'] == 1) {
    $resultado = $cliente->valida($_POST['nif']);
    header('Content-Type: application/json'); // Assegure-se de que o cabeçalho está correto
    echo json_encode(['array' => $resultado]); 
}
if ($_POST['op'] == 2) {
    $resultado = $cliente->addCliente($_POST['nif'], $_POST['nome'], $_POST['morada'], $_POST['telefone'], $_POST['email']);
    echo ($resultado);
}    
if ($_POST['op'] == 3) {
    
}
if ($_POST['op'] == 4){
    $resultado = $cliente->getInfoCliente($_POST['nif']);
    echo ($resultado);
}
if ($_POST['op'] == 5){
    $resultado = $cliente->gravarEdicaoCliente($_POST['nif'], $_POST['nome'], $_POST['morada'], $_POST['telefone'], $_POST['email'], $_POST['oldNif']);
    echo ($resultado);
}
if ($_POST['op'] == 6){
    $resultado = $cliente->listarClientes();
    echo ($resultado);   
}

?>
