<?php
require_once '../model/modelSalas.php';

$sala =  new Sala();

if($_POST['op'] == 1){
    $resultado = $sala -> addSala($_POST['descSala'], $_POST['cineSala']);
    echo($resultado);
}else if($_POST['op'] == 2){
    $resultado = $sala -> getSalas();
    echo($resultado);
}else if($_POST['op'] == 3){
    $resultado = $sala -> getInfoSala($_POST['idSala']);
    echo($resultado);
}else if($_POST['op'] == 4){
    $resultado = $sala -> gravarEdicaoSala($_POST['idSala'], $_POST['descSala'], $_POST['cineSala']);
    echo($resultado);
} else if($_POST['op'] == 5){
    $resultado = $sala -> listarSalas();
    echo($resultado);
}else if($_POST['op'] == 6){
    $resultado = $sala -> removerSala($_POST['idSala']);
    echo($resultado);
}

?>