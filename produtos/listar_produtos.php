<?php
require "../verificarLoginPasta.php";
verificarLogin();
$tipo = $_SESSION['tipo'];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Produtos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      padding: 20px;
    }

    .pesquisa {
      margin-bottom: 20px;
    }

    .card {
      width: 10rem;
      margin: 10px;
      display: inline-block;
      vertical-align: top;
    }

    .card img {
      height: 100px;
      object-fit: cover;
    }

    .mensagem-vazia {
      font-size: 1.1em;
      color: #666;
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <?php
  $sql = "SELECT * FROM tb_produto;";
  $comando = mysqli_prepare($conexao, $sql);

  mysqli_stmt_execute($comando);

  $resultados = mysqli_stmt_get_result($comando);

while ($produto = mysqli_fetch_assoc($resultados)) {
    $produto_id = $produto['produto_id'];
    $nome = htmlspecialchars($produto['produto_nome']);
    $preco = $produto['produto_preco'];
    $foto = htmlspecialchars($produto['produto_foto']);
    $preco_formatado = number_format(round($preco, 2), 2, ',', '.');

    echo "<div class='card'>";
    echo "<img src='../fotos/$foto' class='card-img-top' alt='$nome'>";
    echo "<div class='card-body'>
            <p class='card-text'>$nome - R$ $preco_formatado</p>
          </div>
        </div>";
}

  ?>



</body>

</html>