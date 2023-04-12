<?php

$altura = 1.71;
$peso = 75;

$calculo = $peso / $altura ** 2;

if ($calculo < 18.5 ) {
    echo "Seu IMC é $calculo, você está magro.";
} elseif ($calculo >= 18.5 && $calculo < 24.9 ) {
    echo "Seu IMC é $calculo, você está com o peso ideal.";
} elseif ($calculo >= 25 && $calculo < 29.9 ) {
    echo "Seu IMC é $calculo, você está sobrepeso.";
} elseif ($calculo >= 30 && $calculo < 39.9 ) {
    echo "Seu IMC é $calculo, você está obeso.";
} else {
    echo "Seu IMC é $calculo, você está com obesidade grave";
}
