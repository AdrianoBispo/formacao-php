<?php

// Entendo a função "list"

$info = array('Café', 'marrom', 'cafeína');
[$bebida, $cor, $substancia] = $info; // Podemos escrever assim
echo "$bebida é $cor e $substancia o faz especial." . PHP_EOL;

$info = array('Café', 'marrom', 'cafeína');
list($bebida, $cor, $substancia) = $info; // Ou podemos escrevê-la assim
echo "$bebida é $cor e $substancia o faz especial.";