<?php
// Essa função espera pelo menos dois parâmetros, 
// o primeiro é o que vou usar como separador e o 
// segundo parâmetro é a string que quero separar

$nome = 'Adriano Vinícius Bispo da Silva';
var_dump(explode(' ', $nome)); // Separa strings retornando uma array


// Também é possível utilizar separar strings de vírgulas
$csv = 'Adriano Bispo, 18, estudante';
var_dump(explode(',', $csv));