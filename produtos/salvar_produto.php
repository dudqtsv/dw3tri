<?php
session_start();
require_once "../conexao.php";

$id = $_GET['id'];  // ID do produto, vindo da URL
$nome = $_POST['nome'];
$preco = $_POST['preco'];
$categoria = $_POST['categoria'];
$foto = $_FILES['foto'];

$_SESSION['produto_nome'] = $nome;
$_SESSION['preco'] = $preco;
$_SESSION['categoria'] = $categoria;
$_SESSION['produto_foto'] = $foto;

if (empty($nome) || empty($preco) || empty($categoria)) {
    header("Location: form_produto.php?erro=vazio");
    exit();
}

$nome_arquivo = $_FILES['foto']['name'];

if ($id == 0) {
    // Caso de inserção
    if ($nome_arquivo == "") {
        $novo_nome = "../fotos/produto_generico.png";
    } else {
        $caminho_temporario = $_FILES['foto']['tmp_name'];
        $extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);
        $novo_nome = uniqid() . "." . $extensao;
        $caminho_destino = "../fotos/" . $novo_nome;
        move_uploaded_file($caminho_temporario, $caminho_destino);
    }

    $sql = "INSERT INTO tb_produto (produto_nome, produto_preco, categoria_id, produto_foto) VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'sdis', $nome, $preco, $categoria, $novo_nome);
} else {
    // Caso de edição
    if ($nome_arquivo == "") {
        $sql = "UPDATE tb_produto SET produto_nome = ?, produto_preco = ?, categoria_id = ? WHERE produto_id = ?";
        $comando = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($comando, 'sdii', $nome, $preco, $categoria, $id);
    } else {
        $caminho_temporario = $_FILES['foto']['tmp_name'];
        $extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);
        $novo_nome = uniqid() . "." . $extensao;
        $caminho_destino = "../fotos/" . $novo_nome;
        move_uploaded_file($caminho_temporario, $caminho_destino);

        $sql = "UPDATE tb_produto SET produto_nome = ?, produto_preco = ?, categoria_id = ?, produto_foto = ? WHERE produto_id = ?";
        $comando = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($comando, 'sdisi', $nome, $preco, $categoria, $novo_nome, $id);
    }
}

mysqli_stmt_execute($comando);

if ($id == 0) {
    $id = mysqli_stmt_insert_id($comando);
    $_SESSION['id'] = $id;
}

mysqli_stmt_close($comando);

header("Location: ../estoque/index.php");
exit();
?>
