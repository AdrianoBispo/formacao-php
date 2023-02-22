<?php

$notasBimestre1 = [
    'Vinicius' => 6,
    'João' => 8,
    'Ana' => 10,
    'Roberto' => 7,
    'Maria' => 9
];

$notasBimestre2 = [
    'João' => 8,
    'Ana' => 10,
    'Roberto' => 7
];

$alunosFaltantes = array_diff_key($notasBimestre1, $notasBimestre2);
$nomesAlunos = array_keys($alunosFaltantes);
$notasAlunos = array_values($alunosFaltantes);

// Combinando arrays usando um como chave e o outro como valor
// Para utilizarmos o array_combine os dois precisam ter o mesmo tamanho. 
var_dump(array_combine($notasAlunos, $nomesAlunos));

// Inverte o valor para chave e a chave passa ser o valor
var_dump(array_flip($alunosFaltantes));
