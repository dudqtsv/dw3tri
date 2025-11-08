<?php
require 'verificar_login.php';
verificarLogin();

$id = $_SESSION['id'];
$foto = $_SESSION['foto'];
$nome = $_SESSION['nome'];
$tipo = $_SESSION['tipo'];
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Supermercado Imperial</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    html, body {
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
      background-color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    header {
      background: linear-gradient(90deg, #f1c40f, #f39c12);
      padding: 15px 0;
      text-align: center;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    header img {
      height: 150px;
    }

    main {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px;
    }

    .user-card {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      padding: 15px;
      margin: 20px auto;
      width: 90%;
      max-width: 600px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .user-card img {
      border-radius: 50%;
      width: 60px;
      height: 60px;
      object-fit: cover;
      border: 3px solid #f1c40f;
    }

    .user-card a {
      color: #003366;
      text-decoration: none;
      font-weight: 600;
    }

    .user-card a:hover {
      color: #e74c3c;
    }

    iframe {
      width: 100%;
      height: 400px;
      border: none;
      border-radius: 10px;
      margin: 20px 0;
    }

    .btn-imperial {
      background-color: #003366;
      color: white;
      border: none;
      transition: 0.3s;
    }

    .btn-imperial:hover {
      background-color: #e74c3c;
      color: white;
    }

    .links {
      display: flex;
      justify-content: center;
      gap: 10px;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }

    footer {
      text-align: center;
      padding: 15px;
      background-color: #003366;
      color: white;
      margin-top: auto;
    }
  </style>
</head>

<body>

  <header>
    <img src="fotos/logo-imperial.png" alt="Logo do supermercado Imperial">
  </header>

  <main>
    <div class="user-card">
      <div>
        <p class="mb-0">Olá, <a href="usuario/index.php?id=<?=$id?>"><?=$nome?></a>! Seja bem-vindo(a).</p>
      </div>
      <a href="usuario/index.php?id=<?=$id?>">
        <img src="../fotos/<?=$foto?>" alt="Foto do usuário">
      </a>
    </div>

    <iframe src="produtos/listar_produtos.php"></iframe>

    <div class="links">
      <a href="produtos/index.php" class="btn btn-imperial">Todos os produtos</a>

      <?php if ($tipo != 'g'): ?>
        <a href="lista/index.php" class="btn btn-imperial">Minha lista</a>
      <?php else: ?>
        <a href="estoque/index.php" class="btn btn-imperial">Estoque</a>
      <?php endif; ?>

      <a href="logout.php" class="btn btn-danger">Sair</a>
    </div>
  </main>

  <footer>
    &copy; <?=date("Y")?> Supermercado Imperial - Qualidade e economia para você!
  </footer>

</body>

</html>
