<?php

require_once 'autoload.php';

use Alura\Banco\Service\ControladorDeBonificacoes; // Comprimi a referência
use Alura\Banco\Modelo\{CPF, Funcionario}; // Comprimi a referência

$umFuncionario = new Funcionario(
    'Adriano Vinícius',
    new CPF('123.456.789-10'),
    'Desenvolvedor',
    1000
);

$umaFuncionaria = new Funcionario(
    'Patricia',
    new CPF('987.654.321-10'),
    'Gerente',
    3000
);

$controlador = new ControladorDeBonificacoes();
$controlador->adicionaBonificacao($umFuncionaria);
$controlador->adicionaBonificacao($umaFuncionaria);

echo $controlador->recuperaTotal();