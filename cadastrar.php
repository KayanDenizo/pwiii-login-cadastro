<?php
require "Usuario.class.php";
$usuario = new Usuario();
if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
   
    $conn = $usuario->conecta();
    if($conn ){
        $user= $usuario->checkUser($email);
        if(!$user){
            $user = $usuario->inserirUsuario($nome,$email,$senha);
            echo "Usuario cadastrado com sucesso  ";
        }else{
            echo "Usuario JA cadastrado. va para o login ";
            exit();
        }
    }else{
        echo"Banco indisponivel, tente mais tarde ";
    }
}