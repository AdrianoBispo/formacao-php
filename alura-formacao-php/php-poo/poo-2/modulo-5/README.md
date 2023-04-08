# Interfaces

<!-- Documentação AULA 1 -->

<details>
  <summary>
    <h2> Aula 1</h2>
  </summary>

  <h3> Classe Abstrata </h3>

O banco nos passou uma nova demanda: a partir de agora cada cargo terá sua própria bonificação, e a bonificação padrão deixará de existir. Isso implica também que todo novo cargo precisará, obrigatoriamente, de uma bonificação própria. Antes de mais nada, corrigiremos um problema da nossa classe Funcionario, que ainda possui um atributo $cargo não mais necessário.

```php

abstract class Funcionario extends Pessoa
{
    private $salario;

    public function __construct(string $nome, CPF $cpf, float $salario)
    {
        parent::__construct($nome, $cpf);
        $this->salario = $salario;
    }
//...

```

Feito isso, removeremos também os pontos em que definíamos o cargo dos funcionários no arquivo bonificacoes.php.

```php

$umFuncionario = new Desenvolvedor(
    'Vinicius Dias',
    new CPF('123.456.789-10'),
    1000
);

$umFuncionario->sobeDeNivel();

$umaFuncionaria = new Gerente(
    'Patricia',
    new CPF('987.654.321-10'),
    3000
);

$umDiretor = new Diretor(
    'Ana Paula', new CPF('123.951.789-11')
    , 5000
);

```

Como não existe mais bonificação padrão, removeremos o método calculaBonificacao() da classe Funcionario. Sem ele, teremos que implementar a bonificação do Desenvolvedor, que passará a receber um valor fixo de 500.

```php

class Desenvolvedor extends Funcionario
{
    public function sobeDeNivel()
    {
        $this->recebeAumento($this->recuperaSalario() * 0.75);
    }

    public function calculaBonificacao(): float
    {
        return 500.0;
    }
}

```

Executando o arquivo bonificacoes.php, tudo continuará funcionando corretamente. Passaremos para a criação de um novo cargo, EditorVideo, que será armazenado no diretório "Funcionario" e fará parte do namespace Funcionario.

```php

<?php

namespace Alura\Banco\Modelo\Funcionario;


class EditorVideo extends Funcionario
{

}

```

Em bonificacoes.php, criaremos uma nova instância de Editor, chamada $umEditor, com o nome "Paulo", o CPF "456.987.231-11" e o salário 1500. Além disso, incluiremos a bonificação de $umEditor pelo método adicionaBonificacao().

```php

//...código omitido ...//

$umEditor = new EditorVideo('Paulo',
    new CPF('456.987.231-11'),
    1500
);

$controlador = new ControladorDeBonificacoes();
$controlador->adicionaBonificacaoDe($umFuncionario);
$controlador->adicionaBonificacaoDe($umaFuncionaria);
$controlador->adicionaBonificacaoDe($umDiretor);
$controlador->adicionaBonificacaoDe($umEditor);

echo $controlador->recuperaTotal();

```

Ao executarmos, receberemos um erro informando que o método calculaBonificacao() não foi definido na classe EditorVideo. Seria mais interessante se a IDE tivesse nos avisado da ausência desse método, já que todo Funcionario precisa de uma bonificação. Felizmente já sabemos fazer isso: se uma funcionalidade precisa existir para todas as classes, mas não tem uma implementação padrão, podemos lançar mão dos métodos abstratos. Nesse caso, em Funcionario, incluiremos o método abstrato calculaBonificacao() devolvendo um float.

```php
abstract public function calculaBonificacao(): float;
```

Dessa forma, a classe EditorVideo passará a apresentar um erro informando a necessidade da implementação do método calculaBonificacao(), algo que pode ser feito automaticamente com o atalho "Alt + Enter". Em seguida, definiremos que a bonificação devolvida é o valor fixo 600.

```php

class EditorVideo extends Funcionario
{

    public function calculaBonificacao(): float
    {
        return 600;
    }
}

```

