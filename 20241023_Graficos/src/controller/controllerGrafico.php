<?php
require_once '../model/modelGrafico.php';


if(isset($_POST['op']) && $_POST['op'] == 1){

	$dados = new Dados();
	$resultado = $dados -> getDadosPrecos($_POST['produto']);
	echo($resultado);

}else if(isset($_POST['op']) && $_POST['op'] == 2){

	$dados = new Dados();
	$resultado = $dados -> getDadosOrcamentos($_POST['ano']);
	echo($resultado);

}else if(isset($_POST['op']) && $_POST['op'] == 3){
	$dados = new Dados();
	$resultado = $dados -> getProdutos();
	echo($resultado);
}

?>