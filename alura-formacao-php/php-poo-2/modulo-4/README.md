# Módulo 4: Polimorfismo

<details>
  <summary>
    <h2> Aula 1</h2>
  </summary>

  <h3> Bonificação de funcionários </h3>

Anteriormente aprendemos que é possível importar vários namespaces e classes de um _namespace_. Porém, note que, em <code>banco.php</code>, estamos fazendo várias importações diferentes de um mesmo _namespace_, como <code>ContaPoupanca</code> e <code>ContaCorrente</code> ou <code>CPF</code> e <code>Endereco</code>.

```php

use Alura\Banco\Modelo\Conta\Conta;
use Alura\Banco\Modelo\Conta\ContaPoupanca;
use Alura\Banco\Modelo\Conta\Titular;
use Alura\Banco\Modelo\CPF;
use Alura\Banco\Modelo\Endereco;

```

Quando temos várias classes de um mesmo _namespace_, o PHP nos permite agrupá-las usando chaves. O PhpStorm inclusive é capaz de fazer esse agrupamento automaticamente utilizando "Alt + Enter > Groud use statements by selected prefix".

```php

use Alura\Banco\Modelo\Conta\{Conta, ContaPoupanca, Titular};
use Alura\Banco\Modelo\CPF;
use Alura\Banco\Modelo\Endereco;

```

Repetiremos esse processo para <code>Endereco</code> e <code>CPF</code>, dessa vez fazendo o agrupamento manualmente.

```php

use Alura\Banco\Modelo\Conta\{Conta, ContaPoupanca, Titular};
use Alura\Banco\Modelo\{CPF, Endereco};

```

Quando temos muitas classes sendo importadas, pode ser mais interessante colocá-las em linhas separadas, facilitando a sua visualização. Já com duas ou três, como é o nosso caso, o agrupamento também parece adequado.

Prosseguindo com o treinamento, surgiu uma demanda de controlarmos as bonificações de cada funcionário. Ou seja, os funcionários recebem uma bonificação anual que é gerada a partir de um relatório, e o sistema apresenta para a empresa a soma de todas essas bonificações.

Começaremos implementando em <code>Funcionario</code> um novo método <code>calculaBonificacao()</code> que, pelo menos por enquanto, devolverá <code>10%</code> do <code>$salario</code>, atributo que também criaremos nessa classe.

```php

class Funcionario extends Pessoa
{
    private $cargo;
    private $salario;

    //... código omitido ...//

    public function calculaBonificacao(): float
    {
        return $this->salario * 0.1;

    }
}

```

Inicializaremos o novo atributo no construtor e criaremos um método <code>recuperaSalario()</code> que simplesmente nos retornará o valor desse atributo.

```php

class Funcionario extends Pessoa
{
    private $cargo;
    private $salario;

    public function __construct(string $nome, CPF $cpf, string $cargo, float $salario)
    {
        parent::__construct($nome, $cpf);
        $this->cargo = $cargo;
        $this->salario = $salario;
    }

    //... código omitido ...//

    public function recuperaSalario(): float
    {
        return $this->salario;
    }

    public function calculaBonificacao(): float
    {
        return $this->salario * 0.1;

    }
}

```

