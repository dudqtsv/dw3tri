<?php
session_start();
require_once "../conexao.php";
//
if (isset($_GET['id'])) {
    // echo "editar...";

    $id = $_GET['id'];

    require_once "conexao.php";

    $sql = "SELECT * FROM tb_usuario WHERE usuario_id = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'i', $id);
    mysqli_stmt_execute($comando);

    $resultados = mysqli_stmt_get_result($comando);

    $usuario = mysqli_fetch_assoc($resultados);

    $nome = $usuario['usuario_nome'];
    $data_nascimento = $usuario['usuario_datanascimento'];
    $email = $usuario['usuario_email'];
    $senha = $usuario['usuario_senha'];
    $foto = $usuario['usuario_foto'];
}
else {
    // echo "cadastrar...";
    
    $id = 0;
    $nome = "";
    $data_nascimento = "";
    $email = "";
    $senha = "";
    $foto = "";

}
?>
<?php
if (isset($_GET['erro'])) {
    $erro = $_GET['erro'];
} else {
    $erro = 0;
}
if ($erro != 0) {
    echo "<p class='erro-msg'>Não deixe nenhum campo vazio!</p>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../css/form_cadastro.css">

</head>
<body>
    <div>
        <h1>Criar nova conta</h1>
        <form action="salvar_usuario.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <p>Nome</p><input type="text" name="nome" value="<?php echo $nome;?>">
            <p>Data de nascimento</p><input type="date" name="data_nascimento" value="<?php echo $data_nascimento;?>">
            <p>E-mail</p><input type="email" name="email" value="<?php echo $email;?>">
            <p>Senha</p><input type="password" name="senha" value="<?php echo $senha;?>">
            <p>Foto de perfil</p><input type="file" name="foto" value="<?php echo $foto;?>">
            <p><input id="submit" type="submit"></p>
        </form>
    </div>
    <a href="../index.php">Cancelar</a>
</body>
</html>