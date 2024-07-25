<?php
require_once '../model/modelScript.php';

$res = new Registos();

if($_POST['op'] == 1){
    $resultado = $res -> validaIdade($_POST['idade']);
    echo($resultado);
}else if($_POST['op'] == 2){
    $resultado = $res -> tabelaParticipantes($_POST['lista']);
    echo($resultado);
}else if($_POST['op'] == 3){
    $resultado = $res -> tabelaParticipantesFiltrada($_POST['lista'],$_POST['workshop']);
    echo($resultado);
}
?>