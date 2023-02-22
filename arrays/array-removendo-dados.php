<?php

$alunos2021 = [
    'Vinicius',
    'João',
    'Ana',
    'Roberto',
    'Maria'
];

$novosAlunos = [
    'Patricia',
    'Nico',
    'Kilderson',
    'Daiane'
];

$alunos2022 = [...$alunos2021, ...$novosAlunos];

// Remove o primeiro item da lista
array_shift($alunos2022);

// Remove o último item da lista
array_pop($alunos2022);

var_dump($alunos2022);