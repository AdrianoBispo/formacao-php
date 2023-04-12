<?php

// Boas Práticas PHP - Early Return

class Conta
{
    public $cpfTitular;
    public $nomeTitular;
    public $saldo = 0;

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

// Substitui todas os "elses" por "return" 
// Saiba mais sobre a técnica: https://dorianneto.com/pt/posts/torne-se-um-ninja-das-funcoes-com-early-return/