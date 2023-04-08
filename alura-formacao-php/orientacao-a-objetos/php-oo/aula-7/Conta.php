<?php

// Boa Prática PHP - Somentes os métodos devem ser públicos

class Conta
{
    // Os atributos foram declarados como private
    private $cpfTitular;
    private $nomeTitular;
    private $saldo = 0;

    public function sacar(float $valorASacar)
    {
        if ($valorASacar > $this->saldo) {
            echo "Saldo indisponível";
            return;
        }
        
        $this->saldo -= $valorASacar;

    }

    public function depositar(float $valorADepositar): void
    {
        if ($valorADepositar < 0) {
            echo "Valor precisa ser positivo";
            return;
        }
        
        $this->saldo += $valorADepositar;

    }

    public function transferir(float $valorATransferir, $contaDestino): void
    {
        if($valorATransferir > $this->saldo) {
            echo 'Saldo indisponível';
            return;
        }

        $this->sacar($valorATransferir);
        $contaDestino->depositar($valorATransferir);

    }
}
