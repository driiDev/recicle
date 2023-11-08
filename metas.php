<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metas</title>
</head>
<body>
<h1>Cadastrar Nova Meta</h1>
    <form action="cadMetas.php" method="post">
        <input type="text" name="titulo" id="titulo" placeholder="Título" required> <br>
        <input type="number" name="qtd" id="qtd" placeholder="Quantidade" required> <br>
        <input type="date" name="data_inicial" id="data_inicial" placeholder="Período inicial" required>
        <input type="date" name="data_final" id="data_final" placeholder="Período final" required>
        <input type="submit" value="Cadastrar">
    </form>
    
</body>
</html>