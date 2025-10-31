<?php
session_start();
require_once "../conexao.php";
?>
<?php
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
        <h1>Criar nova conta</h1>
        <form action="salvar_usuario.php" method="POST" enctype="multipart/form-data">
            <p>Nome</p><input type="text" name="nome">
            <p>Data de nascimento</p><input type="date" name="data_nascimento">
            <p>E-mail</p><input type="email" name="email">
            <p>Senha</p><input type="password" name="senha">
            <p>Foto de perfil</p><input type="file" name="foto">
            <p><input id="submit" type="submit"></p>
        </form>
    </div>
    <a href="../index.php">Cancelar</a>
</body>
</html>