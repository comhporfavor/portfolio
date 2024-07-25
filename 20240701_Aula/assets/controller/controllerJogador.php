<?php

require_once '../model/modelJogador.php';

$jog = new Jogador();

if($_POST['op'] == 1){
    $resp = $jog -> registaJogador(
        $_POST['numJogador'],
        $_POST['nome'],
        $_POST['idade'],
        $_POST['telefone'],
        $_POST['email'],
        $_POST['morada'],
        $_POST['clube'],
        $_FILES
    );
    echo ($resp);

}else if($_POST['op'] == 2){
    $resp = $jog -> getListaJogadores();
    echo($resp);

}else if($_POST['op'] == 3){
    $resp = $jog -> removerJogador($_POST['num']);
    echo($resp);

}else if($_POST['op'] == 4){
    $resp = $jog -> getDadosJogador($_POST['num']);
    echo($resp);

}else if($_POST['op'] == 5){
    $resp = $jog -> guardaEditJogador(
        $_POST['numJogador'],
        $_POST['nome'],
        $_POST['idade'],
        $_POST['telefone'],
        $_POST['email'],
        $_POST['morada'],
        $_POST['clube'],
        $_POST['numOld'],
        $_FILES
    );
    echo ($resp);

}





?>