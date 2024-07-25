<?php

require_once '../model/modelPedidos.php'; 

$pedido = new Pedido();

if ($_POST['op'] == 1) {
    $reserva = $_POST['idReserva'];
    $pratos = json_decode($_POST['pratos'], true);
    $resultado = $pedido->addPedido($reserva, $pratos);
    echo ($resultado);
}
if ($_POST['op'] == 2) {
    $resultado = $pedido->listarPedidos();
    echo ($resultado);
}
if ($_POST['op'] == 3) {
    $resultado = $pedido->getInfoPedido($_POST['idPedido']);
    echo json_encode($resultado);
}
if ($_POST['op'] == 4) {
    $resultado = $pedido->gravarEdicaoPedido($_POST['idPedido'], $_POST['idEstado']);
    echo ($resultado);
}
if ($_POST['op'] == 5) {
    $resultado = $pedido->excluirPedido($_POST['idPedido']);
    echo ($resultado);
}
if ($_POST['op'] == 6) {
    $resultado = $pedido->listarPratosPedido($_POST['idPedido']);
    echo ($resultado);
}
if ($_POST['op'] == 7) {
    $resultado  = $pedido->encerrarPedido($_POST['idPedido']);
    echo json_encode($resultado);
}

?>
