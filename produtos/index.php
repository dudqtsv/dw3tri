<?php
    require "../verificar_login.php";
    verificarLogin();
    $tipo = $_SESSION['tipo'];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
<body>
    <h2>Lista de produtos</h2> <a href="form_produto.php">Adicionar produto</a>

    <?php

    $sql = "SELECT * FROM tb_produto";
    
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);

    $resultados = mysqli_stmt_get_result($comando);

    while ($produtos = mysqli_fetch_assoc($resultados)) {
        $produto_id = $produtos['produto_id'];
        $nome = $produtos['produto_nome'];
        $preco = $produtos['produto_preco'];
        $categoria_id = $produtos['categoria_id'];
        $foto = $produtos['produto_foto'];

        $preco_arredondado = round($preco, 2);
        $preco_formatado = number_format($preco_arredondado, 2, '.', '');

         echo "<div class='card' style='width: 10rem;'>";
                echo "<img src='../fotos/$foto' class='card-img-top'>";
                echo "<div class='card-body'>";
                echo "<p class='card-text'>$nome - R$$preco_formatado</p>";
                if ($tipo != 'c') {
                    echo "<a href='form_produto.php?acao=editar'>Editar</a>";
                }
        echo "</div>";
    }
    ?>
</body>

</html>