A ideia desse exercício é nos aprofundarmos um pouco mais nas classes e métodos abstratos. Sendo assim, vamos recapitular o que fizemos até agora. Sabemos que todo funcionário de uma empresa tem um cargo. Portanto, podemos afirmar que ser um funcionário de uma empresa é algo mais abstrato do que, por exemplo, ser um diretor ou gerente de uma empresa; por sua vez, também podemos afirmar que os cargos são conceitos mais concretos dentro de uma empresa do que simplesmente ser um funcionário.

No nosso sistema, a classe Funcionario é um conceito, e não está pronta/apta para ser utilizada como objeto. Justamente por isso a chamamos de abstrata. Já um método abstrado é uma indicação de que aquela implementação é necessária em todas as classes que também representem um funcionário, ou seja, as classes filhas, mas não existe uma implementação padrão desse método.

Sempre que tivermos a palavra abstract no código, sabemos que ela está relacionada a herança. No caso, alguma classe precisa estender de Funcionario para que suas características façam sentido. Tais classes, por sua vez, precisarão implementar os métodos abstratos da classe base/mãe.

Isso garante que, ao cessarmos uma instância de Funcionario no método adicionaBonificacaoDe(), teremos também acesso ao método calculaBonificacao(). Se removermos a implementação abstrata de calculaBonificacao() da classe Funcionario e tentarmos acessar esse método em adicionaBonificacaoDe(), a própria IDE nos indicará que será impossível encontrá-lo.

O PHP funciona de maneira diferente de outras linguagens estritamente/estaticamente tipadas, pois chamará o método calculaBonificacao() mesmo que o objeto recebido em adicionaBonificacaoDe() não seja do tipo Funcionario. Se o método existir, ele será encontrado; do contrário, incorreremos em um erro.

Da mesma forma que <code>Funcionario</code>, faz sentido transformarmos a classe <code>Pessoa</code> em abstrata - afinal, em nosso sistema, temos funcionários (com seus respectivos cargos) ou titulares de uma conta.

```php

abstract class Pessoa
{
    protected $nome;
    private $cpf;

    public function __construct(string $nome, CPF $cpf)
    {
        $this->validaNomeTitular($nome);
        $this->nome = $nome;
        $this->cpf = $cpf;
    }
//...

```

Repare que uma classe pode ser abstrata mesmo que ela não tenha métodos abstratos. Agora que fizemos uma revisão dos conceitos de classes e métodos abstratos, não deixe de fazer os exercícios e expor as suas dúvidas no fórum!

</details>


<!-- Documentação AULA 2 -->

<details>
  <summary>
    <h2> Aula 2</h2>
  </summary>

  <h3> Sistema de Login </h3>

Nosso objetivo agora é implementarmos um sistema de login, algo que já comentamos anteriormente - inclusive, a entidade Diretor já possui um método podeAutenticar() que será usado nesse processo. No diretório "Service", criaremos uma nova classe de serviço Autenticador na na qual teremos um método tentaLogin() que recebe como parâmetros um Diretor e uma string $senha.

```php

class Autenticador
{
    public function tentaLogin(Diretor $diretor, string $senha): void
    {

    }
}

```

No corpo do método, usaremos o operador if para verificarmos se $diretor->podeAutenticar() com a $senha recebida. Em caso positivo, mostraremos a mensagem "Ok. Usuário logado no sistema"; do contrário, se a senha estiver errada, exibiremos a mensagem "Ops. Senha incorreta".

```php

class Autenticador
{
    public function tentaLogin(Diretor $diretor, string $senha): void
    {
        if ($diretor->podeAutenticar($senha)) {
            echo "Ok. Usuário logado no sistema";
        } else {
         echo "Ops. Senha incorreta.";
        }
    }
}

```

Para testarmos, criaremos na raiz do projeto um novo arquivo autenticacao.php. Nele importaremos o autoload.php e criaremos um novo $autenticador, além de um Diretor com o nome "João da Silva", o CPF "123.456.789-10" e o salário 10000.

