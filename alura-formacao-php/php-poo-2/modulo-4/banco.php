<?php

require_once 'autoload.php';

use Alura\Banco\Service\ControladorDeBonificacoes; 
use Alura\Banco\Modelo\CPF;
use Alura\Banco\Modelo\Funcionario\{Funcionario, Gerente, Diretor, Desenvolvedor};

$desenvolvedor = new Desenvolvedor(
    'Adriano Bispo',
    new CPF('123.456.789-10'),
    'Desenvolvedor',
    1000
);

$desenvolvedor->sobeDeNivel();

$gerente = new Gerente(
    'Patricia',
    new CPF('987.654.321-10'),
    'Gerente',
    3000
);

$diretor = new Diretor(
    'Ana Paula', new CPF('123.951.789-11'),
    'Diretor', 5000
);

$controlador = new ControladorDeBonificacoes();
$controlador->adicionaBonificacao($desenvolvedor);
$controlador->adicionaBonificacao($gerente);
$controlador->adicionaBonificacao($diretor);

echo $controlador->recuperaTotal();
