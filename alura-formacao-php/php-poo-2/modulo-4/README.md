# Módulo 4: Polimorfismo

<!-- Documentação AULA 1 -->

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

<!-- Documentação AULA 2 -->

<details>
  <summary>
    <h2> Aula 2</h2>
  </summary>

  <h3> Bonificações Diferentes</h3>

Vamos recapitular o que fizemos no vídeo anterior. Inicialmente incluímos um <code>$salario</code> na classe <code>Funcionario</code>, além de um _getter_ que recupera esse valor. No futuro, também poderemos implementar uma função que aumenta o salário do funcionário, mas isso é algo com que não nos preocuparemos por enquanto.

Temos também um cálculo de bonificação, a partir do qual criamos nossa primeira **classe de serviço**, que executam alguma ação e não representam um modelo do negócio. Aqui, focaremos no fato de que elas não representam um objeto real, mas algo que existe no sistema que estamos criando.

Na classe <code>ControladorDeBonificacoes</code>, conseguimos adicionar as bonificações de um funcionário e depois recuperar o total que foi adicionado, a última coisa que fizemos no vídeo anterior.

A partir de agora, o banco instaurou uma nova regra determinando que os gerentes passarão a ganhar uma bonificação diferente, representando <code>100%</code> do seu salário. Uma primeira solução para essa implementação seria incluirmos, no método <code>calculaBonificacao()</code>, um operador <code>if</code> que verifica se o <code>$cargo</code> do funcionário é "Gerente". Em caso positivo, a bonificação será <code>$this->salario</code>, e do contrário continuará sendo <code>10%</code>.

```php

public function calculaBonificacao(): float
{

    if ($this->cargo === 'Gerente') {
        return $this->salario;
    }
    return $this->salario * 0.1;
}

```

Feito isso, a execução de <code>bonificacoes.php</code> passará a retornar o valor <code>3100</code>, já que Vinicius recebe <code>100</code> de bonificação (<code>10%</code> de <code>1000</code>) e Patricia recebe <code>3000</code> (<code>100%</code> de <code>3000</code>).

Nosso cálculo está funcionando, mas incorremos em um problema, pois sabemos que não é adequado editarmos código existente a cada nova funcionalidade que é implementada. Além disso, agora surgiu também a necessidade de uma bonificação diferente para o Diretor. Se cada cargo está se comportando de maneira diferente, faz sentido criarmos classes específicas para eles.

No próximo vídeo começaremos a trabalhar nisso.

</details>


<!-- Documentação AULA 3 -->

<details>
  <summary>
    <h2> Aula 3</h2>
  </summary>

  <h3> Implementando Classes Filhas </h3>

No momento temos uma bonificação geral da empresa, uma específica para o Gerente, e precisamos implementar outra para o Diretor. Porém, sabemos que adicionar várias sequências de <code>if</code> no código é um sinal da necessidade de criarmos novas classes/hierarquias. A ideia, portanto, é termos classes específicas para cada um dos cargos da empresa.

Antes disso, criaremos no diretório "Modelo" uma nova pasta "Funcionario" na qual armazenaremos esses cargos de modo a mantê-los organizados. Moveremos o arquivo <code>Funcionario.php</code> para essa pasta, o que tornará necessário modificarmos o seu namespace para <code>Alura\Banco\Modelo\Funcionario</code>. Além disso, também precisaremos importar as classes <code>Pessoa</code> e <code>CPF</code>.

```php

namespace Alura\Banco\Modelo\Funcionario;

use Alura\Banco\Modelo\CPF;
use Alura\Banco\Modelo\Pessoa;

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
//...

```

Feito isso, criaremos uma nova classe <code>Gerente</code> que herdará de <code>Funcionario</code> com <code>extends</code> e implementará m método <code>calculabonificacao()</code> que simplesmente retornará a chamada de <code>$this->recuperaSalario()</code>, já que a sua bonificação é um salário completo.

```php

namespace Alura\Banco\Modelo\Funcionario;

class Gerente extends Funcionario
{
    public function calculaBonificacao(): float
    {
        return $this->recuperaSalario();
    }
}

```

Repare que, como não temos acesso direto ao atributo <code>$salario</code>, usamos o __getter__ <code>recuperaSalario()</code> para obter o seu valor. Prosseguiremos para a criação da classe <code>Diretor</code>, que terá as mesmas características da anterior, com a diferença de que sua bonificação será o dobro do salário - ou seja, a multiplicação de <code>this->recuperaSalario()</code> por <code>2</code>.

```php

namespace Alura\Banco\Modelo\Funcionario;

class Diretor extends Funcionario
{
    public function calculaBonificacao(): float
    {
        return $this->recuperaSalario() * 2;
    }
}

```

Com isso o <code>if</code> no cálculo da bonificação do <code>Funcionario</code> deixará de ser necessário, já que a sua bonificação será sempre de <code>10%</code>.

```php

public function calculaBonificacao(): float
{
    return $this->salario * 0.1;
}

```

