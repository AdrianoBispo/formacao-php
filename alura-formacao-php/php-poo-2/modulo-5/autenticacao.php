<?php

require_once 'autoload.php';

use Alura\Banco\Modelo\CPF;
use Alura\Banco\Modelo\Funcionario\Diretor;
use Alura\Banco\Service\Autenticador;

$autenticador = new Autenticador();

$umDiretor = new Diretor(
    'João da Silva',
    new CPF('123.456.789-10'),
    10000

);

$autenticador->tentaLogin($umDiretor, '1234');