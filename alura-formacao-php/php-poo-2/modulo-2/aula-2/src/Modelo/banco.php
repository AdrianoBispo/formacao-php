<?php

require_once 'src/Modelo/Conta/Conta.php';
require_once 'src/Modelo/Conta/Titular.php';
require_once 'src/Modelo/Endereco.php';
require_once 'src/Modelo/CPF.php';

$umFuncionario = new Funcionario('Vinicius', new CPF('123.456.789-10'), 'Desenvolvedor');
var_dump($umFuncionario);