Tanto <code>Gerente</code> quanto <code>Diretor</code> sobrescrevem o método <code>calculaBonificacao()</code> à sua maneira, resultando em suas bonificações diferenciadas. Aproveitaremos esse momento para começar também a implementação de um sistema interno do banco, no qual o <code>Diretor</code> possui um método <code>podeAutenticar()</code> que recebe uma __string__ <code>$senha</code> e retorna um booleano.

Caso a <code>$senha</code> correta seja informada - nesse caso <code>1234</code> -, retornaremos verdadeiro, autorizando a autenticação. Do contrário, essa autenticação não será feita.

```php

class Diretor extends Funcionario
{
    public function calculaBonificacao(): float
    {
        return $this->recuperaSalario() * 2;
    }

    public function podeAutenticar(string $senha): bool
    {
        return $senha === '1234';
    }
}

```

No futuro trabalharemos mais a fundo nessa ideia de autenticação. No momento temos uma classe base <code>Funcionario</code>, totalmente funcional, que possui a sua bonificação. As classes <code>Gerente</code> e <code>Diretor</code> também possuem essa funcionalidade, mas o cálculo é feito de outra forma - ou seja, a sua implementação sobrescreve a original. Além disso, o <code>Diretor</code> possui uma nova funcionalidade, que é a autenticação.

Esse é um conceito importante da herança: uma classe que estende outra não precisa ter somente os métodos da classe base/mãe, podendo ter os seus próprios.

Antes de realizarmos nossos testes, não podemos nos esquecer de corrigir a importação de <code>Funcionario</code> no <code>ControladorDeBonificacoes</code>.

```php

namespace Alura\Banco\Service;


use Alura\Banco\Modelo\Funcionario\Funcionario;

class ControladorDeBonificacoes
{
    private $totalBonificacoes = 0;

    public function adicionaBonificacaoDe(Funcionario $funcionario)
    {
        $this->totalBonificacoes += $funcionario->calculaBonificacao();
    }

    public function recuperaTotal(): float
    {
        return $this->totalBonificacoes;
    }

}

```

Em <code>bonificacoes.php</code>, passaremos a criar uma instância de <code>Funcionario</code> e outra de <code>Gerente</code>, fazendo também as importações necessárias.

```php

require_once 'autoload.php';

use Alura\Banco\Modelo\Funcionario\{Funcionario, Gerente};
use Alura\Banco\Service\ControladorDeBonificacoes;
use Alura\Banco\Modelo\CPF;

$umFuncionario = new Funcionario(
    'Vinicius Dias',
    new CPF('123.456.789-10'),
    'Desenvolvedor',
    1000
);

$umaFuncionaria = new Gerente(
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

Executando o código dessa forma, teremos como retorno <code>3100</code>, o mesmo valor que recebíamos anteriormente. Prosseguiremos criando também uma instância de <code>Diretor</code> chamada <code>$umDiretor</code>, e que receberá como parâmetros o nome **"Ana Paula"**, o <code>CPF</code> **"123.951.789-11"**, o cargo **"Diretor"** e o salário <co>5000</code>. Como nossas classes agora são cargos da empresa, já podemos pensar na possibilidade de removermos o atributo <code>$cargo</code>.

```php

require_once 'autoload.php';

use Alura\Banco\Modelo\Funcionario\{Diretor, Funcionario, Gerente};
use Alura\Banco\Service\ControladorDeBonificacoes;
use Alura\Banco\Modelo\CPF;

$umFuncionario = new Funcionario(
    'Vinicius Dias',
    new CPF('123.456.789-10'),
    'Desenvolvedor',
    1000
);

$umaFuncionaria = new Gerente(
    'Patricia',
    new CPF('987.654.321-10'),
    'Gerente',
    3000
);

$umDiretor = new Diretor(
    'Ana Paula', new CPF('123.951.789-11'),
    'Diretor', 5000
);

$controlador = new ControladorDeBonificacoes();
$controlador->adicionaBonificacaoDe($umFuncionario);
$controlador->adicionaBonificacaoDe($umaFuncionaria);
$controlador->adicionaBonificacaoDe($umDiretor);

echo $controlador->recuperaTotal();

```

Executando esse código, teremos como retorno <code>13100</code>, que é a soma correta das bonificações desses funcionários. Agora, se quisermos criar um novo cargo, faremos isso com uma nova classe. Por exemplo, criaremos uma classe <code>Desenvolvedor</code> que estende de <code>Funcionario</code> e cuja bonificação será <code>5%</code> do seu salário.

```php

namespace Alura\Banco\Modelo\Funcionario;


class Desenvolvedor extends Funcionario
{
    public function calculaBonificacao(): float
    {
        return $this->recuperaSalario() * 0.05;
    }
}

```

Voltaremos então ao arquivo <code>bonificacoes.php</code>, onde passaremos a importar a nova classe a instanciá-la em <code>$umFuncionario</code>.

```php

use Alura\Banco\Modelo\Funcionario\{Diretor, Funcionario, Gerente, Desenvolvedor};
use Alura\Banco\Service\ControladorDeBonificacoes;
use Alura\Banco\Modelo\CPF;

