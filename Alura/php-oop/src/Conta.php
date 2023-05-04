<?php

class Conta
{
    private $cpfTitular;
    private $nomeTitular;
    private $saldo = 0.0;

    /**
     * @param string $cpfTitular
     * @param string $nomeTitular
     */
    public function __construct($cpfTitular, $nomeTitular)
    {
        $this->cpfTitular = $cpfTitular;
        $this->nomeTitular = $nomeTitular;
    }

    /**
     * @param string $cpfTitular
     */
    public function setCpfTitular($cpfTitular)
    {
        $this->cpfTitular = $cpfTitular;
    }

    /**
     * @param string $nomeTitular
     */
    public function setNomeTitular($nomeTitular)
    {
        $this->nomeTitular = $nomeTitular;
    }

    /**
     * @return string
     */
    public function getCpfTitular()
    {
        return $this->cpfTitular;
    }

    /**
     * @return string
     */
    public function getNomeTitular()
    {
        return $this->nomeTitular;
    }

    /**
     * @return float
     */
    public function getSaldo()
    {
        return $this->saldo;
    }

    /**
     * @param float $valorASacar
     * @return boolean
     */
    public function sacar($valorASacar)
    {
        if($valorASacar < 0 || $valorASacar > $this->saldo || $this->saldo - $valorASacar < 0) {
            return false;
        }
        $this->saldo -= $valorASacar;
        return true;
    }

    /**
     * @param float $valorADepositar
     * @return boolean
     */
    public function depositar($valorADepositar)
    {
        if($valorADepositar < 0 ) {
            return false;
        }
        $this->saldo += $valorADepositar;
        return true;
    }

    /**
     * @param float $valorATransferir
     * @return boolean
     */
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