```php

<?php

use Alura\Banco\Modelo\CPF;
use Alura\Banco\Modelo\Funcionario\Diretor;
use Alura\Banco\Service\Autenticador;

require_once 'autoload.php';

$autenticador = new Autenticador();
$diretor = new Diretor(
    'João da Silva',
    new CPF('123.456.789-10'),
    10000
);

```

Prosseguindo, chamaremos o método $autenticador->tentaLogin() passando o $diretor criado e a senha 4321.

```php

$autenticador = new Autenticador();
$diretor = new Diretor(
    'João da Silva',
    new CPF('123.456.789-10'),
    10000
);

$autenticador->tentaLogin($diretor, '4321');

```

Ao executarmos o arquivo, teremos como retorno: **__Ops. Senha incorreta.__**

Já se alterarmos a senha para 1234, receberemos a mensagem de sucesso: **__Ok. Usuário logado no sistema__**

Concluímos então a implementação de um autenticador simulado, ainda que bastante simples. Agora surgiu uma nova demanda do banco na qual o Gerente também deverá se autenticar no nosso sistema.

Uma primeira solução para isso seria passarmos a receber, no método tentaLogin(), um Funcionario. Entretanto, isso implica na possibilidade do Desenvolvedor e do EditorVideo também se logarem - ou seja, essa não é a solução ideal. No próximo vídeo conversaremos sobre algumas alternativas.

</details>


<!-- Documentação AULA 3 -->

<details>
  <summary>
    <h2> Aula 3</h2>
  </summary>

  <h3> Herança Múltipla </h3>

Terminamos o vídeo anterior com uma nova demanda, na qual, além do Diretor, um Gerente também deve conseguir se autenticar. Sabemos que não é ideal dependermos do Funcionario para isso, pois implicaria na inclusão de diversos if no nosso código, mas a herança pode nos ajudar a resolver esse problema.

Por exemplo, podemos fazer com que Diretor e Gerente estendam de outra classe, chamada FuncionarioAutenticavel. Assim, evitaremos que o Desenvolvedor e o EditorVideo tenham acesso à autenticação.

<img src="https://caelum-online-public.s3.amazonaws.com/1538-php-oo-parte-2/Transcricao/autenticavel.png" alt="Diagrama exemplificando" />

Ou seja, além da classe Funcionario, teremos uma outra chamada FuncionarioAutenticavel possuindo um método podeAutenticar() que ficará acessível tanto a Diretor quanto a Gerente.

Agora imagine que temos uma nova demanda na qual o Titular de uma conta também deverá ter acesso ao sistema. Nesse caso, bastará fazermos com que essa classe também estenda de FuncionarioAutenticavel, certo? Na verdade isso não faz sentido, afinal o Titular não é um FuncionarioAutenticavel, nem mesmo necessariamente um Funcionario. Isso faria, por exemplo, com que o Titular tivesse um salário e passasse a receber bonificação. Ou seja, teremos que pensar em outra abordagem.

Uma ideia seria criarmos uma classe separada, chamada Autenticavel, que poderia ser estendida tanto por Titular quanto por Diretor e Gerente. A possibilidade de uma classe filha estender de mais de uma classe base/mãe é o que chamamos de herança múltipla. Nesse caso, Diretor e Gerente estenderão tanto de Autenticavel quanto de Funcionario.

<img src="https://caelum-online-public.s3.amazonaws.com/1538-php-oo-parte-2/Transcricao/autenticavel2.png" alt="Diagrama exemplificando" />

Isso é possível em linguagens como o C++, mas não em outras, como Java e o próprio PHP. Mas se a herança múltipla parece algo tão útil, por que ela não existe em PHP?

Imagine que tenhamos na classe Funcionario um método chamado teste(), e outro com o mesmo nome na classe Autenticavel. Se Diretor herdar das duas classes, qual das duas implementações será herdada e executada quando o método teste() for chamado em uma instância de Diretor? Chamamos esse cenário de problema diamante, em referência ao desenho formado pela implementação lógica desse problema.

