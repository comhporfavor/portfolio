<?php

require_once("../model/modelScript.php");

$calc = new Calculos();

if ($_POST['op'] == 1) {
    $idadeParticipante = $_POST['idadeParticipante'];
    $resposta = $calc->validaIdade($idadeParticipante);
    echo ($resposta);

} else if ($_POST['op'] == 2) {
    $resposta = $calc->listarParticipantes($_POST['participantes']);
    echo ($resposta);

} else if ($_POST['op'] == 3) {
    $resposta = $calc->filtrarPorWorkshop($_POST['filtroWorkshop'], $_POST['participantes']);
    echo ($resposta);
}

?>
