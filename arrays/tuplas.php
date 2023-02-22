<?php

$dados = ['Vinicius', 10, 24];
list($nome, $nota, $idade) = $dados;
var_dump($nome, $nota, $idade);

// Também podemos escrever assim:
$dados = [
    'nomes' => 'Vinicius', 
    'nota' => 10, 
    'idade' => 24
];

['nomes' => $nome, 'nota' => $nota, 'idade' => $idade] = $dados;
var_dump($nome, $nota, $idade);


// OBS: Em várias linguagens, principalmente em linguagens de programação funcional, temos uma estrutura
// de dados semelhante a listas mas que tem seu valor é imutável, onde não se pode adicionar e nem remover algum item.
// Também, uma de suas características é que a ordem da posição de cada dado importa. 

// Infelizmente essa estrutura de dados não existe no PHP, mas podemos utilizar um método para simular a sua caractrística de posicionamento.