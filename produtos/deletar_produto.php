<?php
require_once "../conexao.php";

$id = $_GET['id'];

$sqlEstoque = "DELETE FROM tb_estoque WHERE produto_id = ?";
$stmtEstoque = mysqli_prepare($conexao, $sqlEstoque);
mysqli_stmt_bind_param($stmtEstoque, "i", $id);
mysqli_stmt_execute($stmtEstoque);

$sqlProduto = "DELETE FROM tb_produto WHERE produto_id = ?";
$stmtProduto = mysqli_prepare($conexao, $sqlProduto);
mysqli_stmt_bind_param($stmtProduto, "i", $id);
mysqli_stmt_execute($stmtProduto);

header("Location: index.php");
exit;
?>
