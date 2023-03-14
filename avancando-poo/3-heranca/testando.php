<?php

require_once 'Pessoa.php';
require_once 'Titular.php';
require_once 'CPF.php';
require_once 'Funcionario.php';

$umFuncionario = new Funcionario('Vinicius', new CPF('123.456.789-10'), 'Desenvolvedor');
var_dump($umFuncionario);