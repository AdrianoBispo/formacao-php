# Métodos Mágicos


<!-- Documentação AULA 1 -->

<details>
  <summary>
    <h2> Aula 1 </h2>
  </summary>

  <h3> Exibindo como String </h3>

Chegamos ao capítulo final dessa segunda parte do treinamento de introdução à orientação a objetos com o PHP. Nesse momento, nos chegou uma nova demanda pedindo a preparação de um relatório com os endereços que temos cadastrados. Começaremos pensando em uma maneira de exibirmos esses endereços.

Criaremos na raiz do projeto um arquivo de testes enderecos.php no qual importaremos o autoload e criaremos os objetos $umEndereco, com as informações 'Petrópolis', 'bairro qualquer', 'Minha rua', '71b', e $outroEndereco com as informações 'Rio', 'Centro', 'Uma rua aí', '50'.

```php

<?php

use Alura\Banco\Modelo\Endereco;

require_once 'autoload.php';

$umEndereco = new Endereco(
    'Petrópolis',
    'bairro qualquer',
    'Minha rua',
    '71b'
);
$outroEndereco = new Endereco(
    'Rio',
    'Centro',
    'Uma rua aí',
    '50'
);

```

Um formato interessante de exibirmos esses dados é "Rua, número, bairro, cidade". Para isso, poderíamos executar um echo e concatenar as chamadas de $umEndereco->recuperaRua(), $umEndereco->recuperaBairro() e assim por diante, tomando cuidado para formatar o texto corretamente. Parece trabalhoso e realmente é, quando na verdade só queremos exibir o endereço como string.

Pensando nisso, poderíamos ter na classe Endereco um método como formataEndereco() que nos devolvesse os dados cadastrados no formato desejado. A ideia é que, quando tentarmos acessar $umEndereco como uma string, por exemplo exibindo-o com o echo, recebamos as informações nesse formato.

```php

<?php

use Alura\Banco\Modelo\Endereco;

require_once 'autoload.php';

$umEndereco = new Endereco(
    'Petrópolis',
    'bairro qualquer',
    'Minha rua',
    '71b'
);
$outroEndereco = new Endereco(
    'Rio',
    'Centro',
    'Uma rua aí',
    '50'
);

echo $umEndereco;

```

Quando escrevemos o código dessa forma, o PhpStorm nos exibe uma mensagem indicando a ausência do método __toString. Como comentado nos treinamentos anteriores, todos os métodos iniciados com __ são conhecidos como "métodos mágicos" do PHP, e que em alguns momentos são chamados de forma automática.

Sendo assim, implementaremos na classe Endereco o método __toString(), que retornará uma string e, no corpo, definirá a formatação do texto. Para isso, retornaremos primeiro $this->rua, seguido de $this->numero, $this->bairro e $this->cidade. Para nos precavermos em relação a erros, rodearemos cada um desses dados com chaves.

```php

public function __toString(): string
{
    return "{$this->rua}, {$this->numero}, {$this->bairro}, {$this->cidade}";
}

```

Feito isso, se executarmos o arquivo endereco.php, teremos como retorno: **__Minha rua, 71b, bairro qualquer, Petrópolis__**

Faremos um novo teste concatenando $umEndereco com . PHP_EOL, de modo a pularmos uma linha, e em seguida incluindo um echo de $outroEndereco.

```php

echo $umEndereco . PHP_EOL;
echo $outroEndereco;

```

Como resultado, teremos:

**__Minha rua, 71b, bairro qualquer, Petrópolis__**

**__Uma rua aí, 50, Centro, Rio__**

Perceba que o método mágico __toString() nos permite representar qualquer objeto como string. Lembrando que todos os métodos mágicos do PHP começam com __, e existem vários deles. Justamente por essa convenção, a documentação da linguagem não recomenda a criação de métodos com __.

Agora que conhecemos um novo método mágico, queremos acessar$umEndereco->rua diretamente, sem chamarmos o método recuperaRua(). Conversaremos sobre essa possibilidade no próximo vídeo.

</details>


<!-- Documentação AULA 2 -->

<details>
  <summary>
    <h2> Aula 2 </h2>
  </summary>

  <h3> Acessando Atributos Livremente </h3

Nosso objetivo agora é acessarmos de forma livre os atributos dos objetos do tipo Endereco, e queremos fazer isso por meio de métodos mágicos. Quando digitamos __ no PhpStorm, nos é exibida a lista de métodos mágicos disponíveis. Por exemplo, temos o __call(), que é chamado quando tentamos executar um método que não existe ou que é privado; o __clone(), usado para criar uma cópia de um objeto; __debugInfo(), executado quando fazemos o var_dump() de uma referência que aponta para uma instância; e o __destruct(), o método destrutor que já conhecemos anteriormente.

