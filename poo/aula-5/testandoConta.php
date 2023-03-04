<?php

require_once 'Conta.php';

$umaConta = new Conta();
$umaConta->depositar(100);
echo $umaConta->saldo . PHP_EOL; // Retorna o valor do saldo
$umaConta->depositar(-100); // Retorna falso