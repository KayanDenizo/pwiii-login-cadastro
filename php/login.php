<?php

require "Usuario.class.php";
session_start();

$usuario = new Usuario();
$erro = null;

if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if ($usuario->conecta()) {
        $ok = $usuario->checkPass($email, $senha);
        if ($ok) {
            $_SESSION['nome'] = $email;
            header("Location:home.php");
            exit();
        }

        $erro = "Credenciais inválidas.";
    } else {
        $erro = "Banco indisponível, tente mais tarde.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
    <div class="container-box">
        <div class="card">
            <div class="card-header">
                <h1>Login</h1>
                <p>Informe seu email e senha.</p>
            </div>

            <div class="card-body">
                <?php if ($erro) : ?>
                    <div class="note" style="margin-top:0; color:#ffb4b4; font-size:13px;">
                        <?= htmlspecialchars($erro) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="login.php">
                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" placeholder="abc@mail.com" required />
                    </div>

                    <div class="field">
                        <label for="senha">Senha</label>
                        <input id="senha" type="password" name="senha" placeholder="Sua senha" required />
                    </div>

                    <button class="btn" type="submit">Entrar</button>

                    <div class="top-actions">
                        <a class="link" href="cadastrar.php">Criar conta</a>
                        <a class="link" href="tabela.php">Ver tabela</a>
                    </div>

                    <div class="note">
                        Se ainda não tiver conta, crie em <b>cadastrar.php</b>.
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

