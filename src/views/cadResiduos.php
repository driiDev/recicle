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
    <!--arquivo css para padronizar o todo-->
    <link rel="stylesheet" href="../../css/reset.css">
    <!--arquivo css com as cores do projeto-->
    <link rel="stylesheet" href="../../css/colors.css">
    <!--arquivo css para estilizar layout-->
    <link rel="stylesheet" href="../../css/main.css">
    <title>Cadastrar Resíduo</title>
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
                    <a href="../../src/views/listarResiduos.php" class="form-link-ini">Ver resíduos cadastrados</a>
        </form>

        <form class="form form-residuo" action="../controllers/cadResiduosController.php" method="post">
            <h2 class="form-title">CADASTRAR RESÍDUO</h2>
            <div class="form-input-container-residuo">
            <select name="tiporesiduo" id="tiporesiduo" required class="form-input">

            <option value="" disabled selected>Selecione um tipo de resíduo</option>
            <option value="Baldes de plástico">Baldes de plástico</option>
            <option value="Brinquedos de plástico">Brinquedos de plástico</option>
            <option value="Caixas de leite">Caixas de leite</option>
            <option value="Cacos de vidro">Cacos de vidro</option>
            <option value="Caneta (Sem a tinta)">Caneta (Sem a tinta)</option>
            <option value="Canos e Tubos de PVC">Canos e Tubos de PVC</option>
            <option value="Canudo de plástico">Canudo de plástico</option>
            <option value="Chinelos">Chinelos</option>
            <option value="Copos de plástico">Copos de plástico</option>
            <option value="Copos de vidro">Copos de vidro</option>
            <option value="Embalagens de margarina">Embalagens de margarina</option>
            <option value="Embalagens de papel">Embalagens de papel</option>
            <option value="Embalagens de produto de limpeza plásticos">Embalagens de produto de limpeza plásticos</option>
            <option value="Embalagens Pet">Embalagens Pet</option>
            <option value="Embalagens plásticas">Embalagens plásticas</option>
            <option value="Frascos de produtos plásticos">Frascos de produtos plásticos</option>
            <option value="Garrafas de plástico">Garrafas de plástico</option>
            <option value="Garrafas de vidro">Garrafas de vidro</option>
            <option value="Jornais e Revistas">Jornais e Revistas</option>
            <option value="Latas de Alumínio">Latas de Alumínio</option>
            <option value="Outros tipos de Papel">Outros tipos de Papel</option>
            <option value="Outros tipos de Plástico">Outros tipos de Plástico</option>
            <option value="Outros tipos de Metal">Outros tipos de Metal</option>
            <option value="Papelão">Papelão</option>
            <option value="Pneus">Pneus</option>
            <option value="Pregos">Pregos</option>
            <option value="Sacolas e sacos">Sacolas e sacos</option>
            <option value="Talheres de metal">Talheres de metal</option>
            <option value="Óleo de cozinha">Óleo de cozinha</option>
            <option value="Cacos de vidro">Cacos de vidro</option>
        </select>

        <input type="number" name="qtd" id="qtd" placeholder="Quantidade" required class="form-input">

        <select name="unidade" class="form-input">
            <option value="" disabled selected>Escolha a unidade</option>
            <option value="kg">Kg</option>
            <option value="unidade">Unidade</option>
        </select>

        <select name="destinacao" id="destinacao" class="form-input">
            <option value="" disabled selected>Destinação</option>
            <option value="porta_a_porta">Porta a Porta</option>
            <option value="ja_encaminhado">Já Encaminhado para Outra Destinação</option>
        </select><br>

        <input type="submit" value="Cadastrar" class="form-button">
    </form>
        </div>
    </div>
</main>
    <br>
    <a href="site.php">Voltar</a>
</body>
</html>
