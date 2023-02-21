<?php

function exibeMensagem($mensagem) {
    echo $mensagem . PHP_EOL; 
}

function depositar(array $conta, float $valorADepositar): array {
    if ($valorADepositar > 0) {
        $conta['saldo'] += $valorADepositar;
    } else {
        exibeMensagem("Depositos precisam ser positivos.");
    }
    return $conta;
}

function sacar(array $conta, float $valorASacar): array {
    if ($valorASacar > $conta['saldo']) {
        exibeMensagem("Você não tem saldo suficiente.");
    } else {
        $conta['saldo'] -= $valorASacar;
    }
    return $conta;
}

function titularComLetrasMaiusculas(array &$conta)
{   // A função "strupper" converte uma string para maiúscula
    // mas nesse caso, não aceita acentos ortográficos.
    $conta['titular'] = strtoupper($conta['titular']);

    // Para isso, podemos utilizar a função "mb_strtouper"
    // Mas para podermos utilizar, devemos modificar o arquivo "php.ini"
}