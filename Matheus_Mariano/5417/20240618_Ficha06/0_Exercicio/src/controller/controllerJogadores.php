<?php
require_once '../model/modelJogadores.php';

$jog = new Jogador();

if($_POST['op'] == 1){
    $resultado = $jog -> addJogador($_POST['numFed'], $_POST['nomeJog'], $_POST['idadeJog'], $_POST['moradaJog'], $_POST['emailJog'], $_POST['telJog'], $_POST['selectClube'], $_FILES);
    echo($resultado);
}else if($_POST['op'] == 2){
    $resultado = $jog -> listarJogadores();
    echo($resultado);
}else if($_POST['op'] == 3){
    $resultado = $jog -> removerJogador($_POST['numFed']);
    echo($resultado);
}else if($_POST['op'] == 4){
    $resultado = $jog -> getDadosJogador($_POST['numFed']);
    echo($resultado);
}else if($_POST['op'] == 5){
    $resultado = $jog -> guardaEdicaoJogador($_POST['oldNumFed'], $_POST['newNumFed'], $_POST['nomeJog'], $_POST['idadeJog'], $_POST['moradaJog'], $_POST['emailJog'], $_POST['telJog'], $_POST['selectClube'], $_FILES);
    echo($resultado);
}
?>