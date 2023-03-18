<?php

$notasBimestre1 = [
    'Vinicius' => 6,
    'João' => 8,
    'Ana' => 10,
    'Roberto' => 7,
    'Maria' => 9
];

$notasBimestre2 = [
    'Vinicius' => 7,
    'João' => 8,
    'Ana' => 10,
    'Maria' => 9
];

// Compara os valores das arrays ignorando as chaves e informa a diferença
var_dump(array_diff($notasBimestre1, $notasBimestre2));

// Já aqui, os valores são ignorados e informa a diferença de acordo com o valor da chave
var_dump(array_diff_key($notasBimestre1, $notasBimestre2));

// Já aqui, é informado a diferença levando em consideração as chaves e seu respectivos valores são informados
var_dump(array_diff_assoc($notasBimestre1, $notasBimestre2));