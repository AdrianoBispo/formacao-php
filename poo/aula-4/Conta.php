<?php

class Conta
{
    public $cpfTitular;
    public $nomeTitular;
    public $saldo = 100;

    public function sacar(float $valorASacar)
    {
        if ($valorASacar > $this->saldo) {
            echo "Saldo indisponível";
        } else {
            $this->saldo -= $valorASacar;
        }
    }
}

// A $this se refere à referência atual que chamou o método.
// Digamos que a $conta chamou o método sacar, a $this vai ter o valor da $conta.
// Se a $outraConta chamar o método sacar, então $this vai receber o valor da $outraConta