<?php
session_start();
require_once "../conexao.php";

$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$_SESSION['nome_usuario'] = $nome;

if (empty($email) || empty($senha) || empty($nome) || empty($data_nascimento)) {
    header("Location: form_cadastro.php?erro=vazio");
    exit();
}
$nome_arquivo = $_FILES['foto']['name'];
//
$id = $_GET['id'];
if ($id == 0) {
    // Caso de inserção
    if ($nome_arquivo == "") {
        $novo_nome = "../fotos/generico.png";
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
} 
else {

    if ($nome_arquivo == "") {
        $sql = "UPDATE tb_usuario SET usuario_nome = ?, usuario_datanascimento = ?, usuario_email = ? , usuario_senha = ? WHERE usuario_id = ?";
        $comando = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($comando, 'ssssi', $nome, $data_nascimento, $email, $senha, $id);
    } else {
        $caminho_temporario = $_FILES['foto']['tmp_name'];
        $extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);
        $novo_nome = uniqid() . "." . $extensao;
        $caminho_destino = "../fotos/" . $novo_nome;
        move_uploaded_file($caminho_temporario, $caminho_destino);

        $sql = "UPDATE tb_usuario SET usuario_nome = ?, usuario_datanascimento = ?, usuario_email = ? , usuario_senha = ?, usuario_foto = ? WHERE usuario_id = ?";
        $comando = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($comando, 'sssssi', $nome, $data_nascimento, $email, $senha, $novo_nome, $id);
    }
}

//

mysqli_stmt_execute($comando);


mysqli_stmt_close($comando);

header("Location: ../usuario/index.php?id=$id");
