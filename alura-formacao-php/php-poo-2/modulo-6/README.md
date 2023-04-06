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

O que aprendi neste módulo:

- O que são os métodos mágicos no PHP, que são métodos chamados automaticamente em determinados momentos;

- Aprendemos a implementar o __toString e o __get;

- Conhecemos as traits e vimos um uso prático deste recurso;