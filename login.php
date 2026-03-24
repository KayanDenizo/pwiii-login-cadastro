<?php
session_start();

require "Usuario.class.php";
require "conexao.php";

$conn = conecta();
if($conn) {
    if (isset($_POST['nome'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $usuario = new Usuario();
        $user = $user->checkUser( $email );
        if ($user) {
            $user = $usuario->checkPass($email, $senha);

            $_SESSION['nome'] = $nome;
            header("Location:home.php");
        } else {
            echo "Usuario nao cadastro!";
            header("Location:cadastrar.php");
        }
    }
} else {
    echo "Banco indisponivel. tente mais tarde";
    exit();
}