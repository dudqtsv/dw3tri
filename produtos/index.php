<?php
require "../verificar_login.php";
verificarLogin();
$tipo = $_SESSION['tipo'];
//
$busca = "";
if (isset($_GET['busca'])) {
    $busca = trim($_GET['busca']);
}
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
    <form method="get" class="pesquisa" action="#resultados">
        <input type="text" name="busca" placeholder="Pesquisar produto..." value="<?= htmlspecialchars($busca) ?>">
        <input type="submit" value="Buscar">
    </form>

    <div id="resultados">
        <?php while ($produto = mysqli_fetch_assoc($resultado)): ?>
            <div class="produto">
                <h3><?= htmlspecialchars($produto['produto_nome']) ?></h3>
                <!-- Exiba outras informações do produto aqui -->
            </div>
        <?php endwhile; ?>
    </div>

<script>
    window.addEventListener('load', function() {
        // Verifica se existe uma âncora na URL
        if (window.location.hash) {
            setTimeout(function() {
                // Encontra o elemento com o ID correspondente à âncora (como #resultados)
                var targetElement = document.querySelector(window.location.hash);
                
                if (targetElement) {
                    // Ajuste a rolagem para levar em conta a altura do cabeçalho fixo
                    var offset = 70;  // Ajuste para a altura do seu cabeçalho fixo

                    // Utiliza scrollIntoView() com um pequeno ajuste para o offset
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'  // Certifica-se que o elemento fique no topo da tela
                    });

                    // Corrige o deslocamento da rolagem
                    window.scrollBy(0, -offset); // Desloca um pouco para cima, compensando o cabeçalho
                }
            }, 100);  // Espera um pequeno tempo para garantir que o elemento foi encontrado
        }
    });
</script>



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
            echo "<a href='deletar_produto.php?id=$produto_id'><img src='../fotos/delete-button.png' width='20px'></a>";
        }
    }
    echo "</div>";
    echo "</div>";
    ?>
</body>

</html>