<?php
require_once "config.php"; // Configuração do banco de dados
include 'Usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $usuario = new Usuario($conn);
    if ($usuario->cadastrarUsuario($name, $email, $password)) {
        echo "Usuário criado com sucesso";
    } else {
        echo "Erro ao criar o usuário.";
    }
}
?>
