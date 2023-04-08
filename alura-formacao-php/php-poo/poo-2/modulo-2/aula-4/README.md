## Namespace e Autoload - Autoload de Classes

Antes de prosseguirmos, recapitularemos rapidamente o que fizemos no último vídeo. Aprendemos que, se definimos uma classe utilizando um _namespace_, também precisaremos informá-lo ao utilizarmos essa classe. Isso pode ser feito diretamente na sua utilização, passando o seu endereço completo, ou com a instrução <code>use</code> no início do arquivo (fora da definição de qualquer classe ou função). Com as classes "importadas", poderemos utilizá-las normalmente com seu nome mais curto.

Na classe <code>Titular</code>, por exemplo, estamos usando várias classes por meio da palavra reservada <code>use</code>.

```php

<?php

namespace Alura\Banco\Modelo\Conta;

use Alura\Banco\Modelo\CPF;
use Alura\Banco\Modelo\Endereco;
use Alura\Banco\Modelo\Pessoa;

class Titular extends Pessoa
{
    private $endereco;

    public function __construct(CPF $cpf, string $nome, Endereco $endereco)
    {
        parent::__construct($nome, $cpf);
        $this->endereco = $endereco;
    }
    
    //...
}

```

Ela deve estar fora da definição de qualquer classe ou função pois ela assume outros significados nesses e em outros locais. As IDEs mais completas de PHP já nos ajudam a fazer essas importações no local correto, mas se você estiver utilizando um editor de texto, deverá se atentar a esse detalhe.

Finalizamos o vídeo discutindo as importações que estamos fazendo no arquivo <code>banco.php</code>, nas quais identificamos alguns problemas, como uma aparente duplicação e a necessidade de fazermos o <code>require</code> de todos os arquivos sem a ajuda da IDE.

```php

<?php

require_once 'src/Modelo/Conta/Conta.php';
require_once 'src/Modelo/Endereco.php';
require_once 'src/Modelo/Pessoa.php';
require_once 'src/Modelo/Conta/Titular.php';
require_once 'src/Modelo/CPF.php';

use Alura\Banco\Modelo\Conta\Titular;
use Alura\Banco\Modelo\Endereco;
use Alura\Banco\Modelo\CPF;
use Alura\Banco\Modelo\Conta\Conta;

```

Pensando nesse problema, o PHP traz uma funcionalidade muito interessante chamada **autoload**. Com ela, se tentamos utilizar uma classe que o PHP ainda não conhece, ele utilizará o _autoload_. Para testarmos, removeremos os <code>require</code> do nosso código.

```php

<?php

use Alura\Banco\Modelo\Conta\Titular;
use Alura\Banco\Modelo\Endereco;
use Alura\Banco\Modelo\CPF;
use Alura\Banco\Modelo\Conta\Conta;

$endereco = new Endereco('Petrópolis', 'um bairro', 'minha rua', '71B');
$vinicius = new Titular(new CPF('123.456.789-10'), 'Vinicius Dias', $endereco);

```

Se executarmos, como é esperado, teremos um erro informando que a classe <code>Endereco</code>. Agora queremos registrar uma função que faz o _autoload_ das classes, o que faremos, ainda nesse arquivo, com a <code>spl_autpload_register()</code>. Ela recebe por parâmetro uma outra função que, por sua vez, recebe uma string cujo valor é o nome completo da classe.

```php

<?php

spl_autoload_register(function (string $nomeCompletoDaClasse){

});

use Alura\Banco\Modelo\Conta\Titular;
use Alura\Banco\Modelo\Endereco;
use Alura\Banco\Modelo\CPF;
use Alura\Banco\Modelo\Conta\Conta;

```

Quando tentarmos instanciar uma classe chamada <code>Endereco</code>, por exemplo, o PHP perceberá que não conhece a classe e, como temos o _autoloader_, executará essa função para tentar encontrá-la. De modo a entendermos exatamente como isso ocorre, faremos um <code>echo</code> do <code>$nomeCompletoDaClasse</code>.

```php

<?php

spl_autoload_register(function (string $nomeCompletoDaClasse){
    echo $nomeCompletoDaClasse;
    exit();
});

```

Executando, receberemos como retorno:

<code>Alura\Banco\Modelo\Endereco</code>

Queremos transformar a string <code>Alura\Banco\Modelo\Endereco</code> em <code>src/Modelo/Endereco.php</code>, afinal, "Alura\Banco" é o _namespace_ raiz que representa a pasta "src", o próximo _namespace_ "Modelo" é a pasta, e em seguida temos o nome do arquivo ao qual queremos adicionar o <code>.php</code>. Ou seja, conseguiremos encontrar o caminho da classe a partir do seu nome completo.

A ideia é que o caminho do arquivo (<code>$caminhoArquivo</code>) seja o <code>$nomeCompletoDaClasse</code> trocando a string <code>Alura\Banco</code> por <code>src</code>. Isso pode ser feito com o auxílio da função <code>str_replace()</code>.

```php

spl_autoload_register(function (string $nomeCompletoDaClasse){
    $caminhoArquivo = str_replace('Alura\\Banco', 'src', $nomeCompletoDaClasse);
});

```

Note que adicionamos duas barras invertidas (<code>\\</code>) à string que será substituída, algo que discutimos no treinamento inicial do PHP: uma barra sozinha pode ser interpretada como um escape, transformando o caractere seguinte em um que tenha significado especial. Para garantirmos que isso não aconteça, usaremos <code>\\</code>, que na prática será lido pelo PHP como <code>\</code>.

O próximo passo será transformarmos a barra invertida <code>\</code>, que é o padrão de diretórios do Windows, em barra comum <code>/</code>. Faremos isso adicionando uma nova chamada de <code>str_replace()</code> que operará essa substituição sobre a string <code>$caminhoArquivo</code>.

