<?php

class Calculos{

    function soma($n1, $n2){

        $msg = $n1+$n2;

        return $msg;

    }

    function divisao($n1, $n2){
        return($n1/$n2);
    }

    function subtracao($n1, $n2){
        return($n1-$n2);
    }  

    function multiplicacao($n1, $n2){
        return($n1*$n2);
    }


    function soma2($n1, $n2){
        $res = $n1+$n2;
        $info = "";

        if($res > 10){
            $info = "Soma superior a 10";
        }else{
            $info = "Soma igual ou inferior a 10";
        }

        $msg = array(
            "resultado" => $res,
            "informacao" => $info
        );

        return(json_encode($msg));
    }
}

?>