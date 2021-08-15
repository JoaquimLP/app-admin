<?php

function calcTotalProduto($qtb, $valor)
{
    $total = 0;

    $total = $qtb * $valor;

    return number_format($total, 2, ',', '.');
}

function maskDinheiro($value)
{
    return number_format($value, 2, ',', '.');
}

function maskCnpj($val)
{
    $mask = strlen($val) > 11 ? "##.###.###/####-##" : "###.###.###-##";

    $maskared = '';
    $k = 0;
    for ($i = 0; $i <= strlen($mask) - 1; ++$i) {
        if ($mask[$i] == '#') {
            if (isset($val[$k])) {
                $maskared .= $val[$k++];
            }
        } else {
            if (isset($mask[$i])) {
                $maskared .= $mask[$i];
            }
        }
    }

    return $maskared;
}

function maskTelCel($val)
{
    $mask = strlen($val) > 10 ? "(##) #####-####" : "(##) ####-####";

    $maskared = '';
    $k = 0;
    for ($i = 0; $i <= strlen($mask) - 1; ++$i) {
        if ($mask[$i] == '#') {
            if (isset($val[$k])) {
                $maskared .= $val[$k++];
            }
        } else {
            if (isset($mask[$i])) {
                $maskared .= $mask[$i];
            }
        }
    }

    return $maskared;
}

function maskCep($val)
{
    $mask = "#####-###";

    $maskared = '';
    $k = 0;
    for ($i = 0; $i <= strlen($mask) - 1; ++$i) {
        if ($mask[$i] == '#') {
            if (isset($val[$k])) {
                $maskared .= $val[$k++];
            }
        } else {
            if (isset($mask[$i])) {
                $maskared .= $mask[$i];
            }
        }
    }

    return $maskared;
}

function formatDateAndTime($value, $format = 'd/m/Y')
{
    // Utiliza a classe de Carbon para converter ao formato de data ou hora desejado
    return Carbon\Carbon::parse($value)->format($format);
}

function formatDateAndTimeIso($value, $format = 'Y-d-m')
{
    // Utiliza a classe de Carbon para converter ao formato de data ou hora desejado
    return Carbon\Carbon::parse($value)->format($format);
}

function tipo ($value)
{
    $tipo = '';
    if ($value == 'E') {
        $tipo = 'Entrada';
    }
    elseif ($value == 'S') {
        $tipo = 'Saida';
    }

    return $tipo;
}
