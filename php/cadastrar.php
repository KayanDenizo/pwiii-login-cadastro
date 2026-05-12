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
    <title>Cadastrar Usuários</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
    <div class="container-box">
        <div class="card">
            <div class="card-header">
                <h1>Cadastro de Usuários</h1>
                <p>Preencha os dados para cadastrar no banco.</p>
            </div>
            <div class="card-body">
                <form method="POST" action="cadastrar.php">
                    <div class="field">
                        <label for="nome">Nome</label>
                        <input id="nome" type="text" name="nome" placeholder="Informe o nome" required />
                    </div>

                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" placeholder="Informe seu email" required />
                    </div>

                    <div class="field">
                        <label for="senha">Senha</label>
                        <input id="senha" type="password" name="senha" placeholder="Informe a senha" required />
                    </div>

                    <button class="btn" type="submit" name="btn">Cadastrar</button>

                    <div class="top-actions">
                        <a class="link" href="tabela.php">Ver tabela</a>
                        <a class="link" href="login.php">Ir para login</a>
                    </div>

                    <div class="note">
                        Dica: o email precisa ser único.
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
