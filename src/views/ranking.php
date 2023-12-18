<?php 
include '../controllers/rankingController.php';
?>

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
    <link rel="stylesheet" href="../../css/ranking.css">

    <title>Ranking de Usuários</title>
</head>
<body>
<header>
        <div class="div-nav">
        <img class="logo-header" src="../../images/logo.png">
        <nav>
            <a class="text-nav" href="inicial.html">Página Inicial</a>
            <a class="text-nav" href="cadMetas.php">Cadastrar Metas</a>
            <a class="text-nav" href="cadResiduos.php">Cadastrar Resíduos</a>
            <a class="text-nav" href="perfil.php">Perfil</a>
        </nav>
        </div>
</header>
    <main>
        <div class="ranking-container">
            <div class="form form-listar">
                <h1 class="title">Ranking de Usuários</h1>

                <table>
                    <tr>
                        <th class="title">Posição</th>
                        <th class="title">Nome</th>
                        <th class="title">Pontuação</th>
                    </tr>

                    <?php
                    $posicao = 1;
                    foreach ($usuariosRanking as $usuario) {
                        echo "<tr>";
                        echo "<td class='text'>{$posicao}</td>";
                        echo "<td class='text'>{$usuario['name']}</td>";
                        echo "<td class='text'>{$usuario['pontos']}</td>";
                        echo "</tr>";
                        $posicao++;
                    }
                    ?>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
