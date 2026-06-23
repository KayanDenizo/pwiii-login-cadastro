<?php
require "Usuario.class.php";

$usuario = new Usuario();

if (!$usuario->conecta()) {
    header('Location: tabela.php?msg=erroconexao');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ids = $_POST['ids'] ?? [];
    if (!is_array($ids) || empty($ids)) {
        header('Location: tabela.php?msg=noselected');
        exit;
    }

    // sanitize
    $ids = array_map('intval', $ids);

    if ($usuario->excluirUsuarios($ids)) {
        header('Location: tabela.php?msg=deleted');
        exit;
    } else {
        header('Location: tabela.php?msg=errordelete');
        exit;
    }

} else {
    // single deletion via GET
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if (!$id) {
        header('Location: tabela.php?msg=idinv');
        exit;
    }

    if ($usuario->excluirUsuario($id)) {
        header('Location: tabela.php?msg=deleted');
        exit;
    } else {
        header('Location: tabela.php?msg=errordelete');
        exit;
    }
}

?>
