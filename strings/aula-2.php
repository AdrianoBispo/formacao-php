<?php

$url = 'https://www.alura.com.br';

// Verifica o começo de uma string
var_dump(str_starts_with($url, 'https')); // true

if (str_starts_with($url, 'https')) {
    echo 'É uma URL segura';
} else {
    echo 'Não é uma URL segura';
}