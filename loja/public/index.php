<?php


require "bootstrap.php";
$data = router();
extract($data['data']);


if(!isset($data['views']))
{
    die("data not found !!");
}

$views = $data['views'];

if(!file_exists(ROOT.$views))
{
    die("file not found");
}

require ROOT."master.php";



?>

    
