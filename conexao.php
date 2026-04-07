<?php
 function conecta(){      

    $dns      = "mysql:dbname=etimusuario;host=localhost";
    $userName = "root";
    $userPass = "";

    try{
        $pdo = new PDO($dns, $userName, $userPass);
        return $pdo;

    } catch(\Throwable $th){
        return false;
    }

}