<?php

// Usando o método "foreach"

$contaCorrentes = [

    12345678910 => [
        'titular' => 'Vinicius',
        'saldo' => 1000
    ],

    12345648911 => [
        'titular' => 'Maria',
        'saldo' => 10000
    ],

    12325678910 => [
        'titular' => 'Adalberto',
        'saldo' => 300
    ]

];

foreach ($contaCorrentes as $cpf => $conta) {
    echo $conta['titular'] . PHP_EOL;
}

// Podemos adicionar um item no final de uma 
// lista através dos comandos abaixo:

    $contaCorrentes = [
        12345637811 => [
            'titular' => 'Claudia',
            'saldo' => 2000
        ], 
    ];


foreach ($contaCorrentes as $cpf => $conta) {
    echo $conta['titular'] . PHP_EOL;
}

// Também podemos adicionar um item no final de uma 
// lista através dos comandos abaixo:
