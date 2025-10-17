    <?php
    require_once "conexao.php";
    session_start();

    $sql = "SELECT * FROM tb_usuario;";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_execute($comando);
    $resultados = mysqli_stmt_get_result($comando);

    while ($usuario = mysqli_fetch_assoc($resultados)) {
        $foto = $usuario['usuario_foto'];
        $nome = $usuario['usuario_nome'];
    }

    echo "<div>";
    echo "<p>Olá $nome! Seja bem vindo(a).</p>";
    echo "</div>";
    ?>