$umFuncionario = new Desenvolvedor(
    'Vinicius Dias',
    new CPF('123.456.789-10'),
    'Desenvolvedor',
    1000
);
//...

```

Note que agora deixou de fazer sentido instanciarmos um <code>Funcionario</code> diretamente, já que nosso banco - e na verdade nenhuma empresa - contrata um funcionário sem atribuição. Pensando nisso, como visto no capítulo anterior, passaremos a chamar essa classe de abstrata.

```php

abstract class Funcionario extends Pessoa
{
    private $cargo;
    private $salario;

    public function __construct(string $nome, CPF $cpf, string $cargo, float $salario)
    {
        parent::__construct($nome, $cpf);
        $this->cargo = $cargo;
        $this->salario = $salario;
    }
//...

```

Agora receberemos um erro se tentarmos instanciar um novo funcionário, já que não é possível instanciar uma classe abstrata. Outro ponto a ser ajustado é que as classes filhas <code>Diretor</code>, <code>Gerente</code> e <code>Desenvolvedor</code> funcionam normalmente mesmo que não tenham um método <code>calculaBonificacao()</code>, passando a receber aquela definida em <code>Funcionario</code>, já que, sem a presença da sobrescrita do método, o da __class base__ passa a ser válido.

Nesse caso trabalharemos com a classe <code>Desenvolvedor</code>, da qual removeremos o método <code>calculaBonificacao()</code>. Sabemos que um desenvolvedor pode subir de nível, passando por Junior, Pleno e Sênior. Portanto, criaremos um método <code>sobeDeNivel()</code> que será responsável pelo seu aumento de salário.

```php

class Desenvolvedor extends Funcionario
{
    public function sobeDeNivel()
    {

    }
}

```

Antes de fazermos essa implementação, criaremos em <code>Funcionario</code> um método <code>recebeAumento()</code> que recebe como parâmetro um <code>float $valorAumento</code>. Caso esse valor seja menor do que zero, retornaremos a mensagem "Aumento deve ser positivo" e encerraremos a execução. Do contrário, incrementaremos o atributo <code>$salario</code> da instância com o <code>$valorAumento</code>.

```php

public function recebeAumento(float $valorAumento): void
{
    if ($valorAumento < 0) {
        echo "Aumento deve ser positivo";
        return;
    }

    $this->salario += $valorAumento;
}

```

Quando um <code>Desenvolvedor</code> subir de nível, executaremos o método <code>recebeAumento()</code> passando como parâmetro a multiplicação do seu salário por <code>0.75</code>.

```php

class Desenvolvedor extends Funcionario
{
    public function sobeDeNivel()
    {
        $this->recebeAumento($this->recuperaSalario() * 0.75);
    }
}

```

Repare que não somente o nosso <code>Diretor</code> pôde ter funcionalidades novas, como também o <code>Desenvolvedor</code>. Para testarmos, no arquivo <code>bonificacoes.php</code>, depois de instanciarmos o <code>Desenvolvedor</code> em <code>$umFuncionario</code>, executaremos a chamada de <code>$umFuncionario->sobeDeNivel()</code>.

```php

$umFuncionario = new Desenvolvedor(
    'Vinicius Dias',
    new CPF('123.456.789-10'),
    'Desenvolvedor',
    1000
);

$umFuncionario->sobeDeNivel();

```

Se executarmos esse arquivo, a bonificação será maior: **13175**

Vamos recapitular? Tínhamos regras muito complexas no cálculo da bonificação dos nossos funcionários, nos obrigando a editar uma funcionalidade já existente toda vez que criássemos um novo cargo - algo que sabemos não ser ideal. Pensando nisso, criamos classes específicas para cada atribuição - <code>Diretor</code>, <code>Gerente</code> e <code>Desenvolvedor</code>, cada uma com sua bonificação específica (ou a bonificação padrão de um <code>Funcionario</code>) ou contendo funcionalidades extras.

Feitas essas alterações, a criação de um <code>Funcionario</code> deixou de fazer sentido, portanto a tornamos abstrata. A partir de agora, podemos criar novos cargos a partir de novas classes.

Porém, ainda existe um detalhe a ser resolvido. O método <code>adicionaBonificacaoDe()</code> ainda recebe um <code>Funcionario</code>, mas estamos passando um objeto do tipo <code>Desenvolvedor</code>, <code>Gerente</code> ou <code>Diretor</code>. Conversaremos melhor sobre isso no próximo vídeo.

</details>

### O que aprendi neste módulo:

- Aprendi o 4º pilar da orientação a objetos que é o Polimorfismo;

- Vi que a mesma referência pode se comportar de diversas formas dependendo do contexto, e essa é uma explicação simplória do polimorfismo;

- Reforçei meu conhecimento sobre herança criando diversas novas classes;

- Aprendi o conceito de uma classe de serviço, que representa uma funcionalidade ao invés de representar um modelo de nosso domínio;
