<?php

require_once('./src/Conta.php');

$conta = new Conta("12345678910", "Castelo");

$conta->depositar(800);
$conta->sacar(300);

$contaLu = new Conta("9999999999", "Lucas");

$contaLu->depositar(800);
$contaLu->transferencia($conta, 900.0);

echo var_dump($conta);
echo var_dump($contaLu);