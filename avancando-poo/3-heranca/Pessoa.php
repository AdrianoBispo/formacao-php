<?php

class Pessoa
{
    public $nome;
    public $cpf;

    public function __construct(string $nome, CPF $cpf)
    {
        $this->nome = $nome;
        $this->cpf = $cpf;
    }

    public function recuperaNome(): string
    {
        return $this->nome;
    }

    public function validaNomeTitular(string $nomeTitular)
    {
        if (mb_strlen($nomeTitular) < 5) {
            echo 'Nome precisa ter pelo menos 5 caracteres';
            exit();
        }
    }

    public function recuperaCpf(): string
    {
        return $this->cpf->recuperaNumero();
    }

}