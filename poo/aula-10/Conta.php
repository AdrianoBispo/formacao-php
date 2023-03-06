<?php

// Métodos Privados

class Conta
{
    private $cpfTitular;
    private $nomeTitular;
    private $saldo;

    public function __construct(string $cpfTitular, string $nomeTitular)
    {
        $this->cpfTitular = $cpfTitular;
        $this->nomeTitular = $nomeTitular;
        $this->saldo = 0;
    }

    public function saca(float $valorASacar): void
    {
        if ($valorASacar > $this->saldo) {
            echo "Saldo indisponível";
            return;
        }

        $this->saldo -= $valorASacar;
    }

    public function deposita(float $valorADepositar): void
    {
        if ($valorADepositar < 0) {
            echo "Valor precisa ser positivo";
            return;
        }

        $this->saldo += $valorADepositar;
    }

    public function transfere(float $valorATransferir, Conta $contaDestino): void
    {
        if ($valorATransferir > $this->saldo) {
            echo "Saldo indisponível";
            return;
        }

        $this->saca($valorATransferir);
        $contaDestino->deposita($valorATransferir);
    }

    public function recuperaSaldo(): float
    {
        return $this->saldo;
    }

    public function recuperaCpfTitular(): string
    {
        return $this->cpfTitular;
    }

    public function recuperaNomeTitular(): string
    {
        return $this->nomeTitular;
    }

    private function validaNomeTitular(string $nomeTitular)
    {
        if (strlen($nomeTitular) < 5) {
            echo "Nome precisa ter pelo menos 5 caracteres";
            exit();
        }
    }
}

// Testando
$umaConta = new Conta('698.549.548-10', 'Ana');
var_dump($umaConta);



/*
    Via de regra, os atributos devem ser privados e somente os métodos públicos. Entretanto, nem todos os métodos devem ser públicos. 
    Quando temos códigos que só são executados dentro da classe, é perfeitamente aceitável que eles sejam privados. 
    Assim, o validaNomeTitular() só será acessível na instância de Conta, e poderá ser chamado no construtor, mas não em outros arquivos.

    É interessante termos métodos privados para organizarmos o código da classe, mantendo a legibilidade sem expor os comportamentos internos da aplicação.
    Além disso, faz mais sentido termos métodos mais objetos, com uma única responsabilidade, o que às vezes traz a necessidade de extrairmos outros métodos.
*/