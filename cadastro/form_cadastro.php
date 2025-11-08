<?php
session_start();
require_once "../conexao.php";
//
if (isset($_GET['id'])) {

    // echo "editar...";
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
} else {
    // echo "criar conta...";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
        /* ===== Reset ===== */
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* ===== Fundo da página ===== */
        body {
            background: linear-gradient(135deg, #fdf6e3, #e8f1ff);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 15px;
        }

        /* ===== Formulário ===== */
        form {
            background-color: #fff;
            width: 100%;
            max-width: 420px;
            padding: 35px 30px;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            animation: fadeIn 0.6s ease;
        }

        /* ===== Animação ===== */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ===== Títulos e rótulos ===== */
        h1 {
            text-align: center;
            color: #0b2c66;
            font-weight: 600;
            margin-bottom: 25px;
        }

        form p {
            font-weight: 500;
            color: #0b2c66;
            margin-bottom: 6px;
        }

        /* ===== Campos ===== */
        form input[type="text"],
        form input[type="date"],
        form input[type="email"],
        form input[type="password"],
        form input[type="file"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 18px;
            transition: all 0.3s ease;
            background-color: #fafafa;
        }

        form input:focus {
            border-color: #f1c40f;
            box-shadow: 0 0 6px rgba(241, 196, 15, 0.4);
            outline: none;
        }

        /* ===== Ícone do olho ===== */
        #toggleSenha {
            margin-left: 8px;
            cursor: pointer;
            color: #999;
            transition: color 0.3s ease;
        }

        #toggleSenha:hover {
            color: #f1c40f;
        }

        /* ===== Foto de perfil ===== */
        .img-thumbnail {
            display: block;
            margin: 10px auto;
            border-radius: 50%;
            border: 3px solid #f1c40f;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        /* ===== Botão principal ===== */
        #submit {
            background-color: #0b2c66;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 5px;
        }

        #submit:hover {
            background-color: #133b80;
        }

        /* ===== Link de cancelar ===== */
        a {
            display: block;
            text-align: center;
            color: #d62828;
            font-weight: bold;
            text-decoration: none;
            margin-top: 15px;
            transition: color 0.3s;
        }

        a:hover {
            text-decoration: underline;
            color: #b22222;
        }

        /* ===== Mensagem de erro ===== */
        .erro-msg {
            background: #fff8f8;
            color: #d62828;
            border-left: 6px solid #d62828;
            padding: 12px 15px;
            border-radius: 8px;
            width: 100%;
            max-width: 380px;
            text-align: center;
            font-weight: 500;
            margin: 15px auto;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            animation: shake 0.3s ease;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            50% {
                transform: translateX(5px);
            }

            75% {
                transform: translateX(-5px);
            }
        }

        /* ===== Responsividade ===== */
        @media (max-width: 480px) {
            form {
                padding: 25px 20px;
            }
        }
    </style>

</head>

<body>
    <form action="salvar_usuario.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
        <h1><?= isset($_GET['id']) ? 'Editar Perfil' : 'Criar Nova Conta' ?></h1>
        <p>Nome</p><input type="text" name="nome" value="<?php echo $nome; ?>">
        <p>Data de nascimento</p><input type="date" name="data_nascimento" value="<?php echo $data_nascimento; ?>">
        <p>E-mail</p><input type="email" name="email" value="<?php echo $email; ?>">

        <p>Senha <i class="bi bi-eye-slash" id="toggleSenha"></i></p>
        <input type="password" name="senha" id="senha" value="<?= $senha ?>" required>

        <?php
        if (isset($_GET['id'])) {
            echo "<p>Foto de perfil</p>
            <img src='../fotos/$foto'alt='Foto atual' class='img-thumbnail mb-2' width='120'>
            <input type='file' name='foto'>";
        }
        ?>

        <button type="submit" id="submit">Salvar alterações</button>
        <?php if (isset($_GET['id'])) {
        echo "<a href='../usuario/index.php?id=$id'>Cancelar</a>";
        }
        else {
            echo "<a href='../index.php?id=$id'>Cancelar</a>";
        }
        ?>
    </form>
    </div>


    <!-- olhinhoooooooooo da senha :D -->
    <script>
        const senhaInput = document.getElementById("senha");
        const toggleSenha = document.getElementById("toggleSenha");

        toggleSenha.addEventListener("click", () => {
            const isPassword = senhaInput.type === "password";
            senhaInput.type = isPassword ? "text" : "password";
            toggleSenha.classList.toggle("bi-eye");
            toggleSenha.classList.toggle("bi-eye-slash");
        });
    </script>

</body>

</html>