Como o PHP é uma das linguagens que não implementa a herança múltipla, teremos que encontrar outra forma de implementar um método podeAutenticar(), de maneira parecida com a existência de uma classe Autenticavel, mas mantendo somente a herança de Funcionario. Ou seja, a ideia é termos uma outra estrutura, que não é uma classe, firmando uma espécie de "contrato" que permitirá acesso ao método desejado. Entenderemos que estrutura é essa e como implementá-la no próximo vídeo.

### Para saber mais: Problema Diamante

Diversas linguagens de programação modernas abriram mão de permitir a herança múltipla, devido a um problema conhecido como **Problema Diamante**.

Se quiser entender mais sobre o assunto, é uma pesquisa que vale a pena. Aqui estão alguns links:

<a href="https://en.wikipedia.org/wiki/Multiple_inheritance#The_diamond_problem">The diamond problem</a>
<a href="https://www.alura.com.br/apostila-python-orientacao-a-objetos/heranca-multipla-e-interfaces#problema-do-diamante">Problema do diamante</a>

</details>


<!-- Documentação AULA 4 -->

<details>
  <summary>
    <h2> Aula 4</h2>
  </summary>

  <h3> Interface </h3>

Nosso objetivo agora é mantermos a herança de Funcionario em Gerente e Diretor, mas encontrarmos uma forma de Titular também conseguir acesso ao método podeAutenticar().

<img src="https://caelum-online-public.s3.amazonaws.com/1538-php-oo-parte-2/Transcricao/autenticavel2.png" alt="Diagrama exemplificando" />

A ideia é recebermos, no nosso Autenticador, um objeto do tipo Autenticavel. Inclusive, alteraremos o nome do parâmetro recebido de $diretor para $autenticavel. No método, verificaremos se $autenticavel pode se autenticar com a $senha que é passada. Em caso positivo, ele será logado; do contrário, informaremos que a senha está incorreta.

```php

class Autenticador
{
    public function tentaLogin(Autenticavel $autenticavel, string $senha): void
    {
        if ($autenticavel->podeAutenticar($senha)) {
            echo "Ok. Usuário logado no sistema";
        } else {
         echo "Ops. Senha incorreta.";
        }
    }
}

```

No vídeo anterior, quando conversamos sobre o problema da herança múltipla, vimos que surgem conflitos quando uma classe tenta herdar implementações diferentes de um mesmo método a partir de heranças diferentes. Mas e se, ao invés de uma implementação, tivermos somente um método abstrato, ou seja, o conceito do método?

Para testarmos, criaremos no diretório "Modelo" uma classe Autenticavel. Note que, na tela de criação de classes do PhpStorm, existe uma opção "Template" que, além de "Class", oferece também as opções "Interface" e "Trait". Como ainda não sabemos o que significam, continuaremos normalmente.

Sabemos que essa classe precisa de um método podeAutenticar(), mas não queremos implementá-lo. Sendo assim, vamos criá-lo como abstrato e tornar também a classe Autenticável abstrata.

```php

abstract class Autenticavel
{

    abstract public function podeAutenticar(string $senha): bool;

}

```

Com isso temos uma classe na qual todos os métodos são abstratos, certo? Mesmo assim, não conseguiremos fazer com que Diretor herde tanto de Funcionario quanto de Autenticavel, com o próprio PhpStorm nos indicando essa impossibilidade. Queremos uma forma de utilizarmos a assinatura do método podeAutenticar(), sem necessariamente recebermos essa classe, algo que é possível por meio de uma **interface**.

O conceito de interface representa, basicamente, uma classe abstrata com todos os seus métodos abstratos. Portanto, ao invés de chamarmos nossa Autenticavel de classe abstrata, vamos defini-la como interface. Como por definição os métodos de uma interface são abstratos, não precisaremos incluir a palavra reservada abstract na assinatura de podeAutenticar().

