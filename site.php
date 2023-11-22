<?php
session_start();

require_once "config.php";

// Verificar se o usuário está logado
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: index.php");
    exit;
}

function logout() {
    unset($_SESSION["loggedin"]);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recicle+</title>
</head>
<body>
    <h1>BEM-VINDO(A)</h1>
    <br>
    <a href="perfil.php">Visualize seu perfil aqui</a>

    <div>
        <h2>CADASTRO DE METAS</h2>
        <p>Deseja cadastrar uma meta? <a href="metas.php">Clique aqui</a></p>
        <h3>Deseja visualizar suas metas?</h3>
        <a href="listarMetas.php">Visualize aqui</a>
    </div>
    <br>
    <div>
        <h2>CADASTRO DE RESÍDUOS</h2>
        <p>Deseja cadastrar um resíduo? <a href="residuos.php">Clique aqui</a></p>
    </div>
    <div>
        <h2>O ATO DE RECICLAR</h2>
        <a href="pesquisarReciclaveis.php">Veja aqui os recicláveis</a>
    </div>
    <p>Deseja sair?</p>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="submit" name="logout" value="logout">
    </form>

    <?php 
    if (isset($_POST["logout"])) {
        logout();
    }
    ?>
</body>
</html>
