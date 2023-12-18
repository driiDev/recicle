<?php
session_start();

include_once '../config/config.php';
include '../models/Usuario.php';

$usuario = new Usuario($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $message = $usuario->cadastrarUsuario($name, $email, $password);

        // Adicione aqui qualquer lógica específica para o cadastro
        // Por exemplo, você pode redirecionar o usuário para a tela de login após o cadastro.
        if ($message === "Usuário cadastrado com sucesso") {
            echo "<script>alert('$message'); window.location.href = '../index.php';</script>";
        } else {
            echo "<script>alert('$message');</script>";
        }

    } elseif (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $message = $usuario->autenticarUsuario($email, $password);

        if ($message === "Login realizado") {
            $_SESSION["loggedin"] = true;
            header("Location: ../views/inicial.html");
            exit;
        } elseif (isset($message)) {
            echo "<script>alert('$message'); window.location.href = '../index.php';</script>";
        }
    }
}
?>
