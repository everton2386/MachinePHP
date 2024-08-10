<?php

namespace app\models;

use app\models\Connection;

use PDOException;

abstract class Model

{
    protected $table;

    protected $connection;

    public function __construct()
    {
      $this->connection = Connection::connect();    
    }


    public function insert(array $attributes)
    {
      //vulnerable

       $username = $attributes['username'];
       $email = $attributes['email'];
       $password = $attributes['password'];

       $sql = "INSERT INTO {$this->table} (username, email, password) VALUES (?, ?, ?)";
       $insert = $this->connection->prepare($sql);

    try {
        $insert->execute([$username, $email, $password]);
        return true;
    }   catch (PDOException $e)
    {
    return false;
    }

    }

    public function verify($username, $password)
    { 
        // Consulta SQL para verificar se há um usuário com o nome de usuário ou e-mail especificado
        $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$username, $password]);
        return $stmt->fetch(); // Retorna o usuário se encontrado, ou false se não encontrado
     }



    //

    public function all()
    {
      $sql = "select * from {$this->table}";
      $list = $this->connection->prepare($sql);
      $list->execute();

      return $list->fetchAll();
    }

    // Aqui você executa a consulta SQL para verificar se o usuário ou e-mail já existem

    public function getUserByUsernameOrEmail($username, $email)
    {
        
        
        $query = "SELECT * FROM users WHERE username = :username OR email = :email";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(['username' => $username, 'email' => $email]);
        return $stmt->fetch(); 
    }


      

    //
    
    public function find($field, $value)
    {
        $sql = "select * from {$this->table} where {$field} =?";
        $list = $this->connection->prepare($sql);
        $list-> bindValue(1,$value);
        $list->execute();

        return $list->fetch();
    }
}