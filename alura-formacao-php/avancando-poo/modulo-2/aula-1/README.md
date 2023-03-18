# Módulo 2 - Aula 1

## Namespace e Autoload - Separação Física e Lógica

Até o momento temos relativamente pouca coisa no nosso projeto, que é consistido basicamente de classes que fazem sentido no nosso modelo, como <code>Conta</code>, <code>Funcionario</code>, <code>Pessoa</code>, <code>Titular</code> e assim por diante. No futuro, poderemos ter também classes que realizam ações, ao invés de representarem um modelo de domínio - por exemplo, uma classe que encerra uma conta. A ideia é sermos capazes de separar classes de modelo das classes de serviço, que são as responsáveis por executar ações e funcionalidades. Portanto, começaremos a organizar o projeto com isso em mente.

Começaremos criando em "src" uma pasta "Modelo", na qual armazenaremos todas as classes criadas até agora, já que elas representam o modelo do nosso banco. Podemos organizar ainda melhor esses arquivos. Por exemplo, sabemos que <code>Titular</code> e <code>Conta</code> são entidades muito relacionadas. Sendo assim, dentro de "Modelo", criaremos uma pasta "Conta" para a qual moveremos ambos esses arquivos.

Claro, existem diversas formas de montar a estrutura de pastas do seu projeto, e muitos estudos de arquitetura visando montar essa estrutura da melhor forma, mas esses são detalhes que não abordaremos agora.

Fizemos então a separação física dos arquivos em pastas do nosso próprio sistema operacional. Mas e se quisermos utilizar alguma classe externa, por exemplo baixada da internet, para ajudar em alguma funcionalidade do banco? As chances de termos uma classe com nome idêntico aos do nosso projeto, como <code>Conta</code> e <code>CPF</code>, são bem grandes, e o PHP não saberá qual classe usar.

Podemos ter dois arquivos com o mesmo nome no sistema operacional, desde que eles estejam em pastas diferentes. O PHP fornece essa separação por meio de namespaces. Se temos uma pasta chamada "modelo", os arquivos contidos nela também estarão em um namespace chamado "Modelo". Começaremos essa definição por <code>Pessoa.php</code>.

```php

<?php

namespace Modelo;

class Pessoa
{
    protected $nome;
    private $cpf;

    //... Códigos Oculto
}

```

Não é obrigatório que o nome do *namespace* seja o mesmo da pasta, mas isso ajuda na organização, mesmo se mudarmos de IDE ou se passarmos o projeto para outra pessoa. Repetiremos esse processo para as outras classes (<code>CPF</code>, <code>Endereco</code> e <code>Funcionario</code>), e as organizaremos em ordem alfabética.

Já as classes <code>Conta</code> e <code>Titular</code> estarão no *namespace* **"Modelo\Conta"**. A contrabarra **"\"** é utilizada para separar *namespaces* no PHP, independentemente do sistema operacional.

Agora temos os arquivos separados em pastas e as classes separadas em *namespaces*, que são como "pacotes". Portanto, podemos ter várias classes dentro de um pacote: no pacote "Modelo\Conta" temos as classes <code>Conta</code> e <code>Titular</code>, e no pacote "Modelo" temos <code>CPF</code>, <code>Endereco</code>, <code>Funcionario</code> e <code>Pessoa</code>.

No futuro entenderemos melhor a utilidade dessa separação, mas, por enquanto, é o suficiente termos organizado melhor o nosso projeto. No próximo vídeo falaremos mais sobre situações onde temos projetos separados, mas com arquivos de nomes repetidos.