Com as alterações que fizemos no vídeo anterior, o PHP não consegue mais encontrar as classes do nosso projeto, fazendo com que nosso sistema deixasse de funcionar. Ao executarmos, recebemos erros informando, por exemplo, que a classe <code>Pessoa</code> não foi criada no momento da criação da classe <code>Titular</code>. Portanto, faremos o <code>require</code> dessa classe.

```php

<?php

require_once 'src/Modelo/Conta/Conta.php';
require_once 'src/Modelo/Endereco.php';
require_once 'src/Modelo/Pessoa.php';
require_once 'src/Modelo/Conta/Titular.php';
require_once 'src/Modelo/CPF.php';

```

É trabalhoso e pouco prático termos que fazer o <code>require</code> de cada classe que utilizaremos, ainda mais que a IDE não parece nos ajudar nesse processo. Manteremos isso em mente para resolvermos no futuro. Se executarmos novamente, continuaremos recebendo o erro de que a classe <code>Pessoa</code> não está sendo encontrada.

Isso acontece pois a classe <code>Titular</code> está tentando encontrar uma classe <code>Pessoa</code> no namespace "Alura\Banco\Modelo\Conta", mas esta última está localizada em outro namespace. Sendo assim, precisaremos informar o namespace correto, algo que pode ser feito de duas maneiras.

A primeira delas é passarmos o endereço completo da classe, como no exemplo abaixo:

```php

<?php

namespace Alura\Banco\Modelo\Conta;

class Titular extends Alura\Banco\Modelo\Pessoa
{
    private $endereco;
    //...
}

```

Ou seja, a classe <code>Titular</code> passará a estender de <code>Alura\Banco\Modelo\Pessoa</code>, o que provavelmente fará com que a classe seja encontrada corretamente. Entretanto, usar um nome tão grande para definir a classe tornará o nosso código menos legível. Uma alternativa é, antes da definição de <code>Titular</code>, utilizarmos a instrução <code>use</code> seguida do mesmo endereço.

```php
<?php

namespace Alura\Banco\Modelo\Conta;

use Alura\Banco\Modelo\Pessoa;

class Titular extends Pessoa
{
    private $endereco;
    //...
}

```

Com isso, estamos informando ao PHP que queremos utilizar a classe <code>Pessoa</code> no namespace informado. Em seguida, repetiremos o processo para todas as classes utilizadas em <code>Titular</code> - ou seja, <code>CPF</code> e <code>Endereco</code>.

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

Com isso, a classe <code>Titular</code> deixará de apresentar erros, mas o nosso <code>banco.php</code> não. Ou seja, teremos que fazer o mesmo processo nesse arquivo, ou utilizando o nome completo da classe ou adicionando a instrução <code>use</code> antes das nossas operações. Faremos do segundo modo. Quando escrevemos o <code>use</code> seguido do nome de uma classe, por exemplo <code>CPF</code>, o PhpStorm nos ajuda mostrando opções de autocompletar com o seu namespace completo.

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

$endereco = new Endereco('Petrópolis', 'um bairro', 'minha rua', '71B');
$vinicius = new Titular(new CPF('123.456.789-10'), 'Vinicius Dias', $endereco);
$primeiraConta = new Conta($vinicius);
$primeiraConta->deposita(500);
$primeiraConta->saca(300); // isso é ok

```

Ao executarmos novamente o código, tudo funcionará corretamente. Repare que a IDE não nos auxilia tanto na importação de arquivos, mas consegue nos ajudar a informar os namespaces. Inclusive, se escrevermos <code>new Pessoa</code> e pressionarmos "Enter", a própria IDE preencherá o namespace completo.

Portanto, a utilização de namespaces é uma vantagem para a organização do nosso código, e qualquer boa IDE para desenvolvimento em PHP se encarregará do trabalho de importá-los. Porém, note que aparentemente estamos importando as classes duas vezes, usando <code>require</code> e <code>use</code>. Além disso, ao fazermos o <code>require</code>, tivemos que lembrar da ordem de execução para inserir os arquivos corretamente, algo que não é tão prático assim.

No próximo vídeo aprenderemos uma nova funcionalidade do PHP que nos livrará desses problemas.