Porém, como saberemos se devemos utilizar o padrão do Linux,q ue é <code>/</code>, ou o do Windows que tínhamos originalmente? O próprio PHP nos fornece uma constante chamada <code>DIRECTORY_SEPARATOR</code> cujo valor se altera dependendo do sistema operacional. Ou seja, se estamos no Windows, a barra invertida será mantida; no Linux e no Mac, será trocada pelo separador correto, que é <code>/</code>.

```php

spl_autoload_register(function (string $nomeCompletoDaClasse){
    $caminhoArquivo = str_replace('Alura\\Banco', 'src', $nomeCompletoDaClasse);
    $caminhoArquivo = str_replace('\\', DIRECTORY_SEPARATOR, $caminhoArquivo);
});

```

Para adicionarmos o <code>.php</code> ao final do arquivo, usaremos o operador <code>.=</code> do PHP:

```php

spl_autoload_register(function (string $nomeCompletoDaClasse){
    $caminhoArquivo = str_replace('Alura\\Banco', 'src', $nomeCompletoDaClasse);
    $caminhoArquivo = str_replace('\\', DIRECTORY_SEPARATOR, $caminhoArquivo);
    $caminhoArquivo .= '.php';
});

```

Garantiremos que tudo está ocorrendo como esperado fazendo um <code>echo</code> do nosso <code>$caminhoArquivo</code> ao final da operação.

```php

spl_autoload_register(function (string $nomeCompletoDaClasse){
    $caminhoArquivo = str_replace('Alura\\Banco', 'src', $nomeCompletoDaClasse);
    $caminhoArquivo = str_replace('\\', DIRECTORY_SEPARATOR, $caminhoArquivo);
    $caminhoArquivo .= '.php';
    echo $caminhoArquivo;
    exit();
});

```

Como retorno, teremos:

<code>src\Modelo\Endereco.php</code>

Já temos o caminho do nosso arquivo, e queremos garantir que isso funcionará independentemente da classe que seja carregada. Para isso, incluiremos um operador <code>if</code> que, com <code>file_exits()</code>, verificará se <code>$caminhoArquivo</code> existe. Em caso positivo, faremos o <code>require</code> de <code>$caminhoArquivo</code>.

```php

spl_autoload_register(function (string $nomeCompletoDaClasse){
    $caminhoArquivo = str_replace('Alura\\Banco', 'src', $nomeCompletoDaClasse);
    $caminhoArquivo = str_replace('\\', DIRECTORY_SEPARATOR, $caminhoArquivo);
    $caminhoArquivo .= '.php';

    if(file_exists($caminhoArquivo)) {
        require_once $caminhoArquivo;
    }
});

```

Vamos recapitular? Trabalhamos sobre o nome completo da classe de modo a gerarmos o caminho do arquivo referente a ela - no caso, trocamos <code>Alura\Banco</code> por <code>src</code> e adicionamos o <code>.php</code> ao final. De posse do caminho do arquivo, fizemos o <code>require</code> para importá-lo efetivamente. Ao executarmos o programa, tudo rodará normalmente. Assim, com uma única função conseguimos fazer o <code>require</code> de todos os arquivos necessários e na ordem correta.

Esse padrão de construção do _autoloader_ é bastante conhecido na comunidade PHP, e vem das **PSRs** (_PHP Standard Recommendations_), mais especificamente da **PSR-4**, que recomenda uma forma de fazer autoload. Isso é explicado em mais detalhes no curso de **Composer** aqui da Alura, no qual aprendemos a gerar _autoloaders_ mais completos.

Na prática, o __autoload_ é um processo que busca as classes automaticamente, sem que seja necessário informar cada arquivo separadamente. Esse processo precisa seguir algumas regras para atender ao padrão da **PSR-4**, como não poder gerar erros e ter que utilizar uma pasta raiz e um namespace raiz para fazer o mapeamento, entre outras.

Vale a pena pesquisar e ler sobre o __autoloader_ e essas regras, ainda que já tenhamos implementado de forma simplória a **PSR-4**, resolvendo o nosso problema. Para organizarmos um pouco melhor nosso projeto, criaremos no diretório raiz um arquivo <code>autoload.php</code> que armazenará todo o código que acabamos de construir.

```php

<?php

spl_autoload_register(function (string $nomeCompletoDaClasse){
    $caminhoArquivo = str_replace('Alura\\Banco', 'src', $nomeCompletoDaClasse);
    $caminhoArquivo = str_replace('\\', DIRECTORY_SEPARATOR, $caminhoArquivo);
    $caminhoArquivo .= '.php';

    if(file_exists($caminhoArquivo)) {
        require_once $caminhoArquivo;
    }
});

```

No <code>banco.php</code>, passaremos a fazer o <code>require</code> desse novo arquivo.

```php

<?php

require_once 'autoload.php';

use Alura\Banco\Modelo\Conta\Titular;
use Alura\Banco\Modelo\Endereco;
use Alura\Banco\Modelo\CPF;
use Alura\Banco\Modelo\Conta\Conta;

```

Feito isso, nosso sistema continuará funcionando corretamente. Agora entendemos o que é um __autoloader_, aprendemos a implementá-lo seguindo a **PSR-4** e vimos como ele funciona na prática. Como essa aula teve bastante conteúdo, não deixe conferir os exercícios e ler mais sobre a **PSR-4**, um conceito muito importante no desenvolvimento em PHP (ainda que existam ferramentas que fazem a sua implementação automaticamente).

Para saber mais sobre a (**PSR-4**)[https://www.php-fig.org/psr/psr-4/]