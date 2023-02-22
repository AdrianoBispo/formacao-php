<?php

// Diz a quantidade de bytes de uma string
$senha = '123';
echo strlen($senha) . PHP_EOL;
if (strlen($senha) < 8) {
    echo 'Senha insegura' . PHP_EOL;
}

// OBS: Caracteres especiais, como: í, ì, ç, á, á, etc...
// por terem um peso 2 bytes, eles tem o peso de 2 caracteres.

// Exemplo:
echo strlen('ì'); // 2
