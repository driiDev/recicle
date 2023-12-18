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
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/colors.css">
    <link rel="stylesheet" href="../../css/main.css">
    <title>Detalhes do Resíduo</title>
</head>
<body>
<header>
                <div class="div-nav">
                    <img class="logo-header" src="../../images/logo.png">
                    <nav>
                    <a class="text-nav" href="inicial.html">Página Inicial</a>
                    <a class="text-nav" href="listarMetas.php">Ver Resíduos</a>
                    <a class="text-nav" href="cadResiduos.php">Cadastrar Metas</a>
                    <a class="text-nav" href="ranking.php">Ranking</a>
                    </nav>
                </div>
            </header>
    <main>
        <div class="residuo-container">
            <div class="form-container">
                <form class="form form-inicio">
                    <img class="logo" src="../../images/logo.png">
                    <a href="../../src/views/cadResiduos.php" class="form-link-ini">Cadastrar outro resíduo</a>
                </form>

                <div class="form form-residuo">
                    <?php
                    $mensagem = isset($_GET['mensagem']) ? $_GET['mensagem'] : '';
                    echo "<h2 class='form-title'>PARABÉNS!!</h2>";
                    echo "<p class='form-text'>$mensagem</p>";
                    ?>
                    <input type="button" value="Ver Resíduos" class="form-button">
                </div>
            </div>
        </div>
    </main>
</body>
</html>
