<?php
require_once '../model/modelUtilizador.php';

$user =  new Utilizador();

if($_POST['op'] == 1){
    $resultado = $user -> registarUtilizador($_POST['nome'], $_POST['morada'], $_POST['telefone']);
    echo($resultado);
}else if($_POST['op'] == 2){
    $resultado = $user -> listaUtilizadores();
    echo($resultado);
}else if($_POST['op'] == 3){
    $resultado = $user -> removerUtilizador($_POST['id']);
    echo($resultado);
}else if($_POST['op'] == 4){
    $resultado = $user -> getDadosUtilizador($_POST['id']);
    echo($resultado);
}else if($_POST['op'] == 5){
    $resultado = $user -> guardaEdicaoUtilizador($_POST['nome'], $_POST['morada'], $_POST['telefone'], $_POST['id']);
    echo($resultado);
}

?>