<?php

for ($contador = 1; $contador <= 15; $contador++ ) {
    echo "#$contador" . PHP_EOL;
}

/* 
   Dentro do bloco do laço podemos pular uma interação com o comando "continue"
   Com o comando "break" podemos sair do laço

   for ($contador = 1; $contador <= 15; $contador++ ) {
        if($contador == 13) {
            break;
        }

        echo "#$contador" . PHP_EOL;

    for ($contador = 1; $contador <= 15; $contador++ ) {
        if($contador == 13) {
            continue;
        }
        
        echo "#$contador" . PHP_EOL;
}

*/   
