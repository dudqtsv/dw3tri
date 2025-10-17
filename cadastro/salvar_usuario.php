<?php
session_start();
require_once "../conexao.php";

$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$_SESSION['nome_usuario'] = $nome;

if (empty($email) || empty($senha) || empty($nome) || empty($data_nascimento)) {
    header("Location: ../erro.html");
    exit();
}
$nome_arquivo = $_FILES['foto']['name'];

if ($nome_arquivo == "") {
    $novo_nome = "./foto/generico.png";
} else {
    $caminho_temporario = $_FILES['foto']['tmp_name'];
    $extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);
    $novo_nome = uniqid() . "." . $extensao;
    $caminho_destino = "../fotos/" . $novo_nome;
    move_uploaded_file($caminho_temporario, $caminho_destino);
}
$sql = "INSERT INTO tb_usuario (usuario_nome, usuario_datanascimento, usuario_email, usuario_senha, usuario_foto) VALUES (?, ?, ?, ?, ?)";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, 'sssss', $nome, $data_nascimento, $email, $senha, $novo_nome);

mysqli_stmt_execute($comando);

$id = mysqli_stmt_insert_id($comando);
$_SESSION['id'] = $id;

mysqli_stmt_close($comando);

header("Location: ../index.php");
