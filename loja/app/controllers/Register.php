<?php

namespace app\controllers;
use app\models\UserModel;

class Register
{
    public function index()
    {
        return [
            'views' => "register.php",
            'data' => ["title" => "register"]
        ];
    }

    public function register()
{
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Verificar se o usuário ou e-mail já existem
    $user = new UserModel();
    $existingUser = $user->getUserByUsernameOrEmail($username, $email);

    if ($existingUser) {
        // Usuário ou e-mail já existe, você pode lidar com isso aqui, por exemplo, exibindo uma mensagem de erro
        echo "Usuário ou e-mail já existem.";
        return;
        
    }

    // Se não houver usuário ou e-mail existentes, proceda com a inserção
    $success = $user->insert(['username' => $username, 'email' => $email, 'password' => $password]);

    if ($success) {
        header('Location: http://localhost/login');
        exit();
    }

        return [
            "views" => "register.php",
            "data" => ["title" => "register"]
        ];
    }
}
