<?php
require "../verificarLoginPasta.php"; // garante que o usuário está logado
verificarLogin();


$usuario_id = $_SESSION['usuario_id']; // vem do login
$tipo = $_SESSION['tipo'];


$produto_id = intval($_GET['id']);

// Verifica se o produto já está na lista do usuário
$sql = "SELECT * FROM tb_lista WHERE usuario_id = ? AND produto_id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "ii", $usuario_id, $produto_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    echo "<script>alert('Este produto já está na sua lista!'); window.location='../produtos/index.php';</script>";
    exit;
}

// Insere na lista
$sql = "INSERT INTO tb_lista (usuario_id, produto_id) VALUES (?, ?)";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "ii", $usuario_id, $produto_id);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Produto adicionado à lista com sucesso!'); window.location='../produtos/index.php';</script>";
} else {
    echo "<script>alert('Erro ao adicionar produto à lista.'); window.location='../produtos/index.php';</script>";
}
?>
