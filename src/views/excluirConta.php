<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bevan&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&family=Montserrat:wght@400;600&family=Nunito&family=Roboto+Mono&display=swap" rel="stylesheet">
     <!--arquivo css com as cores do projeto-->
     <link rel="stylesheet" href="../../css/colors.css">
    <!--arquivo css para estilizar layout-->
    <link rel="stylesheet" href="../../css/excluir.css">
    <title>Excluir Conta</title>
</head>
<body>
    <main>
        <div class="excluir-container">
            <div class="form form-listar">
    <h1 class="form-title">Excluir Conta</h1>
    <p class="form-text">Tem certeza de que deseja excluir sua conta? Esta ação não pode ser desfeita.</p>

    <?php 
    include '../controllers/excluirContaController.php';
    if ($erroSenha): ?>
        <p class="form-text" style="color: red;">Senha incorreta. Tente novamente.</p>
    <?php endif; ?>

    <form action="" method="post">
        <label for="senha" class="form-text">Digite sua senha para confirmar:</label>
        <input type="password" name="senha" id="senha" required class="form-input">
        <div class="button">
        <button type="submit" class="form-button">Excluir</button>
        <button class="form-button"><a href="site.php" >Cancelar</a></button>
        </div>
    </form>
       </div>
    </div>
</main>
</body>
</html>
