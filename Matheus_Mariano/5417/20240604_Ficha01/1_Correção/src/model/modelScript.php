<?php

class Calculos{
    function calculaVolume($areaBase, $altura){
        return ((1/3)*$areaBase*$altura);
    }

    function calculaExp($valorX,$valorZ,$valorY){
        $a = ($valorX+$valorX)*($valorX+$valorX);
        $b = ($valorY*$valorX)+$valorZ;
        $c = $valorX*$valorZ;

        $res = ($a+$b)/$c;
        $info = "";

        if($res > 100){
            $info = "valor superior a 100";
        }else{
            $info = "valor inferior ou igual a 100";
        }

        return (json_encode(array("info" => $info, "resultado" => $res)));
    }

    function calculaCredito($conta){

        $arr = json_decode($conta);
        $saldo = 0;

        for($i = 0; $i < sizeof($arr); $i++){
            $saldo += $arr[$i];
        }

        $msg = "";

        if($saldo > 0 && $saldo <= 200){
            $msg = "Sem crédito";
        }else if($saldo >= 201 && $saldo <= 400){
            $msg = "20% do valor do saldo";
        }else if($saldo >= 401 && $saldo <= 600){
            $msg = "30% do valor do saldo";
        }else if($saldo >= 601){
            $msg = "40% do valor do saldo";
        }

        return (json_encode(array("saldo" => $saldo, "msg" => $msg)));

    }
}

?>