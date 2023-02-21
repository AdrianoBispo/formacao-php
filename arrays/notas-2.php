<?php

$notas = [
    'Ana' => 10,
    'João' => 8,
    'Maria' => 9,
    'Roberto' => 7,
    'Vinícius' => 6
];

// Ordena as notas pelo valor em ordem crescente alterando o valor das chaves.
sort($notas);
var_dump($notas);

// Ordena as notas pelo valor em ordem decrescente alterando o valor das chaves.
asort($notas);
var_dump($notas);

// -----------------------------------------------------------------------------

// Ordena o valor das notas através das chaves, sendo a ordem crescente.
ksort($notas);
var_dump($notas);

// Ordena o valor das notas através das chaves, sendo a ordem decrescente.
krsort($notas);
var_dump($notas);