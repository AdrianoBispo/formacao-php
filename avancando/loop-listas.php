<?php

$idadeList = [23, 19, 25, 30, 41, 18, 21];

echo count($idadeList); // Conta a quantidade de itens de uma lista e exibe-o em número.

for ($i = 0; $i < count($idadeList); $i++) {
    echo $idadeList[$i] . PHP_EOL;
}
