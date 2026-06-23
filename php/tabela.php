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
        <?php if (!empty($_GET['msg'])) : ?>
            <div class="note" style="margin-top:0; color:#333; font-size:13px;">
                <?php
                $m = $_GET['msg'];
                if ($m === 'deleted') echo 'Usuário(s) excluído(s) com sucesso.';
                elseif ($m === 'errordelete') echo 'Erro ao excluir usuário(s).';
                elseif ($m === 'noselected') echo 'Nenhum usuário selecionado.';
                elseif ($m === 'idinv') echo 'ID inválido.';
                elseif ($m === 'erroconexao') echo 'Não foi possível conectar ao banco.';
                ?>
            </div>
        <?php endif; ?>

        <?php if (empty($rows)) : ?>
            <p>Nenhum usuário cadastrado.</p>
        <?php else : ?>
            <form method="post" action="deletar.php" id="multiForm">
                <table>
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll" title="Marcar todos" /></th>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Senha</th>
                            <th>Acoes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rows as $r) : ?>
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="<?= htmlspecialchars($r['id']) ?>" class="rowCheck" /></td>
                                <td><?= htmlspecialchars($r['id']) ?></td>
                                <td><?= htmlspecialchars($r['nome']) ?></td>
                                <td><?= htmlspecialchars($r['email']) ?></td>
                                <td><?= htmlspecialchars($r['senha']) ?></td>
                                <td>
                                    <a class="link badge" href="editar.php?id=<?= urlencode($r['id']) ?>">Editar</a>
                                    <a class="link badge" href="deletar.php?id=<?= urlencode($r['id']) ?>" onclick="return confirm('Excluir este usuário?');">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div style="margin-top:12px;">
                    <button type="submit" formaction="deletar.php" formmethod="post" onclick="return confirmDeleteSelected()">Excluir selecionados</button>
                    <button type="submit" formaction="editar_selecionados.php" formmethod="post">Editar selecionados</button>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <a class="voltar" href="cadastrar.php">Voltar</a>

    <script>
        document.getElementById('checkAll')?.addEventListener('change', function(e){
            var checked = e.target.checked;
            document.querySelectorAll('.rowCheck').forEach(function(cb){ cb.checked = checked; });
        });

        function confirmDeleteSelected(){
            var any = document.querySelectorAll('.rowCheck:checked').length > 0;
            if (!any){ alert('Selecione ao menos um usuário.'); return false; }
            return confirm('Excluir os usuários selecionados?');
        }
    </script>
</body>

</html>
