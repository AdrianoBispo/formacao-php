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

// Verifica se a chave existe e retorna um valor booleano
var_dump(array_key_exists('Tiago', $notas)); // false

// Verifica se o valor da chave existe e se é diferente de "null" e retorna um valor booleano
var_dump(isset($notas['Vinicius'])); // true