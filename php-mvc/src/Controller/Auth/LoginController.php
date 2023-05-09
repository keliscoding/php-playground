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

        $isNullUser = is_null($user);

        //realizar esse password verify antes de verificar se o usuario existe previne ataques de temporização
        $isPasswordCorrect = password_verify($password, $isNullUser ? '' : $user->getPassword());

        if($isNullUser) {
            header('Location: /login');
            exit();
        }

        if(!$isPasswordCorrect) {
            $_SESSION['status'] = 'Incorrect Credentials';
            header('Location: /login');
        } else {
            if(password_needs_rehash($user->getPassword(), PASSWORD_ARGON2ID)) {
                $this->userRepository->updatePassword($user->getId(), $password);
            }
            $_SESSION['status'] = 'Logged in Successfully';
            $_SESSION['logado'] = true;
            header('Location: /');
        }
    }
}