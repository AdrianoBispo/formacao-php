<?php 

$notas = [
    'Vinicius' => null,
    'João' => 8,
    'Ana' => '10',
    'Roberto' => 7,
    'Maria' => 9
];

krsort($notas);
var_dump($notas);

echo 'Alguém tirou 10?' . PHP_EOL;
// Verifica se existe o valor(10) existe e retorna um valor booleano
var_dump(in_array(10, $notas)); // true

echo 'Alguém tirou 10?' . PHP_EOL;
// Podemos, também, escrever assim. Adicionando um terceiro parâmetro.
// Esse terceiro parâmetro impede que uma string númerica seja convertida.
var_dump(in_array(10, $notas, true)); // false

echo 'Alguém tirou 10?' . PHP_EOL;
// Verifica se o valor existe e retorna informando sua chave
var_dump(array_search(10, $notas)); // string(3) "Ana"

echo 'Alguém tirou 10?' . PHP_EOL;
// Esse terceiro parâmetro impede que uma string númerica seja convertida.
var_dump(array_search(10, $notas, true)); // false
