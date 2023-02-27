<?php 

require_once 'Conta.php';

// As "variáveis" que fazem parte de um objeto são chamadas de "atributos".

$primeiraConta = new Conta();
var_dump($primeiraConta); // Retorna um objeto do tipo "Conta" no endereço #1 contendo os valores ["cpfTitular"], ["nomeTitular"] e ["saldo"].


// No PHP, para acessarmos um atributo a partir de um objeto usamos uma "->"(seta), veja no exemplo abaixo.
$primeiraConta->saldo = 200;
var_dump($primeiraConta); // Retorna um objeto com o valor do saldo definido. 

// Podemos usar a mesma sintaxe para definirmos o $cpfTitular e também para o $nomeTitular.
$primeiraConta->cpfTitular = '123.456.789-10';
$primeiraConta->nomeTitular = 'Vinicius Dias';

// Com isso, teremos uma conta completamente montada
var_dump($primeiraConta);

// Ao definirmos os atributos da nossa classe, estamos garantindo que toda conta terá um $cpfTitular, um $nomeTitular e um saldo, mesmo que seus valores sejam nulos.