Agora que temos o salário e a bonificação de um funcionário, vamos implementar o sistema que faz o seu controle. Essa não será uma classe de modelo, mas sim uma classe de serviço, que executa uma funcionalidade. Portanto, criaremos a classe <code>ControladorDeBonificacoes</code> no _namespace_ "Alura\Banco\Service" ("serviço" em inglês"), e ela deverá ser armazenada em um novo diretório "Service".

```php

<?php

namespace Alura\Banco\Service;

use Alura\Banco\Modelo\Funcionario;

class ControladorDeBonificacoes
{

}

```

Essa classe conseguirá controlar as bonificações de vários funcionários. Começaremos criando um método <code>adicionaBonificacao()</code> que receberá um <code>Funcionario</code> e, a partir dele, executará o método <code>calculaBonificacao()</code> e salvará o seu valor em uma propriedade <code>$totalBonificacoes</code> inicializada com <code>0</code>.

```php

class ControladorDeBonificacoes
{
    private $totalBonificacoes = 0;

    public function adicionaBonificacao(Funcionario $funcionario)
    {
        $this->totalBonificacoes += $funcionario->calculaBonificacao();
    }

}

```

Vamos recapitular? Nossa classe <code>Funcionario</code> agora possui uma propriedade <code>$salario</code> que é inicializada no construtor e pode ser acessada por meio do getter <code>recuperaSalario()</code>. Além disso, o <code>Funcionario</code> tem uma bonificação ao final do ano que é calculada a partir do seu salário, e cujo valor foi determinado como <code>10%</code> desse salário.

Agora temos uma funcionalidade que calcula o total que a empresa gasta com bonificações a partir de cada um dos funcionários. Precisaremos, também, de um método <code>recuperaTotal()</code> que retornará o <code>$totalBonificacoes</code>.

```php

class ControladorDeBonificacoes
{
    private $totalBonificacoes = 0;

    public function adicionaBonificacao(Funcionario $funcionario)
    {
        $this->totalBonificacoes += $funcionario->calculaBonificacao();
    }

    public function recuperaTotal(): float
    {
        return $this->totalBonificacoes;
    }

}

```

Para testarmos, criaremos um arquivo <code>bonificacoes.php</code> no qual instanciaremos <code>$umFuncionario</code> com o nome "Vinicius Dias", o CPF "123.456.789-10", o cargo "Desenvolvedor" e o salário "1000". Também criaremos <code>$umaFuncionaria</code> com o nome "Patricia", o CPF "987.654.321-10", o cargo "Gerente" e o salário "3000" Não podemos nos esquecer de importar o autoloader para que nossas classes sejam encontradas.

```php

<?php

require_once 'autoload.php';

use Alura\Banco\Modelo\{CPF, Funcionario};

$umFuncionario = new Funcionario(
    'Vinicius Dias',
    new CPF('123.456.789-10'),
    'Desenvolvedor',
    1000
);

$umaFuncionaria = new Funcionario(
    'Patricia',
    new CPF('987.654.321-10'),
    'Gerente',
    3000
);

```

Em seguida, criaremos uma instância <code>$controlador</code> de <code>ControladorDeBonificacoes</code> que adicionará as bonificações de ambos os funcionários com o método <code>adicionaBonificacao()</code>. Por fim, exibiremos o total de bonificações fazendo um <code>echo</code> de <code>$controlador->recuperaTotal()</code>.

```php

require_once 'autoload.php';


use Alura\Banco\Service\ControladorDeBonificacoes;
use Alura\Banco\Modelo\{CPF, Funcionario};

$umFuncionario = new Funcionario(
    'Vinicius Dias',
    new CPF('123.456.789-10'),
    'Desenvolvedor',
    1000
);

$umaFuncionaria = new Funcionario(
    'Patricia',
    new CPF('987.654.321-10'),
    'Gerente',
    3000
);


$controlador = new ControladorDeBonificacoes();
$controlador->adicionaBonificacaoDe($umFuncionario);
$controlador->adicionaBonificacaoDe($umaFuncionaria);

echo $controlador->recuperaTotal();

```

Ao executarmos, teremos como resultado <code>400</code> - o que é correto, já que Vinicius e Patrícia recebem <code>100</code> e <code>300</code> de bonificação, respectivamente.

No próximo vídeo faremos uma breve recapitulação e discutiremos uma nova funcionalidade.

</details>

O que aprendi neste módulo:

- Aprendi o 4º pilar da orientação a objetos que é o Polimorfismo;

- Vi que a mesma referência pode se comportar de diversas formas dependendo do contexto, e essa é uma explicação simplória do polimorfismo;

- Reforçei meu conhecimento sobre herança criando diversas novas classes;

- Aprendi o conceito de uma classe de serviço, que representa uma funcionalidade ao invés de representar um modelo de nosso domínio;