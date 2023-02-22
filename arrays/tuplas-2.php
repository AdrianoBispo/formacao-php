<?php

$contas = [
    [
        'titular' => 'Vinicius Dias',
        'saldo' => 100
    ],
    [
        'titular' => 'Maria Joaquina',
        'saldo' => 1000
    ],
    [
        'titular' => 'João da Silva',
        'saldo' => 800
    ],
];

foreach ($contas as ['titular' => $titular, 'saldo' => $saldo]) {
    echo "$titular possui $saldo reais" . PHP_EOL;
}