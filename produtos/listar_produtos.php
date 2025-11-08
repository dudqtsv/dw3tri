<?php
require "../verificarLoginPasta.php";
verificarLogin();
require "../conexao.php";

// Busca todos os produtos
$sql = "SELECT * FROM tb_produto";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_execute($comando);
$resultados = mysqli_stmt_get_result($comando);
$produtos = mysqli_fetch_all($resultados, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produtos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: transparent;
      overflow: hidden;
      padding: 10px;
    }

    /* ===== Container do carrossel ===== */
    .carousel-container {
      width: 100%;
      overflow: hidden;
      position: relative;
      background: transparent;
    }

    /* ===== Faixa rolante ===== */
    .carousel-track {
      display: flex;
      gap: 20px;
      animation: scroll 120s linear infinite;
      width: max-content;
    }

    /* ===== Animação contínua ===== */
    @keyframes scroll {
      0% {
        transform: translateX(0);
      }
      100% {
        transform: translateX(-50%);
      }
    }

    /* ===== Card do produto ===== */
    .produto-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
      text-align: center;
      width: 180px;
      padding: 10px;
      flex-shrink: 0;
      transition: transform 0.3s;
    }

    .produto-card img {
      width: 100%;
      height: 120px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 8px;
    }

    .produto-nome {
      font-weight: 600;
      font-size: 0.9rem;
      color: #0b2c66;
      margin-bottom: 5px;
    }

    .produto-preco {
      color: #28a745;
      font-size: 0.95rem;
      margin: 0;
    }
  </style>
</head>
<body>

<div class="carousel-container">
  <div class="carousel-track">
    <?php if (count($produtos) > 0): ?>
      <?php 
      $loop = array_merge($produtos, $produtos); 
      foreach ($loop as $produto): 
          $nome = htmlspecialchars($produto['produto_nome']);
          $foto = htmlspecialchars($produto['produto_foto']);
          $preco_formatado = number_format($produto['produto_preco'], 2, ',', '.');
      ?>
      <div class="produto-card">
        <img src="../fotos/<?= $foto ?>" alt="<?= $nome ?>">
        <p class="produto-nome"><?= $nome ?></p>
        <p class="produto-preco">R$ <?= $preco_formatado ?></p>
      </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-muted">Nenhum produto cadastrado.</p>
    <?php endif; ?>
  </div>
</div>

</body>
</html>
