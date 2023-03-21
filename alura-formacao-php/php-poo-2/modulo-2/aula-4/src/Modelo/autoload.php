<?php

spl_autoload_register(function (string $nomeCompletoDaClasse) {
    // Alura/Banco/Modelo/Endereco
    // src\Modelo\Endereco
    // src\Modelo\Endereco.php
    $caminhoArquivo = st_replace('Alura\\Banco', 'src', $nomeCompletoDaClasse);
    $caminhoArquivo = st_replace('\\', DIRECTORY_SEPARATOR, $caminhoArquivo);
    $caminhoArquivo .= '.php';

    if (file_exists($caminhoArquivo)) {
        require_once $caminhoArquivo;
    }
});