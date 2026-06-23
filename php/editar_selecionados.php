<?php
// Recebe ids por POST e encaminha para editar
$ids = $_POST['ids'] ?? [];

if (!is_array($ids) || empty($ids)) {
    header('Location: tabela.php?msg=noselected');
    exit;
}

$ids = array_map('intval', $ids);

if (count($ids) === 1) {
    header('Location: editar.php?id=' . $ids[0]);
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Editar selecionados</title>
    <link rel="stylesheet" href="../css/style.css" />
    <style> .list { margin:20px 0; } .list a { display:block; margin:6px 0; } </style>
</head>
<body>
    <div class="container">
        <h2>Editar usuários selecionados</h2>
        <p>Foram selecionados <?= count($ids) ?> usuários. Clique em cada link para editar individualmente.</p>

        <div class="list">
            <?php foreach ($ids as $i): ?>
                <a class="link" href="editar.php?id=<?= urlencode($i) ?>">Editar usuário ID <?= htmlspecialchars($i) ?></a>
            <?php endforeach; ?>
        </div>

        <a class="link" href="tabela.php">Voltar para tabela</a>
    </div>
</body>
</html>
