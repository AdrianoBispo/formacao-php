<?php

// Exemplo de conversão de tipo e sobrescrita

    $array = [
        1 => 'a',
        '1' => 'b',
        1.5 => 'c',
        true => 'd'
    ];

    foreach ($array as $item ) {
        echo $item . PHP_EOL;
    }

// Para entender melhor, acesse:
// https://www.php.net/manual/pt_BR/language.types.array.php

// Acesse: https://www.php.net/manual/pt_BR/types.comparisons.php
// para entender com mais detalhes como ocorrem as conversões de tipo em PHP,
// a documentação contém ainda uma tabela de comparações de tipos muito informativa.

/*  OBS: O array no PHP não é um array de verdade, como conhecemos nas demais linguagens.
*   Internamente, os arrays são armazenados como HashTables (tabelas de espalhamento), 
*   e por isso eles são tão poderosos. Têm tamanho dinâmico, podem ter strings como seus índices 
*   e podem ser manipulados de diversas formas. Mas com grandes poderes vêm grandes responsabilidades, 
*   e muitas pessoas abusam destes poderes. Tome cuidado para não tratar o array no PHP como a única opção para modelar seus dados.
*   Conheça as outras opções e saiba quando aplicar cada uma. Estude muito sobre Orientação a Objetos
*   e não use arrays quando deveria estar utilizando objetos.
*/