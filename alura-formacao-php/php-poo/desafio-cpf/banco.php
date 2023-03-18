<?php

require_once 'Conta.php';
require_once 'Titular.php';
require_once 'Cpf.php';

$umaConta = new Conta(new Titular(new Cpf('123.456.789-10'), 'Patricia'));
var_dump($segundaConta);

$outraConta = new Conta(new Titular(new Cpf('987.654.321-00'), 'Abcdefg'));
var_dump($outraConta);
echo Conta::recuperaNumeroDeContas();