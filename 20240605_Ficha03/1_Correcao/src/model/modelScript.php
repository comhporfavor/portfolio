<?php

class Registos{

    function validaIdade($idade){

        $flag = true;

        if( $idade > 16){
            $flag = false;
        }

        return $flag;
    }


    function tabelaParticipantes($listaParticipantes){

        $txt = " <table class='table'>";
        $txt .= "<thead>";
        $txt .= "<tr>";
        $txt .= "<th scope='col'>#</th>";
        $txt .= "<th scope='col'>Nome</th>";
        $txt .= "<th scope='col'>Idade</th>";
        $txt .= "</tr>";
        $txt .= "</thead>";
        $txt .= "<tbody>";

        $listaParticipantes = json_decode($listaParticipantes);
          

        for($i = 0; $i < sizeof($listaParticipantes); $i++){
            $txt .= "<tr>";
            $txt .= "<th scope='row'>".($i+1)."</th>";
            $txt .= "<td>".$listaParticipantes[$i][0]."</td>";
            $txt .= "<td>".$listaParticipantes[$i][1]."</td>";
            $txt .= "</tr>";
        }


        $txt .= "</tbody>";
        $txt .= "</table>";

        return $txt;
    }


    function tabelaParticipantesFiltrada($listaParticipantes, $workshop){

        $txt = " <table class='table'>";
        $txt .= "<thead>";
        $txt .= "<tr>";
        $txt .= "<th scope='col'>#</th>";
        $txt .= "<th scope='col'>Nome</th>";
        $txt .= "<th scope='col'>Idade</th>";
        $txt .= "<th scope='col'>Workshop</th>";
        $txt .= "</tr>";
        $txt .= "</thead>";
        $txt .= "<tbody>";

        $listaParticipantes = json_decode($listaParticipantes);
          

        for($i = 0; $i < sizeof($listaParticipantes); $i++){
            if($workshop == $listaParticipantes[$i][2]){
                $txt .= "<tr>";
                $txt .= "<th scope='row'>".($i+1)."</th>";
                $txt .= "<td>".$listaParticipantes[$i][0]."</td>";
                $txt .= "<td>".$listaParticipantes[$i][1]."</td>";
                $txt .= "<td>".$listaParticipantes[$i][2]."</td>";
                $txt .= "</tr>";
            }
        }


        $txt .= "</tbody>";
        $txt .= "</table>";

        return $txt;
    }


    
}

?>