<?php

function verifyController($uri,$router,$method)
{
    $uriPath = explode('@',$router["$method"]["$uri"]);
    $pathController = PATH.$uriPath[0];
    $methodPath = $uriPath[1];

    if(!class_exists($pathController))
    {
        die("controller not found !!!");
    }

    $newMethod =  new $pathController;

    if(!method_exists($newMethod,$methodPath))
    {
        die("method not found !!!");
    }
    
    return $newMethod->$methodPath();
}