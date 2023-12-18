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
    <link rel="stylesheet" href="../../css/listarResiduos.css">

    <title>Lista de Resíduos</title>
</head>
<body>
<header>
        <div class="div-nav">
        <img class="logo-header" src="../../images/logo.png">
        <nav>
            <a class="text-nav" href="inicial.html">Página Inicial</a>
            <a class="text-nav" href="cadMetas.php">Cadastrar Resíduos</a>
            <a class="text-nav" href="cadResiduos.php">Cadastrar Metas</a>
            <a class="text-nav" href="ranking.php">Ranking</a>
        </nav>
        </div>
</header>
    <main>
        <div class="residuo-container">
            <div class="form form-listar">
                <h1>Lista de Resíduos</h1>

                <?php
                include '../controllers/listarResiduosController.php';

                if (!empty($residuos)) {
                    // Exiba os resíduos
                    foreach ($residuos as $residuo) {
                        echo "<p class='form-text'>Tipo de Resíduo: " . $residuo['tiporesiduo'] . "</p>";
                        echo "<p class='form-text'>Quantidade: " . $residuo['qtd'] . " " . $residuo['unidade'] . "</p>";
                        echo "<p class='form-text'>Tempo de Decomposição: " . $residuo['tempo_decomposicao'] . "</p>";
                        echo "<p class='form-text'>Classificação: " . $residuo['classificacao'] . "</p>";
                        echo "<p class='form-text'>Destinação: " . $residuo['destinacao'] . "</p>";
                        echo "<br>";
                        echo "<button class='form-button' onclick=\"if(confirm('Tem certeza que deseja excluir este resíduo?')){ location.href='../controllers/excluirResiduoController.php?id=" . $residuo['idresiduo'] . "'; }\">Excluir</button>";
                        echo "<br>";
                        echo "<hr>";
                    }
                } else {
                    // Exiba uma mensagem se não houver resíduos
                    echo "Não há resíduos cadastrados.";
                }
                ?>

            </div>
        </div>
    </main>

</body>
</html>
