<?php
require_once '../model/modelSessoes.php';

$sessao =  new Sessao();

if($_POST['op'] == 1){
    $resultado = $sessao -> filtrarSalas($_POST['idCinema']);
    echo($resultado);
}else if($_POST['op'] == 2){
    $resultado = $sessao -> addSessao($_POST['filmeSessao'], $_POST['salaSessao'], $_POST['dataSessao'], $_POST['horaSessao'], $_POST['estadoSessao']);
    echo($resultado);
}else if($_POST['op'] == 3){
    $resultado = $sessao -> getSessoes();
    echo($resultado);
}else if($_POST['op'] == 4){
    $resultado = $sessao -> getInfoSessao($_POST['idSessao']);
    echo($resultado);
} else if($_POST['op'] == 5){
    $resultado = $sessao -> editarSessao($_POST['filmeSessao'], $_POST['salaSessao'], $_POST['dataSessao'], $_POST['horaSessao'], $_POST['estadoSessao'], $_POST['idSessao'],);
    echo($resultado);
}else if($_POST['op'] == 6){
    $resultado = $sessao -> listarSessoes();
    echo($resultado);
}else if($_POST['op'] == 7){
    $resultado = $sessao -> removerSessao($_POST['idSessao']);
    echo($resultado);
}else if($_POST['op'] == 8){
    $resultado = $sessao -> alteraEstado($_POST['idSessao'], $_POST['estadoSessao']);
    echo($resultado);
}

?>