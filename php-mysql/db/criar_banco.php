<?php

require_once "conexao.php";

$conexao = newConnection(null);

$sql = 'CREATE DATABASE IF NOT EXISTS curso_php';

$resultado = $conexao->query($sql);

if($resultado) {
    echo "Sucesso :)";
} else {
    echo "Erro: " . $conexao->error;
}

$conexao->close();