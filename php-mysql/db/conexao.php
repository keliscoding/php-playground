<?php

// criar schema

function newConnection($banco = 'curso_php') {
    $servidor = '127.0.0.1:3306';
    $usuario = 'root';
    $senha = 'root'; // ideal é não expor essas informações

    $conexao = new mysqli($servidor, $usuario, $senha, $banco);

    if($conexao->connect_error) {
        die('Erro: ' . $conexao->connect_error); // esse tipo de tratamento de erro não é pra usar irl
    }

    return $conexao;
}