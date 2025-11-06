<?php
require '../verificar_login.php';
verificarLogin();
$tipo = $_SESSION['tipo'];
if ($tipo != 'g') {
    header('Location: index.php');
}
//
if (isset($_GET['acao'])) {
    echo "<h1>Editar produto</h1>";
}
else {
    echo "<h1>Cadastro de produtos</h1>";
    $id = 0;
    $nome = "";
    $nascimento = "";
    $nacionalidade = "";
}

//  $sql = "SELECT * FROM tb_produto WHERE produto_id = ?";
//     $comando = mysqli_prepare($conexao, $sql);
//     mysqli_stmt_bind_param($comando, 'i', $tipo);
//     mysqli_stmt_execute($comando);

//     $resultados = mysqli_stmt_get_result($comando);

//     $autor = mysqli_fetch_assoc($resultados);

//     $nome = $autor['nome'];
//     $nascimento = $autor['data_nascimento'];
//     $nacionalidade = $autor['nacionalidade'];
//

if (isset($_SESSION['produto_nome'])) {
    $nome = $_SESSION['produto_nome'];
}

if (isset($_SESSION['preco'])) {
    $preco = $_SESSION['preco'];
}

if (isset($_SESSION['categoria'])) {
    $categoria = $_SESSION['categoria'];
}

if (isset($_SESSION['produto_foto'])) {
    $foto = $_SESSION['produto_foto'];
}

//

if (isset($_GET['erro'])) {
    $erro = $_GET['erro'];
} else {
    $erro = 0;
}
if ($erro != 0) {
    echo "<p>Não deixe nenhum campo vazio!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<body>
    <div>
        <form action="salvar_produto.php" method="POST" enctype="multipart/form-data">
            <p>Nome</p><input value="<?php echo $nome;?>" type="text" name="nome">
            <p>Preço</p><input type="number" name="preco">
            <p>Categoria:</p><select name="categoria">
                <?php

                $sql = "SELECT * FROM tb_categoria";
                $comando = mysqli_prepare($conexao, $sql);

                mysqli_stmt_execute($comando);

                $resultados = mysqli_stmt_get_result($comando);
                while ($categoria = mysqli_fetch_assoc($resultados)) {
                    $categoria = $categoria['categoria_nome'];
                    echo "<option id='option' value='$categoria'>$categoria</option>";
                }
                ?>
            </select>
            <p>Foto</p><input type="file" name="foto">
            <p><input id="submit" type="submit"></p>
        </form>
    </div>
    <a href="index.php">Cancelar</a>
</body>

</html>