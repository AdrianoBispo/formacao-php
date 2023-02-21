<?php

$notas = [
    'Vinicius' => 6,
    'João' => 8,
    'Ana' => 10,
    'Roberto' => 7,
    'Maria' => 9
];

krsort($notas);
var_dump($notas);


// Verifica se a variável $notas é uma array de maneira direta
if (gettype($notas) === 'array') {
    echo 'Sim, é um array';
}

// Verifica se a variável $notas é uma array de maneira direta
if (is_array($notas)) {
    echo 'Sim, é um array';
}

// Verifica se uma array está listado em padrão númerica e retorna um valor booleano
var_dump(array_is_list($notas));