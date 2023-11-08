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
        <input type="text" name="destinacao" id="destinacao" placeholder="Destinação">
        <input type="submit" value="Cadastrar">
    </form>
    
</body>
</html>