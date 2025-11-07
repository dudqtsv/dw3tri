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

  <?php if (mysqli_num_rows($resultado) > 0): ?>
    <?php while ($produto = mysqli_fetch_assoc($resultado)): ?>
      <?php
      $produto_id = $produto['produto_id'];
      $nome = $produto['produto_nome'];
      $preco = $produto['produto_preco'];
      $foto = $produto['produto_foto'];
      $preco_formatado = number_format(round($preco, 2), 2, ',', '.');
      ?>

      <div class="card">
        <img src="../fotos/<?= htmlspecialchars($foto) ?>" class="card-img-top" alt="<?= htmlspecialchars($nome) ?>">
        <div class="card-body">
          <p class="card-text"><?= htmlspecialchars($nome) ?> - R$<?= $preco_formatado ?></p>
        </div>
      </div>

    <?php endwhile; ?>
  <?php else: ?>
    <p class="mensagem-vazia">Nenhum produto encontrado.</p>
  <?php endif; ?>

</body>
</html>
