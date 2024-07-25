<?php
require_once '../model/modelScript.php';

$calculos = new Resultados();

if($_POST['op'] == 1){
    $resultado = $calculos -> calcularMedia($_POST['nota1'], $_POST['nota2'], $_POST['nota3']);
    echo($resultado);

}else if($_POST['op'] == 2){
    $resultado = $calculos -> calcularVelocidadeMedia ($_POST['distancia'], $_POST['tempo']);
    echo($resultado);
}else if($_POST['op'] == 3){
    $resultado = $calculos -> listaVeiculos($_POST['veiculos']);
    echo($resultado);
}
?>