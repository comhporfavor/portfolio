<?php

require_once '../model/modelReservas.php'; 

$reserva = new Reserva();

if ($_POST['op'] == 1) {
    $resultado = $reserva->addReserva($_POST['selectCliente'], $_POST['selectMesa'], $_POST['data'], $_POST['hora']);
    echo ($resultado);
}    
if ($_POST['op'] == 2){
    $resultado = $reserva->getInfoReserva($_POST['id']);
    echo ($resultado);
}
if ($_POST['op'] == 3){
    $resultado = $reserva->gravarEdicaoReserva($_POST['id'], $_POST['dataReserva'], $_POST['hora'], $_POST['estado']);
    echo ($resultado);
}
if ($_POST['op'] == 4){
    $resultado = $reserva->listarReservas();
    echo ($resultado);   
}
if ($_POST['op'] == 5){
    $resultado = $reserva->excluirReserva($_POST['id']);
    echo json_encode($resultado);
}
if ($_POST['op'] == 6){
    $resultado = $reserva->getReservas();
    echo ($resultado);
}

?>
