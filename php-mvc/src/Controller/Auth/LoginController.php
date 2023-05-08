<?php

namespace Zam0k\PhpMvc\Controller\Auth;

use Zam0k\PhpMvc\Controller\Controller;
use Zam0k\PhpMvc\Repository\UserRepository;

class LoginController implements Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function processaRequisicao()
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        $user = $this->userRepository->findByEmail($email);

        if($user === null) {
            header('Location: /login');
            exit();
        }

        $isPasswordCorrect = password_verify($password, $user->getPassword() ?? '');

        echo $isPasswordCorrect;

        if(!$isPasswordCorrect) {
            $_SESSION['status'] = 'Incorrect Credentials';
            header('Location: /login');
        } else {
            $_SESSION['status'] = 'Logged in Successfully';
            $_SESSION['logado'] = true;
            header('Location: /');
        }
    }
}