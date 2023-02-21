<?php

// "include" => exporta os códigos escrito em outro arquivo, 
// mas caso não encontre envia um E_Warning
// Acesse: https://www.php.net/manual/en/function.include.php

// "require" => exporta os códigos escrito em outro arquivo,
// mas caso não encontre envia um E_Error
// Acesse: https://www.php.net/manual/en/function.require.php

// Para entender a diferença e tipos de erro do PHP,
// Acesse: https://www.php.net/manual/en/errorfunc.constants.php

require_once 'funcoes.php'; // Indica que só a exportação ocorrerá apenas uma vez

$contasCorrentes = [
    '123.456.789-10' => [
        'titular' => 'Maria',
        'saldo' => 10000
    ],

    '123.456.689-11' => [
        'titular' => 'Alberto',
        'saldo' => 300
    ],

    '123.256.789-12' => [
        'titular' => 'Vinicius',
        'saldo' => 100
    ]
];

$contasCorrentes['123.456.789-10'] = sacar(
    $contasCorrentes['123.456.789-10'],
    200
);

$contasCorrentes['123.456.689-11'] = sacar(
    $contasCorrentes['123.456.689-11'],
    300
);

$contasCorrentes['123.256.789-12'] = depositar(
    $contasCorrentes['123.256.789-12'],
    50
);

titularComLetrasMaiusculas($contasCorrentes['123.256.789-12']);

/*

foreach ($contasCorrentes as $cpf => $conta) {
    exibeMensagem(
        // Também podemos exibir dessa forma
        // "$cpf $conta[titular] $conta[saldo]"
        // Acesse: https://www.php.net/manual/en/language.types.string.php
        "$cpf {$conta['titular']} {$conta['saldo']}"
    );
}

*/

// Remove a conta do Alberto
// unset($contasCorrentes['123.456.689-11']);

foreach ($contasCorrentes as $cpf => $conta) {
    list('titular' => $titular, 'saldo' => $saldo) = $conta;
    exibeMensagem("$cpf $titular $saldo");
}