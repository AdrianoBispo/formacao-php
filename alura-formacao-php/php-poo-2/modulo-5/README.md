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

## O que aprendi neste módulo:

- Entendi o conceito de herança múltipla e o porquê de muitas linguagens (PHP inclusive) não a permitirem;

- Vimos como "burlar" esta limitação utilizando interfaces;

- Aprendemos que no fundo, interfaces são apenas classes abstratas que contém apenas métodos abstratos;