```php

interface Autenticavel
{
    public function podeAutenticar(string $senha): bool;

}

```

Feito isso, poderemos fazer com que nosso Diretor, além de estender de Funcionario, implemente a interface Autenticavel, algo que é feito com a palavra implements.

```php

<?php

namespace Alura\Banco\Modelo\Funcionario;

use Alura\Banco\Modelo\Autenticavel;

class Diretor extends Funcionario implements Autenticavel
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

Uma classe pode implementar quantas interfaces forem necessárias, sem limitação. Por exemplo, o PHP possui uma interface \JsonSerializable que nos obriga a implementar o seu método jsonSerialize().

```php

class Diretor extends Funcionario implements Autenticavel, \JsonSerializable
{
    public function calculaBonificacao(): float
    {
        return $this->recuperaSalario() * 2;
    }

    public function podeAutenticar(string $senha): bool
    {
        return $senha === '1234';
    }

    public function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }
}

```

Feito esse teste, removeremos a interface \JsonSerializable do nosso código e implementaremos nossa nova interface também na classe Gerente. Com o atalho "Alt + Enter", conseguiremos inserir automaticamente o esqueleto do método podeAutenticar().

```php

namespace Alura\Banco\Modelo\Funcionario;

use Alura\Banco\Modelo\Autenticavel;

class Gerente extends Funcionario implements Autenticavel
{
    public function calculaBonificacao(): float
    {
        return $this->recuperaSalario();
    }

    public function podeAutenticar(string $senha): bool
    {
        // TODO: Implement podeAutenticar() method.
    }
}

```

No caso do Gerente, a implementação do método simplesmente retornará uma $senha com o valor 4321.

```php

public function podeAutenticar(string $senha): bool
{
    return $senha === '4321';
}

```

Repetiremos o processo com a classe Titular, dessa vez retornando uma $senha de valor abcd.

```php

namespace Alura\Banco\Modelo\Conta;

use Alura\Banco\Modelo\Autenticavel;
use Alura\Banco\Modelo\CPF;
use Alura\Banco\Modelo\Endereco;
use Alura\Banco\Modelo\Pessoa;

class Titular extends Pessoa implements Autenticavel
{
    private $endereco;

    public function __construct(CPF $cpf, string $nome, Endereco $endereco)
    {
        parent::__construct($nome, $cpf);
        $this->endereco = $endereco;
    }

    public function getEndreco(): Endereco
    {
        return $this->endereco;
    }

    public function podeAutenticar(string $senha): bool
    {
        return $senha === 'abcd';
    }
}

```

No Autenticador, passaremos a importar a classe Autenticavel, fazendo com que o PhpStorm identifique a presença do método podeAutenticar().

```php

namespace Alura\Banco\Service;

use Alura\Banco\Modelo\Autenticavel;

class Autenticador
{
    public function tentaLogin(Autenticavel $autenticavel, string $senha): void
    {
        if ($autenticavel->podeAutenticar($senha)) {
            echo "Ok. Usuário logado no sistema";
        } else {
         echo "Ops. Senha incorreta.";
        }
    }
}

```

Assim conseguiremos receber, no método tentaLogin(), um objeto do tipo Autenticavel e que possui o método podeAutenticar(), obstante o fato de ser um Diretor, Gerente, Titular ou qualquer outra quase. Quando implementamos uma interface, estamos nos comprometendo a implementar os métodos definidos nela.

Por exemplo, se incluirmos na interface Autenticavel um método teste(), por exemplo, seremos obrigados a implementá-lo nas classes Diretor, Gerente e Titular. Utilizando a interface, conseguimos chegar em algo próximo de uma herança múltipla, de maneira semelhante ao desenho que apresentamos no início do vídeo.

<img src="https://caelum-online-public.s3.amazonaws.com/1538-php-oo-parte-2/Transcricao/autenticavel2.png" alt="Diagrama exemplificando" />

Aqui as linhas pontilhadas representam a implementação de uma interface. O desenho também é parecido com o **diagrama de classes da UML**, mas não é fiel a um. Aqui na Alura existem treinamentos de UML caso você queira entender esse conceito.

Agora que implementamos a interface e temos um sistema completo, podemos testar a autenticação executando o arquivo autenticacao.php.

```php

