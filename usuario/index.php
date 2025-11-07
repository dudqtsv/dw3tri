<?php
require "../verificarLoginPasta.php";
verificarLogin();

$sql = "SELECT * FROM tb_usuario WHERE usuario_id = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'i', $_GET['id']);
    mysqli_stmt_execute($comando);
    $resultados = mysqli_stmt_get_result($comando);
    $usuario = mysqli_fetch_assoc($resultados);

    $nome = $usuario['usuario_nome'];
    $datanascimento = $usuario['usuario_datanascimento'];
    $email = $usuario['usuario_email'];
    $senha = $usuario['usuario_senha'];
    $tipo = $usuario['usuario_tipo'];
    $foto = $usuario['usuario_foto'];
    $id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f5f6fa;
            padding: 40px;
        }
        .profile-card {
            max-width: 450px;
            margin: auto;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
            text-align: center;
        }
        .profile-header {
            background: linear-gradient(135deg, #007bff, #00b4d8);
            color: white;
            padding: 30px 20px;
        }
        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid white;
            margin-top: -60px;
            background-color: #fff;
            object-fit: cover;
        }
        .profile-body {
            padding: 25px;
        }
        .info-item {
            text-align: left;
            margin-bottom: 10px;
        }
        .info-item strong {
            color: #555;
        }
        .btn-edit {
            background-color: #007bff;
            color: white;
        }
        .btn-edit:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

<div class="profile-card">
    <div class="profile-header">
        <h3>'              '</h3>
    </div>
    <img src="../fotos/<?= htmlspecialchars($usuario['foto']) ?>" alt="Foto de perfil" class="profile-img">

    <div class="profile-body">
        <h4><?= htmlspecialchars($usuario['nome']) ?></h4>
        <p class="text-muted mb-3"><?= htmlspecialchars($usuario['email']) ?></p>

        <div class="info-item"><strong>Tipo de usuário:</strong> 
            <?= ($usuario['tipo'] == 'g') ? 'Gerente' : (($usuario['tipo'] == 'c') ? 'Cliente' : 'Funcionário') ?>
        </div>

        <div class="info-item"><strong>Data de cadastro:</strong> 
            <?= htmlspecialchars(date('d/m/Y', strtotime($usuario['data_cadastro']))) ?>
        </div>

        <hr>
        <a href="editarPerfil.php?id=<? $id ?>" class="btn btn-edit btn-sm w-100">Editar perfil</a>
        <a href="../home.php" class="btn btn-secondary btn-sm w-100 mt-2">Voltar</a>
    </div>
</div>

</body>
</html>
