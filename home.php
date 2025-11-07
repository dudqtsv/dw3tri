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
        img {
            border-radius: 50%;
            width: 50px;
        }
    </style>
    <title>Document</title>
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <?php
    echo "<div>";
    echo "<p>Olá, <a href='usuario/index.php'>$nome</a>! Seja bem vindo(a).</p>";
    echo "</div>";
    echo "<a href='usuario/index.php'>
    <img src='../fotos/$foto'>
    </a>";
    ?>
    <iframe src="produtos/index.php"></iframe>
    <a href="produtos/index.php">Todos os produtos</a>
    <?php
    if ($tipo != 'g') {
    echo "<a href='lista/index.php'>Minha lista</a>";
    }
    ?>
    <a href="logout.php">Sair</a>
</body>

</html>