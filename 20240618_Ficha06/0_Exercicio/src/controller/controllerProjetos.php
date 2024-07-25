<?php
require_once '../model/modelProjetos.php';

$proj = new Projeto();

if($_POST['op'] == 1){
    $resultado = $proj -> addProjeto($_POST['descProj'], $_POST['tipoProj'], $_POST['clienteProj']);
    echo($resultado);
} else if($_POST['op'] == 2){
    $resultado = $proj -> listarProjetos();
    echo($resultado);
} else if($_POST['op'] == 3){
    $resultado = $proj -> removerProjeto($_POST['idProj']);
}


?>