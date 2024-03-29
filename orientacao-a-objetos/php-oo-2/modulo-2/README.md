# Módulo 2: Namespace e Autoload

## Resumo sobre o que foi aprendido no Módulo 2:

- Entendemos que é possível separar nossas classes em namespaces, assim como separamos arquivos em pastas;

- Vimos que separando as classes em namespaces podemos ter classes com o mesmo nome em namespaces diferentes;

- Utilizando um namespace raiz (chamado de _vendor namespace_ em algumas literaturas) podemos evitar conflitos com classes de pacotes externos que venhamos a utilizar;

- Para utilizar uma classe precisamos importá-la utilizando <code>use</code> ou informar seu nome completo (com namespace) em todos os locais onde ela for utilizada;

- Através de um autoloader com o PHP (<code>spl_autoload_register</code>) podemos evitar ficar utilizando <code>require</code> para incluir todos os arquivos necessários para executar o programa;

## Para saber mais: Namespaces

É muito útil e uma boa prática fazermos uso de **_namespaces_** para separar as nossas classes em nossa aplicação. Para fazer bom uso deste recurso, devemos entender alguns detalhes.

Quando definimos uma classe sem informar o seu _namespace_, ela é criada no _namespace_ padrão do PHP. Este _namespace_ tem um "nome vazio", ou seja, uma classe <code>Conta</code> sem _namespace_ tem como seu "nome completo" <code>\Conta</code>.

Se em uma classe com _namespace_ definido precisarmos acessar classes de outro _namespace_, precisamos adicionar o use ou informar o seu nome completo (_namespace_ + nome da classe).

Estando na classe <code>Alura\Banco\Modelo\Conta\Conta</code>, por exemplo, e querendo acessar a classe <code>Alura\Banco\CPF</code>, precisamos informar o nome completo da classe, ou utilizar use Alura\Banco\CPF no início do arquivo, o que permite que no restante do arquivo utilizemos apenas <code>CPF</code> como nome.

Outro detalhe interessante é que, se precisamos "importar" (com <code>use</code>) mais de uma classe do mesmo _namespace_, podemos fazer na mesma linha, envolvendo os nomes das classes em chaves. Por exemplo:

```php

<?php

namespace Alura\Banco\Conta;

use Alura\Banco\{CPF, Endereco};
use \SplFileInfo;

class Conta
{
    public function umMetodoQualquer()
    {
        // ...
        $cpf = new CPF();
        // ...
        $cpf = new Endereco();
        // ...
        $fileInfo = new SplFileInfo();
        // ...
        $fileObject = new \SplFileObject();
        // ...
    }
}

```

Pra ler tudo isso com mais detalhes, (lei a documentação)[https://www.php.net/manual/en/language.namespaces.php]


