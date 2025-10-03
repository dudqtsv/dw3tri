<?php
session_start();
    require_once "../conexao.php"; 
    
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $_SESSION['nome_usuario'] = $nome;

    if (empty($email) || empty($senha) || empty($nome) || empty($data_nascimento)) {
        header("Location: erro.html");
        exit();
    }

    $nome_arquivo = $_FILES['foto']['name'];
    $caminho_temporario = $_FILES['foto']['tmp_name'];

    //pegar a extensao do arquivo 
    $extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);

    //gerar novo nome 
    $novo_nome = uniqid() . "." . $extensao;

    //lembre-se de criar a pasta e de ajustar as permissoes
    $caminho_destino = "../fotos/" . $novo_nome;

    move_uploaded_file($caminho_temporario, $caminho_destino);
    $sql = "INSERT INTO tb_usuario (usuario_nome, usuario_datanascimento, usuario_email, usuario_senha, usuario_foto) VALUES (?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);

    // letra s -> varchar, date, datetime, char
    // letra i -> int
    // letra d -> float, decimal
    mysqli_stmt_bind_param($comando, 'sssss', $nome, $data_nascimento, $email, $senha, $novo_nome);

    mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);

    header("Location: ../index.php");
?>