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
    <title>Metas</title>
    <script>
        function validarDatas() {
            let dataInicial = document.getElementById('data_inicial').value;
            let dataFinal = document.getElementById('data_final').value;

            if (dataInicial > dataFinal) {
                alert('A data inicial deve ser menor que a data final.');
                return false; // Impede o envio do formulário
            }
            return true; // Permite o envio do formulário
        }
    </script>
</head>
<body>
<h1>Cadastrar Nova Meta</h1>
    <form action="cadMetas.php" method="post" onsubmit="return validarDatas()">
        <input type="text" name="titulo" id="titulo" placeholder="Título" required> <br>
        <input type="number" name="qtd" id="qtd" placeholder="Quantidade" required> <br>
        <input type="date" name="data_inicial" id="data_inicial" placeholder="Período inicial" required> a
        <input type="date" name="data_final" id="data_final" placeholder="Período final" required>
        <input type="submit" value="Cadastrar">
    </form>
    <a href="site.php">Voltar</a>
</body>
</html>