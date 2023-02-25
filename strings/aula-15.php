<?php

// Regex (Regular Expression) 
// Acesse: https://regex101.com/

$telefone = ['(24) 99999 - 9999', '(21) 99999 - 9999', '(24) 2222 - 2222'];

foreach ($telefone as $telefone) {

    $telefoneValido = preg_match(
        '/^\([0-9]{2}\) 9?[0-9]{4} - [0-9]{4}$/', // Parâmetro Regex
        $telefone, // Variável utilizada para fazer o "match" com nossa Regex
        $correspondencia // Variável que armazena os valores interpretados pela operação de "match"
    );
    var_dump($correspondencia); // Retorna os valores capturados da array $telefones

    if ($telefoneValido) {
        echo 'Telefone Válido' . PHP_EOL;
    } else {
        echo 'Telefone Inválido';
    }
}

// Atividade - Verificação de CPF

$cpf = ['123.456.789-10', '123.456.789-11', '123.456.789-12'];

foreach ($cpf as $cpf) {
    $validandoCPF = preg_match(
        '/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}$/',
        $cpf,
        $cpfCapturados
    )
}

if ($validandoCPF) {
    echo 'CPF Válido';
} else {
    echo 'CPF inválido';
}