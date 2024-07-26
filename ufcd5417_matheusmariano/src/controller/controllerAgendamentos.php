<?php

require_once '../model/modelAgendamentos.php'; 

$Agendamento = new Agendamento();

if ($_POST['op'] == 1) {
    $resultado = $Agendamento->addAgendamento(
        $_POST['id_cliente'],
        $_POST['id_voo'],
        $_POST['qtd_passageiros'],
        $_POST['valor_total']
    );
    echo ($resultado);
}

if ($_POST['op'] == 2) {
    $resultado = $Agendamento->listarAgendamentos($_POST['id_voo']);
    echo ($resultado);
}

if ($_POST['op'] == 3) {
    $resultado = $Agendamento->getInfoAgendamento($_POST['nif']);
    echo ($resultado);
}

if ($_POST['op'] == 5) {
    $resultado = $Agendamento->excluirAgendamento($_POST['id']);
    echo ($resultado);
}


?>
