<?php
require "Usuario.class.php";
$usuario = new Usuario();
if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $conn = $usuario->conecta();
    if ($conn) {
        $user = $usuario->checkUser($email);
        if (!$user) {
            $usuario->inserirUsuario($nome, $email, $senha);
            echo "Usuario cadastrado com sucesso  ";
        } else {
            echo "Usuario JA cadastrado. va para o login ";
            exit();
        }
    } else {
        echo "Banco indisponivel, tente mais tarde ";
    }
} else {
    echo "nao veio post";
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuarios</title>
</head>

<body>
    <h2>Cadastro De Usuários</h2>
    <form method="POST" action="login.php">
        <input type="text" name="nome" placeholder="Informe o nome">
        <input type="text" name="email" placeholder="Informe seu email">
        <input type="text" name="senha" placeholder="Informe a senha">
        <input type="submit" name="btn" value="Cadastrar">
    </form>

</body>

</html>