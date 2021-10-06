<?php 
function IncluiDigito($ean) {
    $digitos = str_split($ean);
    $soma = 0;
    foreach ($digitos as $i => $digito) {
        if (($i % 2) === 0) {
            $soma += $digito * 1;
        } else {
            $soma += $digito * 3;
        }
    }
    $resultado = floor($soma / 10) + 1;
    $resultado *= 10;
    $resultado -= $soma;
    if (($resultado % 10) === 0) {
        $ean = $ean . '0';
    } else {
        $ean = $ean . $resultado;
    }
    return $ean;
}