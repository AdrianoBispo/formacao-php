## Namespace e Autoload - Namespace Raiz

Se estivermos utilizando um projeto baixado da internet para nos auxiliar na criação do sistema do banco, ou mesmo se estamos utilizando um projeto feito por outra equipe para nos auxiliar com outro módulo da aplicação, existe a possibilidade de criarmos uma classe com mesmo nome, afinal <code>Conta</code> e <code>CPF</code> são títulos bastante genéricos.

Nesse cenário, se alguém precisar criar um arquivo com o mesmo nome, poderá fazer isso em outra pasta. Da mesma forma, podemos criar ou incluir uma nova classe em outro *namespace*. Porém, também não deve ser incomum ter uma classe <code>CPF</code> em um *namespace* chamado "Modelo". Pensando nisso, é interessante organizarmos os nossos *namespaces* de outra forma.

Uma forma bastante conhecida, e que nos trará uma grande vantagem no futuro, é termos um *namespace* raiz da nossa aplicação, e que será válido para todas as classes do projeto. A partir desse *namespace* raiz, todas as pastas do nosso sistema serão também *namespaces* próprios.

Por exemplo, o *namespace* raiz da nossa aplicação será **"Alura\Banco"**. Sendo assim, a classe <code>CPF</code> fará parte do *namespace* **"Alura\Banco\Modelo"**.

```php

<?php

namespace Alura\Banco\Modelo;

class CPF
{
    private $numero;
    
    //...
}

```

Já a classe <code>Conta</code> estará no *namespace* **"Alura\Banco\Modelo\Conta"**.

``` php

<?php

namespace Alura\Banco\Modelo\Conta;

class Conta
{
    private $titular;
    private $saldo;
    private static $numeroDeContas = 0;
    
    //...
}

```

<code>Lembre-se que é uma ótima prática que o nome da classe seja o mesmo nome do arquivo!</code>

Com isso, já incluímos diversas convenções da programação em PHP e da orientação a objetos em nosso projeto. Repetiremos esse processo para as demais classes, corirgindo o seu *namespace*.

Mesmo se baixarmos outro projeto da internet ou feito por outra equipe pra utilizarmos, as chances dos seus arquivos estarem no mesmo *namespace* são muito pequenas.

Porém, agora temos um problema. O PhpStorm passará a indicar diversos erros no arquivo <code>banco.php</code>, pois não está mais encontrando os caminhos informados para os arquivos. Corrigiremos isso passando o caminho correto.

``` php

<?php

require_once 'src/Modelo/Conta/Conta.php';
require_once 'src/Modelo/Conta/Titular.php';
require_once 'src/Modelo/Endereco.php';
require_once 'src/Modelo/CPF.php';


$endereco = new Endereco('Petrópolis', 'um bairro', 'minha rua', '71B');
$vinicius = new Titular(new CPF('123.456.789-10'), 'Vinicius Dias', $endereco);
$primeiraConta = new Conta($vinicius);
$primeiraConta->deposita(500);
$primeiraConta->saca(300); // isso é ok

//...

```

Entretanto, mesmo após as alterações, o PHP continuará não encontrando as classes, informando que elas não estão definidas. No próximo vídeo entenderemos como utilizar as classes agora que elas estão armazenadas em *namespaces*.