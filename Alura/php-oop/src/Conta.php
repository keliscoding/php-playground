<?php

class Conta
{
    private $cpfTitular;
    private $nomeTitular;
    private $saldo = 0.0;

    public function __construct($cpfTitular, $nomeTitular)
    {
        $this->cpfTitular = $cpfTitular;
        $this->nomeTitular = $nomeTitular;
    }

    public function sacar($valorASacar)
    {
        if($valorASacar < 0 || $valorASacar > $this->saldo || $this->saldo - $valorASacar < 0) {
            return false;
        } else {
            $this->saldo -= $valorASacar;
            return true;
        }
    }

    public function depositar($valorADepositar)
    {
        if($valorADepositar < 0 ) {
            return false;
        } else {
            $this->saldo += $valorADepositar;
            return true;
        }
    }

    public function transferencia(Conta $conta, $valorATransferir)
    {
        if($valorATransferir >= 0) {
            if ($this->sacar($valorATransferir)) {
                $conta->depositar($valorATransferir);
                return true;
            }
        }
        return false;
    }
}