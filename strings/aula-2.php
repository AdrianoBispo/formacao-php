<?php

$url = 'https://www.alura.com.br';

// Verifica o começo de uma string
var_dump(str_starts_with($url, 'https')); // true

if (str_starts_with($url, 'https')) {
    echo 'É uma URL segura';
} else {
    echo 'Não é uma URL segura';
}

// Verifica o final de uma string
var_dump(str_ends_with($url, 'br')); // true

if (str_ends_with($url, 'br')) {
    echo 'Esse dominio é do Brasil';
} else {
    echo 'Esse dominio não é do Brasil';
}

// OBS: Essa função chegou na versão 8.0 do PHP.