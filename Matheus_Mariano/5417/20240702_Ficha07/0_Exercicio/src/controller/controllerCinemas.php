<?php
require_once '../model/modelCinemas.php';

$cine =  new Cinema();

if($_POST['op'] == 1){
    $resultado = $cine -> registraLocal($_POST['descLocal']);
    echo($resultado);
}else if($_POST['op'] == 2){
    $resultado = $cine -> registraCinema($_POST['nomeCinema'], $_POST['localCinema']);
    echo($resultado);
}else if($_POST['op'] == 3){
    $resultado = $cine -> getInfoCinema($_POST['idCinema']);
    echo($resultado);
}else if($_POST['op'] == 4){
    $resultado = $cine -> listarCinemas();
    echo($resultado);
}else if($_POST['op'] == 5){
    $resultado = $cine -> removerCinema($_POST['idCinema']);
    echo($resultado);
}else if($_POST['op'] == 6){
    $resultado = $cine -> selectLocal();
    echo($resultado);
}else if($_POST['op'] == 7){
    $resultado = $cine -> getCinemas();
    echo($resultado);
}else if($_POST['op'] == 8){
    $resultado = $cine -> gravarEdicaoCinema($_POST['nomeCinema'], $_POST['localCinema'], $_POST['idCinema']);
    echo($resultado);
}else if($_POST['op'] == 0){
    $resultado = $cine -> countCinemas();
    echo($resultado);
}


?>