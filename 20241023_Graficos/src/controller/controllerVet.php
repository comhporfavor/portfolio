<?php
require_once '../model/modelVet.php';


if(isset($_POST['op']) && $_POST['op'] == 1){

	$vet = new Vet();
	$resultado = $vet -> getSelect($_POST['tabela'], $_POST['parametro']);
	echo($resultado);
}
// }else if(isset($_POST['op']) && $_POST['op'] == 2){

// 	$dados = new Dados();
// 	$resultado = $dados -> getDadosOrcamentos($_POST['ano']);
// 	echo($resultado);

// }else if(isset($_POST['op']) && $_POST['op'] == 3){
// 	$dados = new Dados();
// 	$resultado = $dados -> getProdutos();
// 	echo($resultado);
// }

?>