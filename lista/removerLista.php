<?php
require "../verificarLoginPasta.php";
verificarLogin();

$usuario_id = $_SESSION['usuario_id'];

if (!isset($_GET['id'])) {
    echo "<script>alert('Produto inválido!'); window.location='index.php';</script>";
    exit;
}

$produto_id = intval($_GET['id']);

// Deleta da lista do usuário logado
$sql = "DELETE FROM tb_lista WHERE usuario_id = ? AND produto_id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "ii", $usuario_id, $produto_id);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Produto removido da lista com sucesso!'); window.location='index.php';</script>";
} else {
    echo "<script>alert('Erro ao remover o produto da lista.'); window.location='index.php';</script>";
}
?>
