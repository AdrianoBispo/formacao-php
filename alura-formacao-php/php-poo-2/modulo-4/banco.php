<?php

require_once 'autoload.php';

use Alura\Banco\Service\ControladorDeBonificacoes; 
use Alura\Banco\Modelo\CPF;
use Alura\Banco\Modelo\Funcionario\{Funcionario, Gerente, Diretor};

$desenvolvedor = new Funcionario(
    'Adriano Vinícius',
    new CPF('123.456.789-10'),
    'Desenvolvedor',
    2500
);

$gerente = new Gerente(
    'Patricia',
    new CPF('987.654.321-11'),
    'Gerente',
    3000
);

$diretor = new Diretor(
    'Patrick',
    new CPF('987.654.321-12'),
    'Diretor',
    3000
);

$controlador = new ControladorDeBonificacoes();
$controlador->adicionaBonificacao($desenvolvedor);
$controlador->adicionaBonificacao($gerente);
$controlador->adicionaBonificacao($diretor);

echo $controlador->recuperaTotal();