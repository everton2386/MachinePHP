<?php

namespace app\controllers;
use app\models\UserModel;

class login

{
    public function index()
    {
        return 
        [
            "views" => "login.php",
            "data" => ["title" => "login"]
        ];
    }

    public function verify()
{
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Verificar se o usuário já existe na base de dados
    $userModel = new UserModel();
    $existingUser = $userModel->verify($username, $password);
    if ($existingUser) {
        // Usuário encontrado, redirecionar para algum lugar
        header('Location: http://localhost/product-detail.html');
        die();
    }
    
    // Se o usuário não existir, você pode prosseguir com a inserção
    $success = $userModel->insert(['username' => $username, 'password' => $password]);
    header('Location: http://localhost/login');
    die();
    }


   
   }

