<?php

namespace Zam0k\PhpMvc\Controller\Auth;

use Zam0k\PhpMvc\Controller\Controller;
class LoginFormController implements Controller
{
    public function processaRequisicao()
    {
        if(isset($_SESSION['logado'])) {
            header('Location: /');
        }
        require_once __DIR__ . '/../../../views/login-form.php';
    }
}