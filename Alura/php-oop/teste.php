<?php

require_once('./src/Conta.php');

$conta = new Conta("12345678910", "Castelo", 200);

$conta->sacar(300);

echo var_dump($conta);