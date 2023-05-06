<?php
require_once 'conexao.php';

$sql = "INSERT INTO cadastro
        (nome, nascimento, email, site, filhos, salario)
        VALUES (
            'Marieta',
            '1989-10-29',
            'marieta@email.com',
            'https://marieta.com.br',
            2,
            13000.87
        )";

$conexao = newConnection();
$resultado = $conexao->query($sql);

if($resultado) {
    echo "Sucesso :)";
} else {
    echo "Erro: " . $conexao->error;
}

$conexao->close();