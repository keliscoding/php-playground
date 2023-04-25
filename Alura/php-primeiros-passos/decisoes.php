<?php

$idade = 17;

if($idade >= 18) {
    echo "Você tem $idade anos, pode entrar!" . PHP_EOL;
} else {
    echo "Você não tem 18 anos."  . PHP_EOL;
}

switch ($idade) {
    case 18:
        echo "Você tem 18 anos!";
        break;
    case 17:
        echo "Você é menor de idade!";
        break; // break é obrigatorio no php
    default:
        echo "Caiu no default";
}

// php tem if ternario (O BEM VENCEU)
//$variavel = $condicao ? $valorSeVerdadeiro : $valorSeFalso;