O método que estamos buscando é o __get(), que recebe como parâmetro uma string representando o nome do atributo que queremos acessar. Para provarmos isso, faremos um echo do $nomeAtributo recebido no método.

```php

public function __get(string $nomeAtributo)
{
    echo $nomeAtributo;
        exit();
}

```

Com isso, se incluirmos um $umEndereco->rua no nosso script endereco.php, o texto "rua" será exibido no console. A ideia é que, quando recebermos o nome do atributo rua, seja executado o método recuperaRua() - ou seja, queremos colocar a primeira letra do nome em maiúsculo e adicionar o texto recupera como prefixo.

Para transformarmos a primeira letra do nome recebido em maiúscula, podemos usar a função ucfirst() do PHP (de upper case first). Armazenaremos o retorno em uma variável $metodo e concatenaremos o seu conteúdo com a string recupera.

```php

public function __get(string $nomeAtributo)
{
    $metodo = ucfirst($nomeAtributo);
    $metodo = 'recupera' . $metodo;
}

```

Podemos, inclusive, colocar esses dois passos em uma só linha. Em seguida, retornaremos a chamada de $this->$metodo().

```php

public function __get(string $nomeAtributo)
{
    $metodo = 'recupera' . ucfirst($nomeAtributo);
    return $this->$metodo();
}

```

Em endereco.php, incluiremos o echo de $umEndereco->bairro e pararemos a execução do script com um exit().

```php

require_once 'autoload.php';

$umEndereco = new Endereco(
    'Petrópolis',
    'bairro qualquer',
    'Minha rua',
    '71b'
);
$outroEndereco = new Endereco(
    'Rio',
    'Centro',
    'Uma rua aí',
    '50'
);

echo $umEndereco->bairro;
exit();

```

Como retorno, teremos "bairro qualquer", indicando que tudo foi executado corretamente. Se alterarmos a chamada para $umEndereco->cidade, o retorno será "Petrópolis". Com isso, não mais precisaremos dos métodos de acesso.

Repare, entretanto, que a IDE não nos ajuda sugerindo tais atributos, mostrando apenas os métodos que definimos anteriormente. É possível contornar esse "problema" adicionando annotations (anotações) no código. No PhpStorm, podemos fazer isso digitando /** antes da classe e pressioando "Enter", o que fará com que o esqueleto de uma annotation seja incluído automaticamente.

Adicionaremos, então, uma nova annotation chamada @property-read, que representa propriedades que só podem ser lidas. Em seguida, definiremos o tipo da propriedade (string) e passaremos o seu nome, no caso $cidade. Continuaremos repetindo esse processo até listarmos todas as propriedades de Endereco.

```php

/**
 * Class Endereco
 * @package Alura\Banco\Modelo
 * @property-read string $cidade
 * @property-read string $bairro
 * @property-read string $rua
 * @property-read string $numero
 */
class Endereco
{
    private $cidade;
    private $bairro;
    private $rua;
    private $numero;

