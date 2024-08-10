<?php

function routers()
{
    return 
    [
        "POST" => 
        [
            "/register" => "Register@register",
            "/login" => "Login@verify"
        ], 

        "GET" =>
        [
            "/" => "Home@index",
            '/register' => "Register@index",
            '/login' => "Login@index"
           
            
        ]
        ];
}

function router()
{
    $uri = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
    $router = routers();
    $method = $_SERVER['REQUEST_METHOD'];

    if(!array_key_exists($method,$router))
    {
        die(header("HTTP/1.0 404 Not Found"));
    }

    if(!array_key_exists($uri,$router["$method"]))
    {   
        header("HTTP/1.0 404 Not Found");
        die("<h1>Page not found 404 </h1>");
    }
    
    return verifyController($uri,$router,$method);
}