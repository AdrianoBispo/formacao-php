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

</details>

## O que aprendi neste módulo:

- O que são os métodos mágicos no PHP, que são métodos chamados automaticamente em determinados momentos;

- Aprendemos a implementar o __toString e o __get;

- Conhecemos as traits e vimos um uso prático deste recurso;