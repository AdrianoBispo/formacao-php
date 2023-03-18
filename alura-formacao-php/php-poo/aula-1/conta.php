<?php

function criarConta(string $cpf, string $nomeTitular, float $saldo): array 
{
    return [
        $cpf => [
            'titular' => $nomeTitular,
            'saldo' => $saldo
        ]
    ];
}

$conta = criarConta('123.456.789-10', 'Adriano Vinicius', 500);
var_dump($conta); // Visualiza o array com os dados informados acima
