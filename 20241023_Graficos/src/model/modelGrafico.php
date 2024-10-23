<?php

require_once 'config.php';

class Dados{

    function getProdutos(){

    global $conn;
    $sql = "SELECT DISTINCT idProduto FROM historicoaltprecos";
    $msg = "<option value='-1'>Escolha um Produto</option>";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

      $msg .= "<option value='".$row['idProduto']."'>".$row['idProduto']."</option>";
        
    }
    } else {
      $msg = "Sem Resultados";
    
    }

    $conn->close();

    return $msg;
    }

    function getDadosPrecos($produto){

    	global $conn;
    	$sql = "SELECT * From historicoAltPrecos WHERE idProduto = ".$produto;
    	$result = $conn->query($sql);
    	
    	$datas = array();
        $precos = array();

    	if($result->num_rows > 0){

    		while($row = $result->fetch_assoc()){

                $date = $row['dth'];
                $dt = new DateTime($date);
                $dt = $dt->format('d-m-Y');

                array_push($datas, $dt);
                array_push($precos, $row['precoAntigo']);

    		}

    	}

        $resultado = array ("datas"=>$datas, "precos" => $precos);
        $resultado = json_encode($resultado);

        return($resultado);

    }


    function getDadosOrcamentos($ano){

        global $conn;
        $totais = array();

        for($i = 1; $i<=12; $i++){

            $sql = "SELECT SUM(valorTotal) as Total From orcamento WHERE YEAR(dth) = ".$ano." AND MONTH(dth) = ".$i;
            $result = $conn->query($sql);

            if($result->num_rows > 0){

                while($row = $result->fetch_assoc()){

                    array_push($totais, $row['Total']);

                }
            }
        }
            
        $resultado = array ("total"=>$totais);
        $resultado = json_encode($resultado);

        return($resultado);

    }
}



?>