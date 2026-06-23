<?php
require "Usuario.class.php";

$usuario = new Usuario();
$erro = null;
$sucesso = null;
$dados = null;

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if (!$id || $nome === '' || $email === '' || $senha === '') {
        $erro = 'Preencha todos os campos corretamente.';
    } elseif ($usuario->conecta()) {
        if ($usuario->alterarUsuario($id, $nome, $email, $senha)) {
            $sucesso = 'Usuário alterado com sucesso.';
            $dados = $usuario->buscarUsuarioPorId($id);
        } else {
            $erro = 'Não foi possível alterar o usuário.';
        }
    } else {
        $erro = 'Banco indisponível, tente mais tarde.';
    }
} elseif ($id && $usuario->conecta()) {
    $dados = $usuario->buscarUsuarioPorId($id);

    if (!$dados) {
        $erro = 'Usuário não encontrado.';
    }
} else {
    $erro = 'ID inválido ou banco indisponível.';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style_modelo.css" />
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Editar Usuário</h3>
                        <p class="text-muted">Altere os dados cadastrados.</p>

                        <?php if ($erro) : ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
                        <?php endif; ?>

                        <?php if ($sucesso) : ?>
                            <div class="alert alert-success"><?= htmlspecialchars($sucesso) ?></div>
                        <?php endif; ?>

                        <?php if ($dados) : ?>
                            <form method="POST" action="editar_modelo.php?id=<?= urlencode($dados['id']) ?>">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($dados['id']) ?>" />

                                <div class="mb-3">
                                    <label for="nome" class="form-label">Nome</label>
                                    <input id="nome" class="form-control" type="text" name="nome" value="<?= htmlspecialchars($dados['nome']) ?>" required />
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input id="email" class="form-control" type="email" name="email" value="<?= htmlspecialchars($dados['email']) ?>" required />
                                </div>

                                <div class="mb-3">
                                    <label for="senha" class="form-label">Senha</label>
                                    <input id="senha" class="form-control" type="text" name="senha" value="<?= htmlspecialchars($dados['senha']) ?>" required />
                                </div>

                                <div class="d-flex gap-2">
                                    <button class="btn btn-success" type="submit">Salvar alterações</button>
                                    <a class="btn btn-outline-secondary" href="tabela_modelo.php">Voltar para tabela</a>
                                    <a class="btn btn-outline-primary" href="cadastro_modelo.php">Cadastrar novo</a>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
