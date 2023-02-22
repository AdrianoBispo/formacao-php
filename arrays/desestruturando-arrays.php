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

// Unpacking operator("...") desestrutura uma array
// Esse recurso é estar disponível desde a versão 7.4 e que antes da 8.1 
// não era possível fazer com chaves de string
// Como podemos ver, também é possível adicionar um valor entre as arrays
$alunos2022 = [...$alunos2021, 'Carlos Vinicius', ...$novosAlunos];
var_dump($alunos2022);


// Diferente da desestruturação de uma array, a desestruturação de uma function
// existe desde da versão 5 e é conhecida como Spread Operator
funcao (...[1, 3, 34 ]);

function funcao(int $a, int $b, int $c) {}

// Saiba mais: https://www.php.net/manual/en/language.types.array.php => Example #9 Simple array unpacking
