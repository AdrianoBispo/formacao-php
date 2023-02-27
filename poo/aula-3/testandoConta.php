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


// Nossa classe nos permite a criação de vários objetos, por exemplo uma $segundaConta, recebendo também uma nova instância de "Conta", agora vazia.
$segundaConta = new Conta();
$segundaConta->cpfTitular = '987.654.321-10';
$segundaConta->nomeTitular = 'Patricia';
$segundaConta->saldo = 1500;

var_dump($segundaConta); // Retorna os valores que acabamos de definir

//Se fizermos um var_dump() de $primeiraConta, ela continuará com os valores originais.
var_dump($primeiraConta); // Retorna os valores definidos da $primeiraConta.
