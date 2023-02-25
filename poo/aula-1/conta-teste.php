<?php

// Esse exemplo não funciona mais na versão 8 do PHP

require_once 'conta.php';

$conta['123.456.789-10']['saldo'] -= 1000; // Repare que digitei o CPF errado

// Esse comando acaba criando um novo índice, ou seja, uma nova conta somente com o saldo negativo e sem um titular.