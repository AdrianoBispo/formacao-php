<?php

// STRINGS NÚMERICAS

$anoDeNascimento = '2004';
$idade = 2022 - $anoDeNascimento; 

// Converte o tipo string para número 
if ($anoDeNascimento == ' 2004') {
    echo "VERDADEIRO" . PHP_EOL;
} 

// Converte o tipo string para número 
if ($anoDeNascimento == '2004 ') {
    echo "VERDADEIRO" . PHP_EOL;
}

// Converte o tipo string para número 
if ($anoDeNascimento == ' 2004 ') {
    echo "VERDADEIRO" . PHP_EOL;
}

// Converte o tipo string para número 
if ($anoDeNascimento == 2004) {
    echo "VERDADEIRO" . PHP_EOL;
}

// Verifica se o tipo de dado e se valor é igual
if ($anoDeNascimento === 2004) {
    echo 'VERDADEIRO' . PHP_EOL;
} else {
    echo 'FALSO' . PHP_EOL;
}

// Antes da versão 8.0 isso retornaria VERDADEIRO
$anoDeNascimento = 'a2004';
if ($anoDeNascimento == 0) {
    echo 'VERDADEIRO' . PHP_EOL;
} else {
    echo 'FALSO';
}