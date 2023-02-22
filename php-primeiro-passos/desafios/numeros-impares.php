<?php

/*
$numero = 3;
$restoDoNumero = $numero % 2;

if ($restoDoNumero == 0 ) {
    echo "Este número é par.";
} else {
    echo "Este número é ímpar.";
}
*/

for ($contador = 1; $contador < 100; $contador++) {
    if ($contador % 2 != 0) {
        echo $contador . PHP_EOL;
    }
}
