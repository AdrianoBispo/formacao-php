<?php

class Conta
{
    // definir dados da conta
}

/*
    O escopo da "class", marcado pelas chaves, é onde poderemos definir os dados da conta.
    A partir de agora temos um novo tipo de dados na nossa aplicação, à semelhança dos tipos já conhecidos.
    Ou seja, poderemos criar variáveis com valores não mais genéricos, mas sim, atribuindo valores a nossa "class" "Conta".
    Desse modo, definiremos o conteúdo da nossa "class" "Conta".
*/

// Para criarmos uma variável do tipo "Conta", usaremos a instrução "new" seguida do tipo desejado e um escopo de parênteses.
$umaNovaConta = new Conta();

/* 
    Assim, teremos na variável $umaNovaConta um "endereço" para encontrarmos a "Conta" que foi criada.
    Ou seja, não temos nessa variável o valor de tudo que essa "Conta" tem,
    mas o endereço onde essas informações estão salvas e por onde conseguiremos acessá-las.
*/

/*
    Por que usar Letra Maiúscula?

    Em PHP, é um padrão, e uma boa prática, criar as "class" utilizando a primeira letra em maiúsculo. 
    Se tivéssemos várias palavras, por exemplo "conta-corrente", as palavras subsequentes também se iniciariam com letra maiúscula.
*/

// Exemplo
class ContaCorrente
{

}
