<?php

require_once 'Conta.php';

$primeiraConta = new Conta('123.456.789-10', 'Adriano Vinícius');

$primeiraConta->deposita(500);
$primeiraConta->saca(300);

echo $primeiraConta->recuperaNomeTitular() . PHP_EOL;
echo $primeiraConta->recuperaCpfTitular() . PHP_EOL;
echo $primeiraConta->recuperaSaldo() . PHP_EOL;