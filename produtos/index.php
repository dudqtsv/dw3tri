<?php
require "../verificarLoginPasta.php";
verificarLogin();
$tipo = $_SESSION['tipo'];

// Variável de busca
$busca = "";
if (isset($_GET['busca'])) {
    $busca = trim($_GET['busca']);
}

// Monta o SQL com ou sem busca
if ($busca != "") {
    $sql = "SELECT * FROM tb_produto WHERE produto_nome LIKE ?";
    $comando = mysqli_prepare($conexao, $sql);
    $param = "%" . $busca . "%";
    mysqli_stmt_bind_param($comando, "s", $param);
} else {
    $sql = "SELECT * FROM tb_produto";
    $comando = mysqli_prepare($conexao, $sql);
}

mysqli_stmt_execute($comando);
$resultado = mysqli_stmt_get_result($comando);
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
    <h2>Lista de produtos</h2>
    <?php if ($tipo != 'c') {
        echo "<a href='form_produto.php'>Adicionar produto</a>";
        echo "<a href='../home.php'>Voltar</a>";
    } else {
        echo "<a href='../home.php'>Voltar</a>";
    }
    ?>

    <!-- Formulário de busca -->
    <form method="get" class="pesquisa" action="#resultados">
        <input type="text" name="busca" placeholder="Pesquisar produto..."
            value="<?= htmlspecialchars($busca) ?>">
        <input type="submit" value="Buscar">
    </form>

    <!-- Resultados -->
    <div id="resultados">
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
                    <div class="card-body">
                        <p class="card-text"><?= htmlspecialchars($nome) ?> - R$<?= $preco_formatado ?></p>
                        <img src="../fotos/<?= htmlspecialchars($foto) ?>" class="card-img-top" alt="<?= htmlspecialchars($nome) ?>">

                        <?php if ($tipo != 'c'): ?>
                            <a href="form_produto.php?acao=editar&id=<?= $produto_id ?>">Editar</a>
                            <a href="deletar_produto.php?id=<?= $produto_id ?>">
                                <img src="../fotos/delete-button.png" width="30px" alt="Excluir">
                            </a>
                        <?php endif; ?>

                        <?php if ($tipo != 'g'): ?>
                            <a href="../lista/addLista.php?id=<?= $produto_id ?>">
                                <img src="../fotos/addLista.png" width="30px" alt="Adicionar à lista">
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="mensagem-vazia">Nenhum produto encontrado.</p>
        <?php endif; ?>
    </div>

    <script>
        window.addEventListener('load', function() {
            if (window.location.hash) {
                setTimeout(function() {
                    var targetElement = document.querySelector(window.location.hash);
                    if (targetElement) {
                        var offset = 70;
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                        window.scrollBy(0, -offset);
                    }
                }, 100);
            }
        });
    </script>
</body>

</html>