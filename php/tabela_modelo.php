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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6w7Yd1ZL+3oZ6Y5nI1wqUod8GCExl3Og8ifwB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style_modelo.css" />
</head>

<body>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0"></h2>
                <div>
                <a class="btn btn-success" href="cadastrar.php">Novo Usuário</a>
            </div>
        </div>
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
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width:48px;" class="text-center"><input type="checkbox" id="checkAll" title="Marcar todos" /></th>
                                <th style="width:72px;">ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Senha</th>
                                <th style="width:180px;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rows as $r) : ?>
                                <tr>
                                    <td class="text-center">
                                        <div class="form-check">
                                            <input class="form-check-input rowCheck" type="checkbox" name="ids[]" value="<?= htmlspecialchars($r['id']) ?>" id="chk<?= htmlspecialchars($r['id']) ?>">
                                        </div>
                                    </td>
                                    <td><?= htmlspecialchars($r['id']) ?></td>
                                    <td><?= htmlspecialchars($r['nome']) ?></td>
                                    <td><?= htmlspecialchars($r['email']) ?></td>
                                    <td><?= htmlspecialchars($r['senha']) ?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Ações">
                                            <a class="btn btn-sm btn-edit" href="editar_modelo.php?id=<?= urlencode($r['id']) ?>">Editar</a>
                                            <a class="btn btn-sm btn-delete" href="deletar.php?id=<?= urlencode($r['id']) ?>" onclick="return confirm('Excluir este usuário?');">Excluir</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-3 d-flex gap-2">
                    <button type="submit" formaction="deletar.php" formmethod="post" class="btn btn-danger" onclick="return confirmDeleteSelected()">Excluir selecionados</button>
                    <button type="submit" formaction="editar_selecionados.php" formmethod="post" class="btn btn-secondary">Editar selecionados</button>
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
