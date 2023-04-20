<h1 align="center">
  <img align="center" width="100px" height="80px" src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-plain.svg" />
  PHP Strings: Manipulando Textos com PHP
  <hr>
</h1>

| **ARQUIVO**         | **FUNÇÃO**                                      |  **DESCRIÇÃO**               |
| ------------------- | ----------------------------------------------- | ---------------------------- |
| [``aula-1.php``](https://github.com/AdrianoBispo/formacao-php/blob/master/arrays-e-strings/php-strings/aula-1.php)  | ``str_contains()``                              | _Foi adicionada na versão 8.0 e **serve para verificar se uma determinada string contém outra string e retorna um valor booleano.**_ |
| [``aula-2.php``](https://github.com/AdrianoBispo/formacao-php/blob/master/arrays-e-strings/php-strings/aula-2.php)  | ``str_starts_with()`` e ``str_ends_with()``     | _**São utilizadas para verificar se uma string começa ou termina com um determinado conjunto de caracteres e retorna um valor booleano.**_ |
| [``aula-3.php``](https://github.com/AdrianoBispo/formacao-php/blob/master/arrays-e-strings/php-strings/aula-3.php) | ``substr()``                                    | _É uma função que **permite extrair um trecho de caracteres específico de uma string.**_                       |
| [``aula-4.php``](https://github.com/AdrianoBispo/formacao-php/blob/master/arrays-e-strings/php-strings/aula-4.php)  | ``strpos()``                                    | _É uma função  que **permite encontrar a posição da primeira ocorrência de uma substring em uma string.** É importante observar que **essa função é sensível a maiúsculas e minúsculas**, ou seja, ela irá diferenciar letras maiúsculas e minúsculas na string e na substring. Se você quiser fazer uma busca insensível a maiúsculas e minúsculas, pode usar a função ``stripos()`` em vez disso._ |
| [``aula-5.php``](https://github.com/AdrianoBispo/formacao-php/blob/master/arrays-e-strings/php-strings/aula-5.php)  | ``strlen()``                                    | _É uma função que **permite obter o número de bytes que contém em uma string.**  Isso significa que caracteres multibyte podem ser contados como mais de um caractere. Para lidar com esse problema é recomendado utilizar a função ``mb_strlen()``, que é capaz de contar corretamente caracteres multibyte._ |
| [``aula-6.php``](https://github.com/AdrianoBispo/formacao-php/blob/master/arrays-e-strings/php-strings/aula-6.php)  | ``strtoupper()`` e ``strtolower()``              | _São funções que **permitem converter uma string em letras maiúsculas ou minúsculas.** É importante lembrar que essas funções podem ou não funcionar corretamente com caracteres de idiomas que não usam o alfabeto latino ou têm regras diferentes de capitalização. Para lidar com esse problema é recomendado utilizar as funções ``mb_strtoupper()`` e ``mb_strtolower()``._ |
| [``aula-7.php``](https://github.com/AdrianoBispo/formacao-php/blob/master/arrays-e-strings/php-strings/aula-7.php)  | ``explode()``                                   | _É uma função que **permite dividir uma string em um array de substrings com base em um separador específico**, retornando uma array de substrings da string original. É importante observar que **essa função é sensível a maiúsculas e minúsculas**, ou seja, o separador especificado deve corresponder exatamente ao texto na string original. Se o separador não for encontrado na string original, a função retornará false. Para lidar com esse problema, o PHP possui outras funções de manipulação de strings, como ``strtok()`` ou ``preg_split()``, que são capazes de dividir uma string com base em um padrão mais flexível._ |
| [``aula-8.php``](https://github.com/AdrianoBispo/formacao-php/blob/master/arrays-e-strings/php-strings/aula-8.php)  | ``implode()``                                   | _É uma função que **permite combinar os elementos de um array em uma única string**, separando cada elemento por um caractere especificado. É importante observar que **a função ``implode()`` é o oposto da função ``explode()``**. A função ``implode()`` combina os elementos de um array em uma única string, enquanto a função ``explode()`` divide uma string em um array de substrings._ |
| [``aula-9.php``](https://github.com/AdrianoBispo/formacao-php/blob/master/arrays-e-strings/php-strings/aula-9.php) | ``trim()``                                      | _É uma função que **permite remover espaços em branco (ou outros caracteres especificados) do início e do final de uma string.** É importante observar que essa função **não altera a string original, mas retorna uma nova string modificada.** Se você quiser alterar a string original, deve atribuir o resultado da função trim() à variável que contém a string original._ |
| [``aula-10.php``](https://github.com/AdrianoBispo/formacao-php/blob/master/arrays-e-strings/php-strings/aula-10.php) | ``Strings Númericas``                          | _São uma forma de representar números como sequências de caracteres. Embora essas strings possam ser manipuladas usando as funções de manipulação de strings do PHP, as operações matemáticas requerem a conversão das strings em valores numéricos usando as funções de conversão de tipo._ |
| [``aula-11.php``](https://github.com/AdrianoBispo/formacao-php/blob/master/arrays-e-strings/php-strings/aula-11.php) | ``Herodoc`` e ``Nowdoc``                        | _**São utilizados para definir strings multilinhas sem a necessidade de escapar caracteres de citação.** Ambos são úteis para definir strings multilinha com uma sintaxe mais clara e legível. **O Heredoc é especialmente útil quando você precisa interpolar variáveis dentro da string multilinha**, enquanto o Nowdoc é útil quando você deseja definir uma string literal sem interpolação de variáveis._ |
| [``aula-12.php``](https://github.com/AdrianoBispo/formacao-php/blob/master/arrays-e-strings/php-strings/aula-12.php) | ``htmlspecialchars()``                          | _Essa função **é utilizada para converter caracteres especiais em entidades HTML.** Isso é útil quando você precisa exibir conteúdo em uma página da web que pode conter caracteres especiais que seriam interpretados pelo navegador como tags HTML ou atributos._ |
| [``aula-13.php``](https://github.com/AdrianoBispo/formacao-php/blob/master/arrays-e-strings/php-strings/aula-13.php) | ``str_replace()`` e ``strtr()``                | _**A função ``str_replace()`` é usada para substituir todas as ocorrências de uma string por outra em uma string dada.** A função aceita três parâmetros: a string a ser substituída, a string que substituirá a string original e a string na qual a substituição será feita. **Já a função ``strtr()`` é usada para substituir caracteres em uma string, mas com uma sintaxe um pouco diferente.** Ela aceita dois parâmetros: a string na qual a substituição será feita e uma matriz que mapeia os caracteres que serão substituídos e seus respectivos substitutos. **A principal diferença entre as duas funções é que str_replace() é mais flexível e pode substituir qualquer string por outra, enquanto strtr() é mais limitada e só pode substituir caracteres específicos que são especificados em uma matriz de mapeamento.**_ |
| [``aula-14.php``](https://github.com/AdrianoBispo/formacao-php/blob/master/arrays-e-strings/php-strings/aula-14.php) | _Regex parte 1_ ``preg_match()``                      | _Essa função **é utilizada para realizar correspondência de padrões com expressões regulares.** Ela aceita três parâmetros: o padrão a ser encontrado, a string na qual a correspondência será procurada e, opcionalmente, um array onde serão armazenadas as correspondências encontradas. Essa função é muito útil quando precisamos realizar operações de validação em campos de formulário ou em dados de entrada de usuário em geral. Ela permite que utilizemos expressões regulares para definir padrões específicos que precisam ser encontrados ou não em uma determinada string._ |
| [``aula-15.php``](https://github.com/AdrianoBispo/formacao-php/blob/master/arrays-e-strings/php-strings/aula-15.php) | _Regex parte 2_ ``preg_replace()``            | _A função preg_replace() **é utilizada para substituir todas as ocorrências de um padrão encontrado por uma expressão regular em uma string por outra string.** Ela aceita três parâmetros: o padrão a ser encontrado, a string que contém o padrão a ser substituído e a string que será usada para substituir o padrão. Essa função é muito útil quando precisamos substituir padrões complexos em strings, especialmente quando precisamos fazer uso de expressões regulares._ |


## 💡 Através desse curso pude aprender:

- Como utilizar várias funções de strings com o PHP 8;

- As principais mudanças que chegaram nas versões mais recente, pelo menos no momento em que o curso foi lançado. O que inclue funções novas, mudanças de comportamento, etc.

- Como pegar pedaços de um texto. Por exemplo, a como pegar somente um pedaço do início de uma string, ou só um pedaço do final. E a partir 

- Como pegar a posição de uma string dentro de outra ou a posição de caractere dentro dessa string.

- Como colocar strings em letra maiúscula, em letra minúscula, etc. 

- Como separar uma string em array e como juntar um array em uma string.

- Como aparar as bordas da nossa string removendo espaços ou algum caractere que quisermos.

- Alguns detalhes de sintaxe, strings numéricas e como o PHP trabalha com isso, aquelas famigeradas, sintaxes de heredoc, nowdoc.

- O que são essas sintaxes de Heredoc e Nowdoc e quando utilizar;

- Como fazer substituições em strings, mudar um caractere para outro, mudar uma palavra para outra, vamos entrar no assunto de **expressões regulares**.


## 👨🏾‍🏫 Conteúdos Extras:

- [Artigo: Extensões PHP](https://dias.dev/2022-02-13-extensoes-php/)

- [Vídeo: Trabalhando com Multibyte String em PHP](https://cursos.alura.com.br/extra/alura-mais/trabalhando-com-multibyte-string-em-php-c64)

- [Vídeo: Novidades do PHP 8 - Named Arguments](https://youtu.be/epla4NyobjU)

- [Vídeo: Evitando Cross-site Scripting (XSS)](https://youtu.be/lntsVxPZibw)

- [Curso: Expressões Regulares](https://cursos.alura.com.br/course/expressoes-regulares)


## ✍🏽 Licença

> Esse material é referente ao curso <a href="https://www.alura.com.br/curso-online-php-strings-manipulando-textos-php">PHP Strings: Manipulando Textos com PHP</a>
