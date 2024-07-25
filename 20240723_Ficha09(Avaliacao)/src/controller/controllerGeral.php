<?php

require_once '../model/modelGeral.php'; 

$geral = new Geral();

if ($_POST['op'] == 0) {
    $resultado = $geral->getSelect($_POST['tabela'], $_POST['parametro']);
   echo ($resultado);
}

?>
