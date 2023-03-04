<?php

require 'Conta.php';

$contaUm = new Conta();
$contaDois = new Conta();
$contaUm->depositar(500);

$contaUm->transferir(200, $contaDois);
echo $contaUm->saldo;
echo $contaDois->saldo;