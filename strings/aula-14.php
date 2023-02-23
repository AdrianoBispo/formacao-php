<?php

$xingamentos = 'Viado!, Idiota!, Desgraça!';

// Substitui apenas a palavra 'Idiota'
echo str_replace('Idiota!', '***', $xingamentos);

// Substitui todas as palavras
echo str_replace(['Viado!', 'Idiota!', 'Desgraça!'], '***', $xingamentos);

// Substitui todas as palavras pelos caracteres declarados
echo str_replace(['Viado!', 'Idiota!', 'Desgraça!'], ['***', '$$$', '@@@'], $xingamentos);

// Traduz os caracteres de uma string
echo strtr($xingamentos, 'Viado', '***');

// Traduz os caracteres de uma string através de uma lista
echo strtr($xingamentos, ['Viado' => '$$$', 'Idiota' => '***']) . PHP_EOL;



// EXEMPLO DA DOCUMENTAÇÃO

// Substitui o 'hi' por 'hello', depois 'hello' pelo 'hi' sem sobrescrever
$palavra = ['hello' => 'hi', 'hi' => 'hello'];
echo strtr("hi all, I said hello", $palavra) . PHP_EOL;

// Substitui todos os 'hello' pôr 'hi', depois o 'hi' é substituido pôr 'hello'
echo str_replace(['hello', 'hi'], ['hi', 'hello'], 'hi all, i said hello');