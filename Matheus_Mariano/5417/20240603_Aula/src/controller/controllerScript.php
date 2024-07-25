<?php
require_once("..\model\modelScript.php");

$calc = new Calculos();

if($_POST['op'] == 1){
    $resposta = $calc->soma($_POST['numero1'], $_POST['numero2']);
    echo($resposta);
}else if($_POST['op'] == 2){
    $resposta = $calc->divisao($_POST['numero1'], $_POST['numero2']);
    echo($resposta);
}else if($_POST['op'] == 3){
    $resposta = $calc->subtracao($_POST['numero1'], $_POST['numero2']);
    echo($resposta);
}else if($_POST['op'] == 4){
    $resposta = $calc->multiplicacao($_POST['numero1'], $_POST['numero2']);
    echo($resposta);
}else if($_POST['op'] == 5){
    $resposta = $calc->soma2($_POST['numero1'], $_POST['numero2']);
    echo($resposta);
}




?>