<?php

require_once '../model/modelClube.php';

$club = new Clube();

if($_POST['op'] == 1){
    $resp = $club -> registaClube(
        $_POST['nome'],
        $_POST['anoFundacao'],
        $_POST['telefone'],
        $_POST['email'],
        $_POST['localidade'],
        $_FILES
    );
    echo ($resp);

}else if($_POST['op'] == 2){
    $resp = $club -> getListaClubes();
    echo($resp);

}else if($_POST['op'] == 3){
    $resp = $club -> removeClube($_POST['id']);
    echo($resp);

}else if($_POST['op'] == 4){
    $resp = $club -> getDadosClube($_POST['id']);
    echo($resp);

}else if($_POST['op'] == 5){
    $resp = $club -> guardaEditClube(
        $_POST['nome'],
        $_POST['anoFundacao'],
        $_POST['telefone'],
        $_POST['email'],
        $_POST['localidade'],
        $_POST['id'],
        $_FILES
    );
    echo ($resp);

}else if($_POST['op'] == 6){
    $resp = $club -> getSelectClube();
    echo($resp);

}





?>