<?php

class Titular
{
    private $cpf;
    private $nome;
    private $endereco;

    public function __construct(CPF $cpf, string $nome, Endereco $endereco)
    {
        $this->cpf = $cpf;
        $this->validaNomeTitular($nome);
        $this->nome = $nome;
        $this->endereco = $endereco;
    }

    public function recuperaCpf(): string
    {
        return $this->cpf->recuperaNumero();
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

    public function recuperaEndereco(): Endereco
    {
        return $this->endereco;
    }
}
