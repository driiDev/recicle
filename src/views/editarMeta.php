<?php 
include '../controllers/editarMetaController.php';
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
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/colors.css">
    <link rel="stylesheet" href="../../css/editar.css">
    <title>Editar Meta</title>
</head>
<body>
<header>
                <div class="div-nav">
                    <img class="logo-header" src="../../images/logo.png">
                    <nav>
                    <a class="text-nav" href="inicial.html">Página Inicial</a>
                    <a class="text-nav" href="listarMetas.php">Ver Metas</a>
                    <a class="text-nav" href="cadResiduos.php">Resíduos</a>
                    <a class="text-nav" href="ranking.php">Ranking</a>
                    </nav>
                </div>
            </header>
    <main>
        <div class="meta-container">
                <div class="div div-inicio">
                    <h1 class="div-title">Editar Meta</h1>
                    <!-- Mostrar detalhes da meta -->
                    <p class="div-text">Título: <?= $metaDetalhes['titulo'] ?></p>
                    <p class="div-text">Data Inicial: <?= date('d/m/Y', strtotime($metaDetalhes['data_inicial'])) ?></p>
                    <p class="div-text">Data Final: <?= date('d/m/Y', strtotime($metaDetalhes['data_final'])) ?></p>
                    <p class="div-text">Quantidade desejada: <?= $metaDetalhes['qtd'] . ' ' . $metaDetalhes['unidade']. '(s)' ?></p>

                    <!-- Formulário para edição -->
                    <form action="" method="post" class="div form-meta">
                        <input type="hidden" name="idmeta" value="<?= $metaDetalhes['idmeta'] ?>">
                        <div class="input-container-meta">
                        <label for="qtd_coletada" class="div-text">Quantidade coletada:</label>
                            <input type="number" class="input" name="qtd_coletada" id="qtd_coletada" value="<?= $metaDetalhes['qtd_coletada'];
                             ?>">
                        </div>
                    </form>
                            <button type="submit" class="button">Salvar</button>
                        
                   
            </div>
    </main>
</body>
</html>
