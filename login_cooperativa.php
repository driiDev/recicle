<?php
session_start();

require_once "config.php";
include 'Cooperativa.php';

$cooperativa = new Cooperativa($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["user"];
    $password = $_POST["password"];

    $message = $cooperativa->autenticarCooperativa($user, $password);

    if ($message === "Login realizado") {
        $_SESSION["cooperativa_id"] = $cooperativa->getCooperativaId();
        header("Location: coleta.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Cooperativa</title>

    <script>
        // Verifica se a cooperativa está logada e redireciona para a dashboard
        <?php if (isset($_SESSION["cooperativa_id"])): ?>
            window.location.href = "coleta.php";
        <?php endif; ?>
    </script>
</head>
<body>
    <h1>Login Cooperativa</h1>

    <form action="login_cooperativa.php" method="post">
        <input type="text" name="user" id="user" placeholder="Usuário" required>
        <input type="password" name="password" id="password" placeholder="Senha" required>
        <input type="submit" value="Entrar"> <!-- Removido o campo 'name="login"' -->
    </form>

    <?php
    if (isset($message)) {
        echo "<p>$message</p>";
    }
    ?>
</body>
</html>