    public function __construct(string $cidade, string $bairro, string $rua, string $numero)
    {
        $this->cidade = $cidade;
        $this->bairro = $bairro;
        $this->rua = $rua;
        $this->numero = $numero;
    }
//...

```

Terminadas as anotações, o PhpStorm passará a nos sugerir os atributos como opção de autocompletar - por exemplo, se digitarmos $umEndereco->r, a propriedade rua será sugerida. Além disso, não conseguiremos mais atribuir um valor a esse campo, por exemplo com $umEndereco->rua = '', pois o definimos como somente leitura.

Vamos recapitular? Nós implementamos o método mágico __get(), que é chamado sempre tentamos acessar um atributo/propriedade que não existe ou é privado. Por meio dele, montamos uma lógica que coloca a primeira letra do nome desse atributo em letra maiúscula e adiciona a string recupera ao início, resultando no padrão que utilizamos nos nossos métodos de acesso (getters). Com isso, conseguimos o nome do método, a partir do qual conseguimos recuperar o conteúdo do atributo.

Para que as IDE nos ajude com sugestões de autocompletar, incluímos na classe Endereco anotações informando a existência de propriedades de leitura chamadas $cidade, $bairro, $rua e $numero.

Já começamos a entender os métodos mágicos e, como dito anteriormente, existem vários outros, como o __invoke(), que é chamado qunado tentamos utilizar uma referência como se fosse uma função.

Para que você se aprofunde mais nesse assunto, fica o desafio de fazer com o método __set() o mesmo que fizemos com o __get(). Tal método recebe dois parâmetros: o nome do atributo e o valor que será atribuído a ele. Não se esqueça de deixar a sua solução no fórum do curso para que nossos instrutores e alunos possam corrigi-la e dar dicas de como aprimora-la!

Agora voltaremos ao assunto da herança. No nosso sistema a classe Endereco representa uma entidade o mais específica possível. Ou seja, não existiria, por exemplo, uma classe EnderecoDosEUA que herdasse dessa classe, adicionando uma nova informação. Pensando nisso, queremos impedir a herança dessa classe. Descobriremos se isso é possível no próximo vídeo.

#### Exercício Proposto

Envie aqui sua proposta do método <code>__set</code> e veja a solução de outros alunos:

https://cursos.alura.com.br/forum/topico-exercicio-__set-98206

</details>


<!-- Documentação AULA 3 -->

<details>
  <summary>
    <h2> Aula 3 </h2>
  </summary>

  <h3> Impedindo a Herança </h3

Existem alguns casos, ainda que raros, nos quais desejamos impedir a herança. Por exemplo, não queremos que nenhuma classe estenda de Endereco ou CPF, pois essas são classes definitivas e únicas. Para isso, precisamos informar ao PHP que, independentemente de como for a hierarquia até aquele ponto, a classe com que estamos trabalhando é a final - algo que é feito usando exatamente a palavra final.

```php

final class CPF
{
    private $numero;

    public function __construct(string $numero)
    {
        $numero = filter_var($numero, FILTER_VALIDATE_REGEXP, [
            'options' => [
                'regexp' => '/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}$/'
            ]
        ]);
        if ($numero === false) {
            echo "Cpf inválido";
            exit();
        }
        $this->numero = $numero;
    }
//...

```

Quando informamos que uma classe final, a própria IDE adiciona um "pin" visual indicando que ela foi fixada e não pode mais ser herdada. Inclusive, se tentarmos estender CPF em algum ponto do código, o PhpStorm nem mesmo encontrará a classe. Mesmo passando todo o endereço de CPF, incluindo o seu namespace, teremos um erro indicando que não é possível herdar de uma classe que tem final na sua definição.

Repetiremos esse processo para a classe Endereco, impedindo que ela também seja herdada. Continuando nesse raciocínio, temos na classe Pessoa um método validaNomeTitular(), que renomearemos para validaNome() de modo a adequá-lo melhor à sua funcionalidade.

```php

protected function validaNome(string $nomeTitular)
{
    if (strlen($nomeTitular) < 5) {
        echo "Nome precisa ter pelo menos 5 caracteres";
        exit();
    }
}

```

O método validaNome() pode ser usado também pelas classes filhas, mas não queremos que ele seja modificado, por exemplo criando em Funcionario um novo método validaNome() que não faz absolutamente nada. Para que isso se torne proibido, também podemos usar a palavra-chave final.

```php

final protected function validaNome(string $nomeTitular)
{
    if (strlen($nomeTitular) < 5) {
        echo "Nome precisa ter pelo menos 5 caracteres";
        exit();
    }
}

```

A classe Pessoa continuará sendo herdada sem problemas, mas o método validaNome() não mais poderá ser sobrescrito. Com isso ganhamos segurança no nosso sistema de hierarquia de classes, controlando quais comportamentos podem ou não ser adicionados. Isso é bastante interessante, por exemplo, em situações nas quais criamos classes que serão utilizadas por várias outras pessoas.

</details>


<!-- Documentação AULA 3 -->

<details>
  <summary>
    <h2> Aula 3 </h2>
  </summary>

  <h3> Impedindo a Herança </h3

Nesse capítulo falamos sobre algumas peculiaridades do PHP, como os métodos mágicos, e nesse vídeo bônus comentaremos sobre outra: as traits.

Em Endereco, estamos usando o método __get() para pegarmos o nome de um atributo e o transformarmos no nome do método acessor desse mesmo atributo. Porém, não é só o Endereco que possui atributos privados que gostaríamos de acessar. Por exemplo, poderíamos ler o $nome e o $cpf da classe Pessoa, sem precisarmos chamar os métodos acessores desses atributos.

Uma solução para isso seria criarmos uma classe extra que servisse de herança para Endereco e Pessoa e possuísse o método desejado. Entretanto, estaríamos obrigando classes completamente diferentes a herdarem de uma terceira simplesmente para ganharmos acesso a um método, às vezes até mesmo impedindo uma classe mais importante de ser herdada, já que o PHP não permite a herança múltipla. Além disso, o método recuperaRua(), por exemplo, não poderia ser chamado de uma classe base, incorrendo em mais um problema com a herança.

Outra alternativa é simplesmente copiarmos a estrutura do método __get() e colarmos na classe Pessoa, algo que sabemos que não é ideal. Seria interessante se existisse uma forma do próprio PHP copiar código de algum local e injetá-lo na classe desejada. O PHP na verdade possui tal funcionalidade, e ela se chama trait.

Para testarmos, criaremos no diretório "Modelo" uma nova classe "AcessoPropriedades" utilizando o template "Trait" disponibilizado pela IDE.

```php

<?php


namespace Alura\Banco\Modelo;


trait AcessoPropriedades
{

}

```

Repare que a estrutura é bem parecida com a de uma classe, alterando somente a palavra class para trait. Removeremos a definição do método __get() da classe Endereco e o passaremos para a trait que criamos.

```php

trait AcessoPropriedades
{
    public function __get(string $nomeAtributo)
    {
        $metodo = 'recupera' . ucfirst($nomeAtributo);
        return $this->$metodo();
    }
}

```

Na classe Endereco, incluiremos a instrução use AcessoPropriedades.

```php

final class Endereco
{
    use AcessoPropriedades;

