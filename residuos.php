<?php 
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: index.php"); // Redireciona para a página de login
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resíduos</title>
</head>
<body>
<h1>Cadastro de Resíduo Descartado</h1>
    <form action="cadResiduos.php" method="post">
        <input type="text" name="tiporesiduo" id="tiporesiduo" placeholder="Tipo de Resíduo" required> <br>
        <input type="number" name="qtd" id="qtd" placeholder="Quantidade" required> <br>
        <label for="destinacao">Destinação:</label>
        <select name="destinacao" id="destinacao">
            <option value="porta_a_porta">Porta a Porta</option>
            <option value="ja_encaminhado">Já Encaminhado para Outra Destinação</option>
        </select><br>        
        <input type="submit" value="Cadastrar">
    </form>
    <br>
    <a href="site.php">Voltar</a>

</body>
</html>