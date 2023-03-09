<?php

require_once 'Conta.php';
require_once 'Titular.php';

$umaConta = new Conta(new Titular('698.549.548-10', 'Patricia'));
var_dump($segundaConta);

$outraConta = new Conta(new Titular('123', 'Abcdefg'));
var_dump($outraConta);
echo Conta::recuperaNumeroDeContas();