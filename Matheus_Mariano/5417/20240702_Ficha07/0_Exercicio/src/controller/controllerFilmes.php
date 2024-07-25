<?php
require_once '../model/modelFilmes.php';

$filme =  new Filme();

if($_POST['op'] == 1){
    $resultado = $filme -> addTipo($_POST['descTipoFilme']);
    echo($resultado);
}else if($_POST['op'] == 2){
    $resultado = $filme -> addFilme($_POST['nomeFilme'], $_POST['anoFilme'], $_POST['descFilme'], $_POST['tipoFilme'], $_FILES);
    echo($resultado);
}else if($_POST['op'] == 3){
    $resultado = $filme -> getInfoFilme($_POST['idFilme']);
    echo($resultado);
}else if($_POST['op'] == 4){
    $resultado = $filme -> listarFilmes();
    echo($resultado);
}else if($_POST['op'] == 5){
    $resultado = $filme -> removerFilme($_POST['idFilme']);
    echo($resultado);
}else if($_POST['op'] == 6){
    $resultado = $filme -> getTipos();
    echo($resultado);
}else if($_POST['op'] == 7){
    $resultado = $filme -> getFilmes();
    echo($resultado);
}else if($_POST['op'] == 8){
    $resultado = $filme -> gravarEdicaoFilme($_POST['idFilme'] ,$_POST['nomeFilme'], $_POST['anoFilme'], $_POST['descFilme'], $_POST['tipoFilme'], $_FILES);
    echo($resultado);
}else if($_POST['op'] == 0 ){
    $resultado = $filme -> countFilmes();
    echo($resultado);
}

?>