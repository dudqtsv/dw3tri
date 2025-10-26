<?php
    $servidor = "db";
    $usuario = "root";
    $senha = "123";  
    $banco = "supermercado";
    
    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

    if (!$conexao) {
    die("Conexão falhou: " . mysqli_connect_error());
}