<?php

// Podemos adicionar um item no final de uma 
// lista através dos comandos abaixo:
 
    $idadeList = [21, 23, 19, 25, 30, 41, 18];

    $idadeList[count($idadeList)] = 20;

    foreach ($idadeList as $idade) {
        echo $idade . PHP_EOL;
    }


// Também podemos adicionar os valores
// sem a necessiade de utilzar o método "count"

    $idadeList = [21, 23, 19, 25, 30, 41, 18];

    $idadeList[] = 20;

    foreach ($idadeList as $idade) {
        echo $idade . PHP_EOL;
    }