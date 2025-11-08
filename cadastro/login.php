<?php
require_once '../conexao.php';
session_start();

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM tb_usuario WHERE usuario_email = ? AND usuario_senha = ?";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, 'ss', $email, $senha);

mysqli_stmt_execute($comando);

$resultados = mysqli_stmt_get_result($comando);
$quantidade = mysqli_num_rows($resultados);

if ($quantidade == 0) {
    header('Location: ../index.php?msg=erro');
    exit;
} else {
    $usuario = mysqli_fetch_assoc($resultados);
    $tipo = $usuario['usuario_tipo'];
    $id = $usuario['usuario_id'];

    $_SESSION['usuario_tipo'] = $tipo;
    $_SESSION['usuario_id'] = $id;
}

// consulta para pegar o nome do usuário

if ($tipo == 'c') {
    $sql = "SELECT * FROM tb_usuario WHERE usuario_id = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $id);
    mysqli_stmt_execute($comando);

    $resultados = mysqli_stmt_get_result($comando);
    $cliente = mysqli_fetch_assoc($resultados);

    $_SESSION['id'] = $cliente['usuario_id'];
    $_SESSION['nome'] = $cliente['usuario_nome'];
    $_SESSION['foto'] = $cliente['usuario_foto'];
    $_SESSION['tipo'] = $cliente['usuario_tipo'];
} else {
    $sql = "SELECT * FROM tb_usuario WHERE usuario_id = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $id);
    mysqli_stmt_execute($comando);

    $resultados = mysqli_stmt_get_result($comando);
    $gerente = mysqli_fetch_assoc($resultados);

    $_SESSION['id'] = $gerente['usuario_id'];
    $_SESSION['nome'] = $gerente['usuario_nome'];
    $_SESSION['foto'] = $gerente['usuario_foto'];
    $_SESSION['tipo'] = $gerente['usuario_tipo'];
}
header('Location: ../home.php?id=$id');
