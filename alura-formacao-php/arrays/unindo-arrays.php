<?php

$alunos2021 = [
    'Vinicius' => 6,
    'João' => 8,
    'Ana' => 10,
    'Roberto' => 7,
    'Maria' => 9
];

$alunosNovos = [
    'João' => 8,
    'Ana' => 10,
    'Roberto' => 7
];

// O "Operador União" mantém o valor original ao invés de sobrescrever
$alunos2022 = $alunos2021 + $alunosNovos;
var_dump($alunos2022);

// Pega a array, adiciona no final e adiciona os outros arrays no final sem preservar as chaves
$alunos2022 = array_merge($alunos2021, $novosAlunos) ;
var_dump($alunos2022);

// União por meio da desestruturação de arrays
$alunos2022 = [...$alunos2021, ...$novosAlunos];
var_dump($alunos2022);