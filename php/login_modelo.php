<?php
require "Usuario.class.php";
session_start();

$usuario = new Usuario();
$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if ($email === '' || $senha === '') {
        $erro = 'Preencha email e senha.';
    } elseif ($usuario->conecta()) {
        if ($usuario->checkPass($email, $senha)) {
            $_SESSION['nome'] = $email;
            header('Location: home.php');
            exit;
        }

        $erro = 'Credenciais inválidas.';
    } else {
        $erro = 'Banco indisponível, tente mais tarde.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style_modelo.css" />
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-2">Login</h3>
                        <p class="text-muted">Informe seu email e senha.</p>

                        <?php if ($erro) : ?>
                            <div class="alert alert-danger" role="alert"><?= htmlspecialchars($erro) ?></div>
                        <?php endif; ?>

                        <form method="POST" action="login_modelo.php">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" class="form-control" type="email" name="email" placeholder="abc@mail.com" required />
                            </div>

                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input id="senha" class="form-control" type="password" name="senha" placeholder="Sua senha" required />
                            </div>

                            <div class="d-flex gap-2">
                                <button class="btn btn-success" type="submit">Entrar</button>
                                <a class="btn btn-outline-primary" href="tabela_modelo.php">Ver tabela</a>
                                <a class="btn btn-outline-secondary" href="cadastro_modelo.php">Criar conta</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
