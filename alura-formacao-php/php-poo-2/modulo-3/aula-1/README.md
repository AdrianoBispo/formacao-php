## Classes e Métodos Abstratos - Tarifa de Saque

O objetivo agora é implementarmos uma tarifa de saque no nosso banco, que funcionará adicionando uma taxa de 5% ao <code>$valorASacar</code>. Ou seja, o <code>$valorSaque</code> será o <code>$valorASacar</code> recebido por parâmetro acrescido de <code>$tarifaSaque</code>, que definiremos como a multiplicação de <code>$valorASacar</code> por <code>0.05</code>. Em seguida, passaremos a verificar se o cliente possui um saldo maior que <code>$valorSaque</code>, e ao final subtrairemos esse valor do saldo.

```php

<?php

public function saca(float $valorASacar): void
{
    $tarifaSaque = $valorASacar * 0.05;
    $valorSaque = $valorASacar + $tarifaSaque;
    if ($valorSaque > $this->saldo) {
        echo "Saldo indisponível";
        return;
    }

    $this->saldo -= $valorSaque;
}

```

Para testarmos, criaremos um arquivo <code>teste-saque.php</code> na raiz do projeto e faremos o <code>require</code> do nosso <code>autoload.php</code>. Em seguida, instanciaremos uma nova <code>Conta</code> passando uma instância de <code>Titular</code> que, por sua vez, receberá um <code>CPF</code> com o valor "123.456.789-10", além do nome "Adriano Vinícius" e uma instância de Endereco com os valores "Recife", "Barro", "Rua Barão de Ladário" e "68" (respectivamente a cidade, o bairro, a rua e o número). Também faremos as importações de todas as classes que precisaremos utilizar.

```php

<?php

use Alura\Banco\Modelo\Conta\Conta;
use Alura\Banco\Modelo\Conta\Titular;
use Alura\Banco\Modelo\CPF;
use Alura\Banco\Modelo\Endereco;

require_once 'autoload.php';

$conta = new Conta(
    new Titular(
        new CPF('123.456.789-10'),
        'Adriano Vinícius', 
        new Endereco('Recife', 'Barro', 'Rua Barão de Ladário', '68')
    )
);

```

Como as novas contas são inicializadas zeradas, faremos um depósito com o valor <code>500</code>. Logo depois, realizaremos um saque com o valor <code>100</code> e executaremos um <code>echo</code> de <code>$conta->recuperaSaldo()</code> para verificarmos se a tarifa está sendo cobrada - nesse caso, o valor a ser removido é <code>105</code>.

```php

$conta->deposita(500);
$conta->saca(100);

echo $conta->recuperaSaldo(); // Output 395

```

Ou seja, o saque foi realizado corretamente, incluindo a tarifa que definimos. Implementada a tarifa, chegou uma nova demanda informando que a tarifa da conta poupança será de <code>3%</code>, enquanto a da conta corrente se manterá <code>5%</code>. Mas como saberemos com qual tipo de conta estamos trabalhando? Esse será o assunto do próximo vídeo.
