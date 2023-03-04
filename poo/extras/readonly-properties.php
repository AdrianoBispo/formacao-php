<?php
// Novidades do PHP 8 - Readonly Properties

class User
{
    
    public readonly string $username;
    public readonly string $password;

    public function setUser(string $username)
    {
        $this->username = $username;
    }
}

$username = new User();
$username->setUser('Adriano');
echo $username->username;

/*
    Através de readonly properties nós podemos ter propriedades que são escritas apenas uma vez 
    (no construtor, por exemplo) e depois são acessíveis apenas para leitura.
    Desta forma não vamos mais precisar criar "getters" em vários casos.
*/