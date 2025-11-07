<?php
require '../verificarLoginPasta.php';
verificarLogin();
$tipo = $_SESSION['tipo'];
if ($tipo != 'g') {
    header('Location: index.php');
}

//

if (isset($_GET['acao'])) {
    echo "<h1>Editar produto</h1>";

    $sql = "SELECT * FROM tb_produto WHERE produto_id = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $_GET['id']);
    mysqli_stmt_execute($comando);
    $resultados = mysqli_stmt_get_result($comando);
    $produto = mysqli_fetch_assoc($resultados);

    $id = $_GET['id'];
    $nome = $produto['produto_nome'];
    $preco = $produto['produto_preco'];
    $categoria_id = $produto['categoria_id'];
    $foto = $produto['produto_foto'];
} else {
    echo "<h1>Cadastro de produtos</h1>";
    $id = 0;
    $nome = "";
    $preco = "";
    $categoria_id = "";
    $foto = "";
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
        <form action="salvar_produto.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <p>Nome</p><input value="<?php echo $nome; ?>" type="text" name="nome">
            <p>Preço</p><input type="number" name="preco" value="<?php echo $preco; ?>">
            <p>Categoria:</p><select name="categoria">
                <?php

                $sql = "SELECT * FROM tb_categoria";
                $comando = mysqli_prepare($conexao, $sql);

                mysqli_stmt_execute($comando);

                $resultados = mysqli_stmt_get_result($comando);
                while ($categoria = mysqli_fetch_assoc($resultados)) {
                    $categoria_nome = $categoria['categoria_nome'];
                    $categoria_id_option = $categoria['categoria_id'];

                    // if ($categoria_id == $categoria_id_option) {
                    //     $selected = "selected";
                    // }
                    // else {
                    //     $selected = "";
                    // }

                    $selected = ($categoria_id == $categoria_id_option) ? "selected" : "";

                    echo "<option id='option' $selected value='$categoria_id_option'>$categoria_nome</option>";
                }
                ?>
            </select>
            <p>Foto</p><input type="file" name="foto" value="<?php echo "<img src='../fotos/$foto'>"; ?>">
            <p><input id="submit" type="submit"></p>
        </form>
    </div>
    <a href="index.php">Cancelar</a>
</body>

</html>