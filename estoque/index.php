<?php
require "../verificarLoginPasta.php";
verificarLogin();
$tipo = $_SESSION['tipo'];

if ($tipo != 'g') {
    header('Location: ../index.php');
    exit;
}

require "../conexao.php";

// Barra de busca
$busca = "";
if (isset($_GET['busca'])) {
    $busca = trim($_GET['busca']);
}

// SQL com ou sem filtro de busca
if ($busca != "") {
    $sql = "SELECT tb_produto.produto_id, tb_produto.produto_nome, tb_categoria.categoria_nome, tb_estoque.estoque_qtd, tb_estoque.estoque_data, tb_produto.produto_foto
            FROM tb_produto 
            INNER JOIN tb_categoria ON tb_produto.categoria_id = tb_categoria.categoria_id
            INNER JOIN tb_estoque ON tb_produto.produto_id = tb_estoque.produto_id
            WHERE tb_produto.produto_nome LIKE ?
            ORDER BY tb_produto.produto_nome ASC";
    $comando = mysqli_prepare($conexao, $sql);
    $param = "%" . $busca . "%";
    mysqli_stmt_bind_param($comando, "s", $param);
} else {
    $sql = "SELECT tb_produto.produto_id, tb_produto.produto_nome, tb_categoria.categoria_nome, tb_estoque.estoque_qtd, tb_estoque.estoque_data, tb_produto.produto_foto
            FROM tb_produto
            INNER JOIN tb_categoria ON tb_produto.categoria_id = tb_categoria.categoria_id
            INNER JOIN tb_estoque ON tb_produto.produto_id = tb_estoque.produto_id
            ORDER BY tb_produto.produto_nome ASC";
    $comando = mysqli_prepare($conexao, $sql);
}

mysqli_stmt_execute($comando);
$resultados = mysqli_stmt_get_result($comando);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/estoque.css">
    <title>Controle de Estoque</title>
</head>

<body>
    <nav>
        <h1>Controle de Estoque</h1>
        <form method="get">
            <input type="text" name="busca" placeholder="Buscar produto..." value="<?php echo htmlspecialchars($busca); ?>">
            <button type="submit">Pesquisar</button>
        </form>
        <a class="btn-voltar" href="../home.php">Voltar</a>
    </nav>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Produto</th>
                    <th>Categoria</th>
                    <th>Quantidade</th>
                    <th>Última Atualização</th>
                    <th>Edição</th>
                    <th>Deletar</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($produto = mysqli_fetch_assoc($resultados)) { ?>
                    <tr>
                        <td><img src="../fotos/<?php echo $produto['produto_foto']; ?>" alt="Foto" width="50"></td>
                        <td><?php echo htmlspecialchars($produto['produto_nome']); ?></td>
                        <td><?php echo htmlspecialchars($produto['categoria_nome']); ?></td>
                        <td><?php echo $produto['estoque_qtd']; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($produto['estoque_data'])); ?></td>
                        <td>
                            <a class="editar" href="../produtos/form_produto.php?id=<?php echo $produto['produto_id']; ?>">Editar</a>
                        </td>
                        <td>
                            <a class="deletar" href="../produtos/deletar_produto.php?id=<?php echo $produto['produto_id']; ?>">Deletar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>

</html>