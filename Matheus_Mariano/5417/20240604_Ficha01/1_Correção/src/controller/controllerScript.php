<?php
require_once("..\model\modelScript.php");

$calc = new Calculos();

if($_POST['op'] == 1){
    $resposta = $calc->calculaVolume($_POST['areaBase'], $_POST['altura']);
    echo($resposta);
}else if($_POST['op'] == 2){
    $resposta = $calc->calculaExp($_POST['x'], $_POST['z'], $_POST['y']);
    echo($resposta);
}else if($_POST['op'] == 3){
    $resposta = $calc->calculaCredito($_POST['saldo']);
    echo($resposta);
}




?>