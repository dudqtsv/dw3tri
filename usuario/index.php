<?php
require "../verificarLoginPasta.php";
verificarLogin();

$id = $_GET['id'];

$sql = "SELECT * FROM tb_usuario WHERE usuario_id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$usuario = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

$nome = $usuario['usuario_nome'];
$data_nascimento = $usuario['usuario_datanascimento'];
$email = $usuario['usuario_email'];
$senha = $usuario['usuario_senha'];
$foto = $usuario['usuario_foto'];

if (!$usuario) die("Usuário não encontrado.");
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Meu Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f6fa;
            padding: 40px;
        }

        .profile-card {
            max-width: 450px;
            margin: auto;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            overflow: hidden;
        }

        .profile-header {
            background: linear-gradient(135deg, #007bff, #00b4d8);
            color: #fff;
            padding: 30px 20px;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #fff;
            margin-top: -60px;
            object-fit: cover;
            background: #fff;
        }

        .profile-body {
            padding: 25px;
        }

        .info-item {
            text-align: left;
            margin-bottom: 10px;
        }

        .btn-edit {
            background: #007bff;
            color: #fff;
        }

        .btn-edit:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
    <div class="profile-card">
        <div class="profile-header">
            <h3>Headeeeer</h3>
        </div>

        <img src="../fotos/<?= htmlspecialchars($usuario['usuario_foto'] ?: 'default.png') ?>"
            alt="Foto de perfil" class="profile-img">

        <div class="profile-body">
            <h4><?= htmlspecialchars($usuario['usuario_nome']) ?></h4>
            <p class="text-muted mb-3"><?= htmlspecialchars($usuario['usuario_email']) ?></p>

            <div class="info-item"><strong>Tipo de usuário:</strong>
                <?= match ($usuario['usuario_tipo']) {
                    'g' => 'Gerente',
                    'c' => 'Cliente',
                    default => 'Funcionário'
                } ?>
            </div>

            <div class="info-item"><strong>Data de nascimento:</strong>
                <?= date('d/m/Y', strtotime($data_nascimento)) ?>

            </div>

            <hr>
            <a href="../cadastro/form_cadastro.php?id=<?= $id ?>" class="btn btn-edit btn-sm w-100">Editar perfil</a>

            <a href="../home.php" class="btn btn-secondary btn-sm w-100 mt-2">Voltar</a>
        </div>
    </div>
</body>

</html>