use Alura\Banco\Modelo\CPF;
use Alura\Banco\Modelo\Funcionario\Diretor;
use Alura\Banco\Service\Autenticador;

require_once 'autoload.php';

$autenticador = new Autenticador();
$umDiretor = new Diretor(
    'João da Silva',
    new CPF('123.456.789-10'),
    10000
);

$autenticador->tentaLogin($umDiretor, '1234');

```

Como retorno, teremos a mensagem "Ok. Usuário logado no sistema", indicando que tudo ocorreu corretamente. Se substituirmos o Diretor por um Gerente, receberemos a mensagem informando que a senha está incorreta. Para corrigirmos isso, passaremos a senha correta, que é 4321.

```php

<?php

use Alura\Banco\Modelo\CPF;
use Alura\Banco\Modelo\Funcionario\Diretor;
use Alura\Banco\Modelo\Funcionario\Gerente;
use Alura\Banco\Service\Autenticador;

require_once 'autoload.php';

$autenticador = new Autenticador();
$umDiretor = new Gerente(
    'João da Silva',
    new CPF('123.456.789-10'),
    10000
);

$autenticador->tentaLogin($umDiretor, '4321');

```

Assim a mensagem de sucesso voltará a ser exibida. Da mesma forma, podemos passar um Titular, sem nos esquecermos de corrigir os parâmetros do construtor.

```php

use Alura\Banco\Modelo\Conta\Titular;
use Alura\Banco\Modelo\CPF;
use Alura\Banco\Modelo\Endereco;
use Alura\Banco\Modelo\Funcionario\Diretor;
use Alura\Banco\Modelo\Funcionario\Gerente;
use Alura\Banco\Service\Autenticador;

require_once 'autoload.php';

$autenticador = new Autenticador();
$umDiretor = new Titular(
    new CPF(
        '123.456.789-10'),
    'João da Silva',
    new Endereco(
        '',
        '',
        '',
        '')
);

$autenticador->tentaLogin($umDiretor, '4321');

```

Como estamos passando uma senha inválida, receberemos a mensagem de erro: **__Ops. Senha incorreta.__**

Agora temos uma forma de autenticação funcional para o Diretor, Gerente ou Titular, pois todos eles implementam a interface Autenticavel. O conceito de interface é bem simples, mas a sua utilização é muito importante na programação orientada a objetos. Inclusive, existe uma premissa no mundo da orientação a objetos dizendo que sempre devemos programar para interfaces ou abstrações, e nunca para as implementações.

É interessante que nossas funcionalidades dependam de classes abstratas ou interfaces, pois isso torna nosso sistema mais extensível e maleável. Como exemplo, podemos facilmente criar um novo tipo de cliente, que não é titular de uma conta mas pegou empréstimo no banco, e torná-lo autenticável.

Vamos recapitular? Interfaces são basicamente classes abstratas que possuem somente métodos abstratos, o que nos permite a implementação de múltiplas interfaces sem problemas, já que evitam o problema de herdar dois métodos "iguais" de classes diferentes. Esse é um tema denso, portanto não deixe de expôr as suas dúvidas no fórum e de fazer os exercícios.

No próximo e último capítulo deste treinamento conheceremos mais alguns conceitos interessantes da orientação a objetos em PHP!

</details>

## O que aprendi neste módulo:

- Entendi o conceito de herança múltipla e o porquê de muitas linguagens (PHP inclusive) não a permitirem;

- Vimos como "burlar" esta limitação utilizando interfaces;

- Aprendemos que no fundo, interfaces são apenas classes abstratas que contém apenas métodos abstratos;
