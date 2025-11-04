<?php
    require 'verificar_login.php';

    verificarLogin();

    $id_usuario = $_SESSION['id'];

    $sql = "SELECT * FROM tb_usuario;";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($comando);
    $resultados = mysqli_stmt_get_result($comando);

    while ($usuario = mysqli_fetch_assoc($resultados)) {
        $foto = $usuario['usuario_foto'];
        $nome = $usuario['usuario_nome'];
    }

    echo "<div>";
    echo "<p>Olá $nome! Seja bem vindo(a).</p>";
    echo "<img src='fotos/$foto';>";
    echo "</div>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="logout.php">Sair</a>
</body>
</html>
