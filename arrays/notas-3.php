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
    if ($nota1['nota'] > $nota2['nota']) {
        return -1;
    }

    elseif ($nota1['nota'] < $nota2['nota']) {
        return 1;
    }

    return 0;
}

// Função de ordenação personalizavel, onde o segundo parâmtro "ordenaNotas" define o padrão de ordenação
usort($notas, 'ordenaNotas');
var_dump($notas);