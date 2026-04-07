<?php

require "Usuario.class.php";
require "conexao.php";
session_start();

$usuario = new Usuario();
if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
   
    $conn = $usuario->conecta();
    if($conn ){
        $user= $usuario->checkUser($email);
        if(!$user){
            $usuario->inserirUsuario($nome,$email,$senha);
            $_SESSION['nome']=$nome;
            header("Location:home.php");
            
        }else{
            echo "Usuario não cadastrado! vá para o login ";
            header("Location:home.php");
            
        }
    }else{
        echo"Banco indisponivel, tente mais tarde ";
    }
}else{
    echo "nao veio post";

}
?>