<?php

namespace Zam0k\PhpMvc\Controller\Auth;

class LogoutController implements \Zam0k\PhpMvc\Controller\Controller
{

    public function processaRequisicao()
    {
        unset($_SESSION['logado']);
        header('Location: /login');
    }
}