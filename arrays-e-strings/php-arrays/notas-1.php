<?php

$notas = [
    [
        'aluno' => 'Maria',
        'nota' => 10,
    ],

    [
        'aluno' => 'Vinicius',
        'nota' => 6,
    ],

    [
        'aluno' => 'Ana',
        'nota' => 9,
    ]

];

function ordenaNotas(array $nota1, array $nota2): int 
{
    // Se a $nota1 for menor que a $nota2, retorne 1 (ordem crescente);
    return $nota1['nota'] <=> $nota2['nota'];

    // Se a $nota1 for menor que a $nota2, retorne -1(ordem decrescente);
    // return $nota2['nota'] <=> $nota1['nota'];
}

// Função de ordenação personalizavel
usort($notas, 'ordenaNotas');
var_dump($notas);