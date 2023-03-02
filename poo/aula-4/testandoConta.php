<?php

require_once 'Conta.php';

// Criando uma conta e adicionando valor de saldo
$umaConta = new Conta();
$umaConta->saldo = 200;

// Criando outra conta e adicionando valor de saldo
$segundaConta = new Conta();
$segundaConta->saldo = 300;

// Exibindo saldo da conta
var_dump($umaConta);
var_dump($segundaConta);

//Chamando o método sacar()
$umaConta->sacar(200);
$segundaConta->sacar(150);

// Exibindo o valor do saldo depois de efetuar o saque
var_dump($umaConta);
var_dump($segundaConta);