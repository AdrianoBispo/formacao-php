<?php

$usuario = 'GUSTAVO';
echo strtolower($usuario) . PHP_EOL; // gustavo
$usuario = 'gustavo';
echo strtoupper($usuario) . PHP_EOL; // GUSTAVO

// OBS: Essas 2 funções trabalham com os caracteres de 1 byte apenas.

// exemplo
$usuario = 'Júlia';
echo strtoupper($usuario) . PHP_EOL; // JúLIA

$usuario = 'ÍCARO';
echo strtolower($usuario) . PHP_EOL; // Ícaro

// Para corrigir isso é necessário desbloquear a biblioteca "mb_strings"
// através da configuração dos arquivo 'php.ini-development' do PHP.

// Utilizando Biblioteca
$usuario = 'Júlia';
echo mb_strtoupper($usuario) . PHP_EOL; // JÚLIA

$usuario = 'ÍCARO';
echo mb_strtolower($usuario); // ícaro