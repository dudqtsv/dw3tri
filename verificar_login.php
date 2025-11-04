<?php
session_start();
require_once 'conexao.php';
function verificarLogin() {
    if (!isset($_SESSION['id'])) {
        header('Location: index.php?erro=1');
        exit(); 
        $id = $_SESSION['id'];
        $nome = $_SESSION['nome_usuario'];
        $tipo = $_SESSION['usuario_tipo'];
    }
}
?>
