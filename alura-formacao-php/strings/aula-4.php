<?php

$email = 'vinicius@gmail.com';

$posicaoDoArroba = strpos($email, '@'); // busca na $email a posição do '@

echo substr($email, 0, $posicaoDoArroba) . PHP_EOL; // vinicius
echo substr($email, $posicaoDoArroba + 1) . PHP_EOL; // gmail.com