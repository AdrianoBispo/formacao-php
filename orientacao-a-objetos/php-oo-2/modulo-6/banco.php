<?php

require_once 'autoload.php';

use Alura\Banco\Service\ControladorDeBonificacoes; 
use Alura\Banco\Modelo\CPF;
use Alura\Banco\Modelo\Funcionario\{Funcionario, Gerente, Diretor, Desenvolvedor, EditorDeVideo};

$desenvolvedor = new Desenvolvedor(
    'Adriano Bispo',
    new CPF('123.456.789-10'),
    1000
);

$desenvolvedor->sobeDeNivel();

$gerente = new Gerente(
    'Patricia',
    new CPF('987.654.321-10'),
    3000
);

$diretor = new Diretor(
    'Ana Paula',
    new CPF('123.951.789-11'),
    5000
);

$editor = new EditorDeVideo(
    'Paulo',
    new CPF('456.987.231-11'),
    1500
);

$controlador = new ControladorDeBonificacoes();
$controlador->adicionaBonificacao($desenvolvedor);
$controlador->adicionaBonificacao($gerente);
$controlador->adicionaBonificacao($diretor);
$controlador->adicionaBonificacao($editor);

echo $controlador->recuperaTotal();
