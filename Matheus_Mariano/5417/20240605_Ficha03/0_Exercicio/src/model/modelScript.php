<?php

class Calculos {

    function validaIdade($idade){
        $flag = false;
        if ($idade >= 16){
            $flag = true;
        }
        return $flag;
    }    
    
    function listarParticipantes($participantes){
        $participantes = json_decode($participantes);
        $lista = "";
        for($j = 0; $j < sizeof($participantes); $j++) {
            $lista.= "<tr>";
            $lista.= "<td>".$participantes[$j][0]."</td>";
            $lista.= "<td>".$participantes[$j][1]."</td>";
            $lista.= "<td>".$participantes[$j][2]."</td>";
            $lista.= "<td>".$participantes[$j][3]."</td>";
            $lista.= "<td>".$participantes[$j][4]."</td>";
            $lista.= "<td>".$participantes[$j][5]."</td>";
            }
        return $lista;
    }

    function filtrarPorWorkshop($filtro, $participantes){
        $participantes = json_decode($participantes);
        $lista = "";
        for($j = 0; $j < sizeof($participantes); $j++) {
            if ($participantes[$j][5] == $filtro){
            $lista.= "<tr>";
            $lista.= "<td>".$participantes[$j][0]."</td>";
            $lista.= "<td>".$participantes[$j][1]."</td>";
            $lista.= "<td>".$participantes[$j][2]."</td>";
            $lista.= "<td>".$participantes[$j][3]."</td>";
            $lista.= "<td>".$participantes[$j][4]."</td>";
            }
        }
        return $lista;
    }
}

?>
