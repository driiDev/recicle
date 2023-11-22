<?php
require_once "config.php"; // Configuração do banco de dados
include 'Usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $usuario = new Usuario($conn);
    if ($usuario->cadastrarUsuario($name, $email, $password)) {
        // Usuário criado com sucesso
        echo "<script>alert('Usuário criado com sucesso.'); window.location.href = 'index.php';</script>";
    } else {
        // Erro ao criar o usuário
        echo "<script>alert('Erro ao criar o usuário.'); window.location.href = 'cadastro.php';</script>";
    }
}
?>
