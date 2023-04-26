<?php

class Conta
{
    private $cpfTitular;
    private $nomeTitular;
    private $saldo;

    public function __construct($cpfTitular, $nomeTitular, $saldo)
    {
        $this->cpfTitular = $cpfTitular;
        $this->nomeTitular = $nomeTitular;
        $this->saldo = $saldo;
    }

    public function sacar($valorASacar) {
        if($valorASacar < 0 || $valorASacar > $this->saldo || $this->saldo - $valorASacar < 0) {
            echo 'saldo indisponível';
        } else {
            $this->saldo -= $valorASacar;
        }
    }
}