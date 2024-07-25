<?php

class Resultados{

    function calcularMedia($nt1, $nt2, $nt3){

        $media = ($nt1 + $nt2 + $nt3)/3;
        $estado = "";

        if($media >= 9.5){
            $estado = "Aprovado";
        }else{
            $estado = "Reprovado";
        }

        return (json_encode(array("estado" => $estado, "media" => $media)));

    }

    function calcularVelocidadeMedia($dist, $temp){
        $vm = $dist/$temp;
        $info = "";

        if($vm <= 90){
            $info = "Velocidade Correta";
        }else if($vm <= 120){
            $info = "Velocidade Excessiva";
        }else{
            $info = "Velocidade Muito Excessiva";
        }

        return (json_encode(array("vm" => $vm, "informacao" => $info)));
    }

    function listaVeiculos($veiculos){

        $veiculos = json_decode($veiculos);
        $msg = "";
        $soma = 0;

        for($i = 0; $i < sizeof($veiculos); $i++){

            $msg .= "<tr>";
            $msg .= "<th scope='row'>".($i+1)."</th>";
            $msg .= "<td>".$veiculos[$i][0]."</td>";
            $msg .= "<td>".$veiculos[$i][1]."</td>";
            $msg .= "<td>".$veiculos[$i][2]."</td>";
            $msg .= "</tr>";

            $soma += $veiculos[$i][2];
        }

        $msg .= "<tr>";
        $msg .= "<th scope='row'></th>";
        $msg .= "<td></td>";
        $msg .= "<th>Total Kms:</th>";
        $msg .= "<td>".$soma."</td>";
        $msg .= "</tr>";

        return $msg;
    }

    
}

?>