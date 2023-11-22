<?php
session_start();

//$_SESSION["loggedin"] = true;
//header("location: site.php");

require_once "config.php"; // Configuração do banco de dados
include 'Usuario.php';


$usuario = new Usuario($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $message = $usuario->cadastrarUsuario($name, $email, $password);
    } elseif (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $message = $usuario->autenticarUsuario($email, $password);

        if ($message === "Login realizado") {
            $_SESSION["loggedin"] = true;
            header("Location: site.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <script>
        // Verifica se o usuário está logado e redireciona para site.php
        <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
            window.location.href = "site.php";
        <?php endif; ?>
    </script>
</head>
<body>
    <h1>Login</h1>

    <form action="index.php" method="post">
        <input type="email" name="email" id="email" placeholder="Email" required>
        <input type="password" name="password" id="password" placeholder="Senha" required>
        <input type="submit" name="login" value="Entrar">
    </form>
    <br>
    <a href="cadastrar.php">Ainda não tem conta?</a><br>
    <a href="login_cooperativa.php">É coopetariva?</a>

    <?php
    if (isset($message)) {
        echo "<p>$message</p>";
    }
    ?>
</body>
</html>