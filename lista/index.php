<?php
require "../verificarLoginPasta.php";
verificarLogin();

$usuario_id = $_SESSION['usuario_id'];
$tipo = $_SESSION['tipo'];

$sql = "SELECT tb_produto.produto_id, tb_produto.produto_nome, tb_produto.produto_preco, tb_produto.produto_foto, tb_categoria.categoria_nome 
        FROM tb_lista
        INNER JOIN tb_produto ON tb_lista.produto_id = tb_produto.produto_id
        INNER JOIN tb_categoria ON tb_produto.categoria_id = tb_categoria.categoria_id
        WHERE tb_lista.usuario_id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $usuario_id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Minha Lista de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body { padding: 20px; background-color: #f8f9fa; }
        .card { width: 12rem; margin: 10px; display: inline-block; vertical-align: top; }
        .card img { height: 120px; object-fit: cover; }
        h2 { margin-bottom: 20px; }
        .total { font-size: 1.2em; margin-top: 20px; }
    </style>
</head>
<body>
    <h2> Minha Lista de Compras</h2>
    <a href="../home.php" class="btn btn-secondary btn-sm">Voltar</a>
    <a href="../produtos/index.php" class="btn btn-primary btn-sm">Ver Produtos</a>

    <hr>

    <div>
        <?php 
        $total = 0;
        if (mysqli_num_rows($resultado) > 0): 
            while ($produto = mysqli_fetch_assoc($resultado)): 
                $total += $produto['produto_preco'];
        ?>
                <div class="card shadow-sm">
                    <img src="../fotos/<?= htmlspecialchars($produto['produto_foto']) ?>" 
                         class="card-img-top" 
                         alt="<?= htmlspecialchars($produto['produto_nome']) ?>">
                    <div class="card-body">
                        <p class="card-text fw-bold"><?= htmlspecialchars($produto['produto_nome']) ?></p>
                        <p>R$ <?= number_format($produto['produto_preco'], 2, ',', '.') ?></p>
                        <small class="text-muted"><?= htmlspecialchars($produto['categoria_nome']) ?></small><br>
                        <a href="removerLista.php?id=<?= $produto['produto_id'] ?>" 
                           class="btn btn-sm btn-danger mt-2">Remover</a>
                    </div>
                </div>
        <?php 
            endwhile;
        ?>
        <div class="total">
            <strong>Total:</strong> R$ <?= number_format($total, 2, ',', '.') ?>
        </div>
        <?php else: ?>
            <p>Sua lista de compras está vazia :/</p>
            <a href="../produtos/index.php">Adicionar produtos</a>!
        <?php endif; ?>
    </div>
</body>
</html>
