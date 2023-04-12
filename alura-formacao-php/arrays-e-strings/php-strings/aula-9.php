<?php

$nomes = ' adriano Vinicius Vitor Alex Adriana';

echo trim($nomes) . PHP_EOL; // remove todss os espaços do inicio e do final da $nomes
echo ltrim($nomes) . PHP_EOL; // remove os espaçoes à esquerda da variavel
echo rtrim($nomes) . PHP_EOL; // remove os espaços à direita da variavel

// Também é possível adicionar outros parâmetro informando o char que queremos remover
echo trim($nomes, 'a') . PHP_EOL; // Remove as letras "a" da variavel