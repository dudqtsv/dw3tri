<?php
require 'verificar_login.php';
verificarLogin();

$id_usuario = $_SESSION['id'];
$foto = $_SESSION['foto'];
$nome = $_SESSION['nome'];
$tipo = $_SESSION['tipo'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        iframe {
            width: 100%;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <?php
    echo "<div>";
    echo "<p>Olá, $nome! Seja bem vindo(a).</p>";
    echo "</div>";
    ?>
    <iframe src="produtos/index.php"></iframe>
    <a href="produtos/index.php">Todos os produtos</a>
    <a href="logout.php">Sair</a>
</body>

</html>