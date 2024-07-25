<?php
require_once '../model/modelClientes.php';

$cliente =  new Cliente();

if($_POST['op'] == 1){
    $resultado = $cliente -> addCliente($_POST['nifCliente'], $_POST['nomeCliente'], $_POST['localCliente'], $_POST['emailCliente'], $_POST['telCliente']);
    echo($resultado);
}else if($_POST['op'] == 2){
    $resultado = $cliente -> listarClientes();
    echo($resultado);
}else if($_POST['op'] == 3){
    $resultado = $cliente -> removerCliente($_POST['idCliente']);
    echo($resultado);
}else if($_POST['op'] == 4){
    $resultado = $cliente -> getDadosCliente($_POST['idCliente']);
    echo($resultado);
}else if($_POST['op'] == 5){
    $resultado = $cliente -> guardaEdicaoCliente($_POST['idCliente'], $_POST['nifCliente'], $_POST['nomeCliente'], $_POST['localCliente'], $_POST['emailCliente'], $_POST['telCliente']);
    echo($resultado);
}else if($_POST['op'] == 6){
    $resultado = $cliente -> getSelect();
    echo($resultado);
}

?>