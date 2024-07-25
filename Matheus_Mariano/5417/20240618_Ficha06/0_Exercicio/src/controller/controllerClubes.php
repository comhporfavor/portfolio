<?php
require_once '../model/modelClubes.php';

$clube =  new Clube();

if($_POST['op'] == 1){
    $resultado = $clube -> addClube($_POST['nomeClube'], $_POST['localClube'], $_POST['emailClube'], $_POST['anoFund'], $_POST['telClube'], $_FILES);
    echo($resultado);
}else if($_POST['op'] == 2){
    $resultado = $clube -> listarClubes();
    echo($resultado);
}else if($_POST['op'] == 3){
    $resultado = $clube -> removerClube($_POST['idClube']);
    echo($resultado);
}else if($_POST['op'] == 4){
    $resultado = $clube -> getDadosClube($_POST['idClube']);
    echo($resultado);
}else if($_POST['op'] == 5){
    $resultado = $clube -> guardaEdicaoClube($_POST['idClube'], $_POST['nomeClube'], $_POST['localClube'], $_POST['emailClube'], $_POST['anoFund'], $_POST['telClube'], $_FILES);
    echo($resultado);
}else if($_POST['op'] == 6){
    $resultado = $clube -> getSelect();
    echo($resultado);
}

?>