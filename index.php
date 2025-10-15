<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <nav><h1>Supermercado Imperial</h1></nav>
    <form action="cadastro/login.php" method="post">
        <h1>Login</h1>
        <p>E-mail</p><input type="text" name="email" required>
        <p>Senha</p><input type="password" name="senha" required>
        <p><input type="submit" id="submit" value="Entrar"></p>
        <p>Ainda não possui um acesso?
        <a href="cadastro/form_cadastro.php">Cadastre-se</a>!</p>
    </form>
</body>
</html>