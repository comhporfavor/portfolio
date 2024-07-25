<?php

require_once("../model/modelScript.php");

$calc = new Calculos();

if ($_POST['op'] == 1) {
    $nomeAluno = $_POST['nomeAluno'];
    $nota1 = $_POST['nota1'];
    $nota2 = $_POST['nota2'];
    $nota3 = $_POST['nota3'];

    $resposta = $calc->calculaMedia($nomeAluno, $nota1, $nota2, $nota3);
    echo json_encode($resposta);

} else if ($_POST['op'] == 2) {
    $dist = $_POST['dist'];
    $tempo = $_POST['tempo'];

    $resposta = $calc->calculaVelocidade($dist, $tempo);
    echo json_encode($resposta);

} else if ($_POST['op'] == 3) {
    $resposta = $calc -> listarVeiculos($_POST['veiculos']);
    echo json_encode($resposta);
}

?>
