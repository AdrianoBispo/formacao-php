<?php

$notas = [
    'um',
    'dois',
    'tres'
];

$notasOrdenadas = $notas;

// Essa função organiza por ordem alfabetica
// Essa função recebe o parâmetro por referência
// O que a faz alterar o valor de uma variável
sort($notasOrdenadas);

echo 'Desordenadas:';
var_dump($notas);

echo 'Ordenadas:';
var_dump($notasOrdenadas);

// O que acontece se passarmos um valor que não seja uma variável 
// para essa função, como no seguinte código:

// sort([3, 5, 2])? 

// Um erro vai ser gerado, pois não é possível passar esse valor 
// para uma função que espera uma referência.