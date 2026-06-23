<?php
require "Usuario.class.php";

$usuario = new Usuario();
$erro = null;
$sucesso = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if ($nome === '' || $email === '' || $senha === '') {
        $erro = 'Preencha todos os campos.';
    } elseif ($usuario->conecta()) {
        if ($usuario->checkUser($email)) {
            $erro = 'Usuário já cadastrado. Faça login.';
        } else {
            if ($usuario->inserirUsuario($nome, $email, $senha)) {
                $sucesso = 'Usuário cadastrado com sucesso.';
            } else {
                $erro = 'Erro ao cadastrar usuário.';
            }
        }
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
    <title>Cadastrar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style_modelo.css" />
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Cadastro de Usuários</h3>
                        <p class="text-muted">Preencha os dados para cadastrar no banco.</p>

                        <?php if ($erro) : ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
                        <?php endif; ?>

                        <?php if ($sucesso) : ?>
                            <div class="alert alert-success"><?= htmlspecialchars($sucesso) ?></div>
                        <?php endif; ?>

                        <form method="POST" action="cadastro_modelo.php">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input id="nome" class="form-control" type="text" name="nome" placeholder="Informe o nome" required />
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" class="form-control" type="email" name="email" placeholder="Informe seu email" required />
                            </div>

                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input id="senha" class="form-control" type="password" name="senha" placeholder="Informe a senha" required />
                            </div>

                            <div class="d-flex gap-2">
                                <button class="btn btn-success" type="submit">Cadastrar</button>
                                <a class="btn btn-outline-primary" href="login_modelo.php">Ir para login</a>
                                <a class="btn btn-outline-secondary" href="tabela_modelo.php">Ver tabela</a>
                            </div>

                            <p class="mt-3 text-muted">Dica: o email precisa ser único.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
