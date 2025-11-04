<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: index.php?erro=1');
} else {
    $id = $_SESSION['id'];
    $nome = $_SESSION['nome_usuario'];
    $tipo = $_SESSION['usuario_tipo'];
}
?>
