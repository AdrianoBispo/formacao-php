<?php
// Essa função espera pelo menos dois parâmetros, 
// o primeiro é o que vou usar como separador e o 
// segundo parâmetro é a string que quero separar

$nome = 'Adriano Vinícius Bispo da Silva';
var_dump(explode(' ', $nome));


// Também é possível utilizar separar strings de vírgulas
$csv = 'Adriano Bispo, 18, estudante';
var_dump(explode(',', $csv));

// Essa função também possui um terceiro parâmetro, onde podemos informar o limite
$array = '1 2 3 4';
var_dump(explode(' ', $array));