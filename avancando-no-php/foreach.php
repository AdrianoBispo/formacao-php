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
    echo $cpf . PHP_EOL;
}

// É possível adicionar uma nova conta utilizando o 