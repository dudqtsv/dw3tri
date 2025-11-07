<?php
require "../verificarLoginPasta.php";
verificarLogin();

$id = $_GET['id'];

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
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h3>Editar Perfil</h3>
<form method="post">
    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" value="<?= $nome ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input type="email" name="email" class="form-control" value="<?= ($_SESSION['email']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Senha</label>
        <input type="text" name="senha" class="form-control" value="<?= ($_SESSION['senha']) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Salvar alterações</button>
    <a href="perfil.php" class="btn btn-secondary">Cancelar</a>
</form>

</body>
</html>
