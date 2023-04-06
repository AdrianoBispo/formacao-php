<?php

require_once 'autoload.php';

use Alura\Banco\Modelo\Endereco;

$umEndereco = new Endereco (
    'Petropolis',
    'bairro qualquer',
    'minha rua',
    'número qualquer'
);

$outroEndereco = new Endereco (
    'Rio',
    'Centro',
    'Uma rua aí',
    '50'
);

echo $umEndereco . PHP_EOL;
echo $outroEndereco;