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

// Adiciona um valor ao final da array
$alunos2022[] = 'Luiz';

// Adiciona valores ao final da array
array_push($alunos2022, 'Alice', 'Bob', 'Charlie');

// Adiciona valores no inicio da array
array_unshift($alunos2022, 'Sthepane', 'Gustavo');
var_dump($alunos2022);
