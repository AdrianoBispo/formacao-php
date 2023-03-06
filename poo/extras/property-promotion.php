<?php
// Novidades do PHP 8 - Property Promotion


// Sem Property Promotion
class MinhaClasse
{
    private $propriedade1;
    private $propriedade2;
    
    public function __construct($propriedade1, $propriedade2)
    {
      $this->propriedade1 = $propriedade1;
      $this->propriedade2 = $propriedade2;
    }

}

// Com Property Promotion
class MinhaClasse
{
    public function __construct(
        private $propriedade1,
        private $propriedade2
        ) { }
}
  
/*
    Com a Property Promotion, é possível declarar e inicializar propriedades diretamente na assinatura do construtor,
    ao invés de ter que declará-las em uma linha separada e depois inicializá-las no construtor.
*/