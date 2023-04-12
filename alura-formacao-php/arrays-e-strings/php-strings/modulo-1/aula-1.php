<?php

$nome = 'Vinicius';

// Verifica se a string 'Dias' está contida na variável $nome
var_dump(str_contains($nome, 'Dias')); // false

$nome = 'Adriano';
$sobrenome = str_contains($nome, 'Bispo');

// Faz uma verificação booleana
if ($sobrenome /*=== true*/) {
    echo "$nome é da minha família." . PHP_EOL;
} else {
    echo "$nome não é da minha família." . PHP_EOL;
}

// OBS: Essa função chegou na versão 8.0 do PHP.