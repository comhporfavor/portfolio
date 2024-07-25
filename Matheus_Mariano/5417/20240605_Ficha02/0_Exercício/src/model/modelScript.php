<?php

class Calculos {
    
    function calculaMedia($nomeAluno, $nota1, $nota2, $nota3){
        $media = ($nota1 + $nota2 + $nota3) / 3;
        $info = $media >= 9.5 ? "Aprovado" : "Reprovado";
        return array("nomeAluno" => $nomeAluno, "info" => $info, "resultado" => $media);
    }

    function calculaVelocidade($dist, $tempo){
        $velocidade = $dist / $tempo;

        if ($velocidade <= 90){
            $comentario = "Velocidade correta";
        } else if ($velocidade <= 120){
            $comentario = "Velocidade excessiva";
        } else {
            $comentario = "Velocidade muito excessiva";
        }

        return array("velocidade" => $velocidade, "comentario" => $comentario);
    }


    function listarVeiculos($veiculos) {
        $veiculos = json_decode($veiculos);
        $lista = "";
        $totalKms = 0;

        for($j = 0; $j < sizeof($veiculos); $j++) {
            $lista .= "<tr>";
            $lista .= "<td>".$veiculos[$j][1]."</td>";
            $lista .= "<td>".$veiculos[$j][0]."</td>";
            $lista .= "<td>".$veiculos[$j][2]."</td>";
            $lista .= "</tr>";
            $totalKms +=$veiculos[$j][2];
        }

        return array("lista" => $lista, "totalKms" => $totalKms);
    }
}
?>
