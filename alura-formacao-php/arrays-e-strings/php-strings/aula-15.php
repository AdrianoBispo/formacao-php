<?php

// Regex (Regular Expression) 
// Acesse: https://regex101.com/

$telefone = ['(24) 99999 - 9999', '(21) 99999 - 9999', '(24) 2222 - 2222'];

foreach ($telefone as $telefone) {

    $regex = '/^\(([0-9]{2})\) (9?[0-9]{4} - [0-9]{4})$/';
    $telefoneValido = preg_match(
        $regex,
        $telefone, // Variável para fazer o "match" com nossa Regex
        $correspondencia // Variável que armazena os valores interpretados pela operação de "match"
    );
    var_dump($correspondencia); // Retorna os valores capturados da array $telefones

    if ($telefoneValido) {
        echo 'Telefone Válido' . PHP_EOL;
    } else {
        echo 'Telefone Inválido';
    }

    echo preg_replace( // Substituição utilizando Regex
        $regex,
        '(XX) \2',
        $telefone
    ) . PHP_EOL;
}

// Atividade - Trocando a Ordem de uma Data

$data = '2022-06-08';
$regex = '/^([0-9]{4})-([0-9]{2})-([0-9]{2})/';
echo preg_replace(
    $regex,
    '\3/\2/\1',
    $data
);