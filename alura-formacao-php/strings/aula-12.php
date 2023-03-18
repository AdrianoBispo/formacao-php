<?php

function aspaDupla():void
{
    $nome = 'Júlia';
    $contratarVoce = 'contratar você!';
    $assinatura = 'Dr. Lucas';

    $conteudoEmail = 
    
    "Olá, $nome!
    
    Estamos entrando em contato para
    $contratarVoce
    
    $assinatura";

    echo $conteudoEmail;
}

aspaDupla(); // Retorna o texto identado e indentifica as variáveis

function aspaSimples():void
{
    $nome = 'Júlia';
    $contratarVoce = 'contratar você!';
    $assinatura = 'Dr. Lucas';

    $conteudoEmail = 
    
    'Olá, $nome!
    
    Estamos entrando em contato para
    $contratarVoce
    
    $assinatura';

    echo $conteudoEmail;
}

aspaSimples(); // Retorna o texto identado e não indentifica as variáveis


// O heredoc é equivalente as aspas duplas
function herodoc():void
{

    $nome = 'Vinícius';
    $contratarVoce = 'contratar você!';
    $assinatura = 'Dr. João';

    $conteudo = 
    <<<FIM

    Olá, $nome!
    
    Estamos entrando em contato para
    $contratarVoce
    
    $assinatura
    
    FIM;

    echo $conteudo;
}

herodoc(); // Retorna o texto sem identação e indentifica as variáveis


// O nowdoc é equivalente a aspa simples
function nowdoc():void
{

    $nome = 'Vinícius';
    $contratarVoce = 'contratar você!';
    $assinatura = 'Dr. Lucas';

    $conteudo = 
    <<<'FIM'

    Olá, $nome!
    
    Estamos entrando em contato para
    $contratarVoce
    
    $assinatura
    
    FIM;

    echo $conteudo;
}

nowdoc(); // Retorna o texto sem identação e não indentifica as variáveis