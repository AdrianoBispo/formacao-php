<?php 

/*
    Orientação a Objetos: DEFINIÇÃO

    O nome Orientação a Objetos vem do fato de que, a partir de uma "class",
    podemos criar objetos que servirão de base para montarmos todo o sistema.
    Sendo assim, o desenvolvimento deixa de ser orientado a funções,
    como na programação procedural, e se torna orientado a objetos.
*/


/*
    Orientação a Objetos: ABSTRAÇÃO

    Um dos pilares da Orientação a Objetos é o conceito de abstração.
    Esse conceito consiste em pegar um conceito real, como uma conta-corrente, 
    e abstrair para o sistema somente o que é necessário para trabalharmos.
*/

class Conta
{
    public $cpfTitular;
    public $nomeTitular;
    public $saldo;
}

// OBS: A partir da versão 7.4 do PHP, podemos definir essa "class" assim:
/*
    class ContaExemplo
    {
        public string $cpfTitular;
        public string $nomeTitular;
        public float $saldo;
    }
*/

/*
    Por que usar a palavra-chave "public"?

    No PHP, precisamos informar, quando alguém criar um objeto do tipo "Conta", se esses dados serão públicos ou privados.
    No momento queremos que eles sejam públicos, portanto usaremos a palavra-chave "public".
    Dessa forma, quem tiver uma instância de "Conta" poderá acessar qualquer uma dessas informações.
*/

