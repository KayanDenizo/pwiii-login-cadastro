<?php
require "Usuario.class.php";
$usuario = new Usuario();
$rows = [];

if ($usuario->conecta()) {
    $rows = $usuario->listarUsuarios();
}
?>

<!-- Listar usuarios (dados) -->

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de Usuários</title>
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body>
    <div class="container">
        <h2>Lista de Usuários</h2>

        <?php if (empty($rows)) : ?>
            <p>Nenhum usuário cadastrado.</p>
        <?php else : ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Senha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td><?= htmlspecialchars($r['id']) ?></td>
                            <td><?= htmlspecialchars($r['nome']) ?></td>
                            <td><?= htmlspecialchars($r['email']) ?></td>
                            <td><?= htmlspecialchars($r['senha']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <a class="voltar" href="cadastrar.php">Voltar</a>
</body>

</html>