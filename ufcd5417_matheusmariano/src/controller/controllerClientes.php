<?php
 // teste 

require_once '../model/modelClientes.php'; 

$cliente = new Cliente();

if ($_POST['op'] == 1) {
    $resultado = $cliente->addCliente(
        $_POST['nif'],
        $_POST['nome'],
        $_POST['morada'],
        $_POST['telefone'],
        $_POST['email'],
        $_POST['idade'],
        $_POST['tipoCliente']
    );
    echo ($resultado);
}

if ($_POST['op'] == 2) {
    $resultado = $cliente->listarClientes();
    echo ($resultado);
}

if ($_POST['op'] == 3) {
    $resultado = $cliente->getInfoCliente($_POST['nif']);
    echo ($resultado);
}

if ($_POST['op'] == 4) {
    $resultado = $cliente->gravarEdicaoCliente(
        $_POST['oldNif'],
        $_POST['nif'],
        $_POST['nome'],
        $_POST['morada'],
        $_POST['telefone'],
        $_POST['email'],
        $_POST['oldEmail'],
        $_POST['idade'],
        $_POST['tipoCliente']
    );
    echo ($resultado);
}


?>
