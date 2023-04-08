<?php

$dados = [
    'nome' => 'Vinicius', 
    'nota' => 10, 
    'idade' => 24
];

// pega um array e separa as variáveis
extract($dados);
var_dump($nome, $nota, $idade);

// Pega as variáveis separadas e compacta num array
var_dump(compact('nome', 'nota', 'idade'));