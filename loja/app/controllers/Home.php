<?php

namespace app\controllers;

class Home
{
    public function index()
    {
        return 
        [
         "views" => "home.php",
         "data" => ["title" => "home"]
        ];
    }

    
}