    private $cidade;
    private $bairro;
    private $rua;
    private $numero;
//...

```

Na aula de namespaces comentamos que a palavra use poderia significar coisas diferentes dependendo de onde ela é colocada em uma arquivo. Nesse caso, como estamos colocando-a diretamente dentro de uma classe, quer dizer que estamos utilizando uma trait. Isso implica que o PHP irá "colar" o conteúdo da trait no local informado, como se estivéssemos fazendo um "copia e cola" dos seus métodos, permitindo acesso ao __get().

Isso também é vantajoso pois podemos utilizar quantas traits forem necessárias. Isso não é uma herança pois o PHP executa processos diferentes por baixo dos panos. Da mesma forma que incluímos o use AcessoPropriedades na classe Endereco, podemos fazer o mesmo em Pessoa.

```php

abstract class Pessoa
{
    use AcessoPropriedades;
    protected $nome;
    private $cpf;
//...

```

Com isso, podemos, por exemplo, criar um novo $desenvolvedor e tentar acessar a sua propriedade $desenvolvedor->nome.

```php

$desenvolvedor = new Desenvolvedor('Vinicius', new CPF('123.456.789-10'), 2000);
$desenvolvedor->nome;

```

O próprio PhpStorm não nos indicará um erro, pois o método mágico __get() existe na classe Pessoa, e todos os herdeiros dessa classe também terão acesso a ele. A utilização de traits é interessante, mas também perigosa. Devemos ponderar bastante a inclusão de métodos nas traits de modo a evitar confusões e problemas de manutenção.

### Para saber mais: Traits

O PHP fornece uma outra forma de reutilizarmos código, sem a necessidade de herança, através de **Traits**.

Seu uso tem se tornado mais comum, com a evolução da linguagem, então vale a pena dar uma lida sobre Traits na documentação oficial do PHP: https://www.php.net/manual/en/language.oop5.traits.php.

</details>

## Para saber mais: Arquitetura

Organização de pastas
Durante os treinamentos de Orientação a Objetos, nós organizamos nossas pastas utilizando uma estrutura bastante comum.

Existe uma pasta raiz para nosso código (src) que inclusive facilita que a gente siga à PSR-4.

Dentro dessa pasta raiz, temos sub pastas que identificam responsabilidades em nosso sistema

Arquitetura
Organização de pastas em nosso código é um início bem simplório de um estudo sobre arquitetura. Como organizar nosso projeto é um estudo muito importante e existem vários livros, palestras e conteúdo em geral sobre isso

Alternativas à nossa abordagem
É muito comum e recomendado por muitos que ao invés de separar as sub pastas por responsabilidade (Model, Service, etc.), separemos por conceitos de domínio, parecido com o que fizemos dentro da pasta Model. Estudos específicos de arquitetura e design de código abordam estes conceitos com muito mais detalhes.

## O que aprendi neste módulo:

- O que são os métodos mágicos no PHP, que são métodos chamados automaticamente em determinados momentos;

- Aprendemos a implementar o __toString e o __get;

- Conhecemos as traits e vimos um uso prático deste recurso;