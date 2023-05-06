<?php
    $emailDev = 'kellyplcastelo@gmail.com';
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];

    $headers = 'From: ' . $email;

    mail($emailDev, $assunto, $mensagem, $headers);

    header('Location: contatos.html');
    exit();