<?php

// Destrutor

class Conta
{
    private $cpfTitular;
    private $nomeTitular;
    private $saldo;
    private static $numeroDeContas = 0;

    public function __construct(string $cpfTitular, string $nomeTitular)
    {
        $this->cpfTitular = $cpfTitular;
        $this->nomeTitular =  $nomeTitular;
        $this->validaNomeTitular($nomeTitular);
        $this->saldo = 0;

        self::$numeroDeContas++;
    }

    // Esse destrutor será executado quando uma das contas deixar de existir.
    public function __destruct()
    {
        if (self::$numeroDeContas > 1) {
            echo "Há mais de uma conta ativa";
        }
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

    public static function recuperaNumeroDeContas(): int
    {
        return self::$numeroDeContas;
    }
}

// Testando
$umaConta = new Conta('698.549.548-10', 'Patricia');
var_dump($umaConta);

$segundaConta = new Conta('123', 'Abcdefg');
unset($segundaConta);
echo Conta::recuperaNumeroDeContas();

/*
    O PHP tem um mecanismo interessante chamado "Garbage Collector" ou "Coletor de Lixo", que também existe em outras linguagens.
    O interpretador do PHP chamará o Garbage Collector para verificar todos os dados que estão sem nenhuma referência, removendo-os da memória.
    Assim, a memória é constantemente otimizada, e o lixo deixa de ser armazenado.
*/

// Com essa funcionalidade em mente poderíamos, por exemplo, abrir um arquivo no construtor (fopen()) e fechá-lo no destrutor (fclose()).