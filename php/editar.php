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
        $erro = "Preencha todos os campos corretamente.";
    } elseif ($usuario->conecta()) {
        if ($usuario->alterarUsuario($id, $nome, $email, $senha)) {
            $sucesso = "Usuario alterado com sucesso.";
            $dados = $usuario->buscarUsuarioPorId($id);
        } else {
            $erro = "Nao foi possivel alterar o usuario.";
        }
    } else {
        $erro = "Banco indisponivel, tente mais tarde.";
    }
} elseif ($id && $usuario->conecta()) {
    $dados = $usuario->buscarUsuarioPorId($id);

    if (!$dados) {
        $erro = "Usuario nao encontrado.";
    }
} else {
    $erro = "ID invalido ou banco indisponivel.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
    <div class="container-box">
        <div class="card">
            <div class="card-header">
                <h1>Editar Usuario</h1>
                <p>Altere os dados cadastrados.</p>
            </div>

            <div class="card-body">
                <?php if ($erro) : ?>
                    <div class="note" style="margin-top:0; color:#ffb4b4; font-size:13px;">
                        <?= htmlspecialchars($erro) ?>
                    </div>
                <?php endif; ?>

                <?php if ($sucesso) : ?>
                    <div class="note" style="margin-top:0; color:#b8ffcf; font-size:13px;">
                        <?= htmlspecialchars($sucesso) ?>
                    </div>
                <?php endif; ?>

                <?php if ($dados) : ?>
                    <form method="POST" action="editar.php?id=<?= urlencode($dados['id']) ?>">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($dados['id']) ?>" />

                        <div class="field">
                            <label for="nome">Nome</label>
                            <input id="nome" type="text" name="nome" value="<?= htmlspecialchars($dados['nome']) ?>" required />
                        </div>

                        <div class="field">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" value="<?= htmlspecialchars($dados['email']) ?>" required />
                        </div>

                        <div class="field">
                            <label for="senha">Senha</label>
                            <input id="senha" type="text" name="senha" value="<?= htmlspecialchars($dados['senha']) ?>" required />
                        </div>

                        <button class="btn" type="submit">Salvar alteracoes</button>
                    </form>
                <?php endif; ?>

                <div class="top-actions">
                    <a class="link" href="tabela.php">Voltar para tabela</a>
                    <a class="link" href="cadastrar.php">Cadastrar novo</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
