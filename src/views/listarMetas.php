<?php 
include '../controllers/listarMetasController.php';
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
    <link rel="stylesheet" href="../../css/listarMetas.css">
    <title>Metas</title>
</head>
<body>
<header>
        <div class="div-nav">
        <img class="logo-header" src="../../images/logo.png">
        <nav>
            <a class="text-nav" href="inicial.html">Página Inicial</a>
            <a class="text-nav" href="cadMetas.php">Cadastrar Metas</a>
            <a class="text-nav" href="cadResiduos.php">Cadastrar Resíduos</a>
            <a class="text-nav" href="ranking.php">Ranking</a>
        </nav>
        </div>
</header>
    <main>
    <div class="meta-container">
    <div class="form form-listar">
    
    <?php
    echo '<h1>Metas Cadastradas</h1>';
    if (!empty($metas)) {
        foreach ($metas as $meta) {
            // Formatar as datas
            $dataInicialFormatada = date('d/m/Y', strtotime($meta['data_inicial']));
            $dataFinalFormatada = date('d/m/Y', strtotime($meta['data_final']));

            // Calcular a porcentagem de conclusão da meta
            $porcentagemConcluida = ($meta['qtd_coletada'] / $meta['qtd']) * 100;
            // Exibir as informações da meta
            echo "<p class='form-text'>" . $meta['titulo'] . "</p>";
            echo "<p class='form-text'>" . $dataInicialFormatada . " a  $dataFinalFormatada" . "</p>";
            echo "<p class='form-text'>Porcentagem concluída: " . number_format($porcentagemConcluida) . "%</p><br>";
            echo "<button class='form-button' onclick=\"location.href='editarMeta.php?id=" . $meta['idmeta'] . "'\">Editar</button>";
            echo "<br>";
            echo "<button class='form-button' onclick=\"if(confirm('Tem certeza que deseja excluir esta meta?')){ location.href='../controllers/excluirMetaController.php?id=" . $meta['idmeta'] . "'; }\">Excluir</button>";
            echo "<br>";

            // Verifica se a meta foi concluída
            if ($porcentagemConcluida == 100) {
                $recompensa = new Recompensa($conn);
            
                // Verifica se a recompensa já foi escolhida
                if ($meta['recompensa_id']) {
                    // Busca a descrição da recompensa escolhida
                    $recompensaEscolhida = $recompensa->getRecompensaById($meta['recompensa_id']);
                    echo "<p class='form-text'>Você já escolheu uma recompensa: " . $recompensaEscolhida['descricao'] . "</p>";
                } else {
                    // Se ainda não escolheu a recompensa, exibe o formulário
                    $opcoesRecompensas = $recompensa->listarRecompensas();
            
                    echo "<p class='form-text'>Parabéns! Você atingiu a meta. Escolha uma recompensa:</p>";
                    echo "<form action='../controllers/processarRecompensaController.php' method='post'> <br>";
                    echo "<input type='hidden' name='meta_id' value='" . $meta['idmeta'] . "'>";
                    echo "<select name='id_recompensa'>";
                    foreach ($opcoesRecompensas as $opcao) {
                        echo "<option value='" . $opcao['id'] . "'>" . $opcao['descricao'] . "</option>";
                    }
                    echo "</select>";
                    echo "<button class='form-button'>Escolher</button>";
                    echo "</form>";
                }
            }
             echo '<hr>';// linha para separar as metas
        }
    } else {
        echo "<p>Nenhuma meta cadastrada.</p>";
    }
    ?>

    </div>
    </div>
    </main>

</body>
</html>
