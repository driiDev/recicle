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
        <header>
                <div class="div-nav">
                    <img class="logo-header" src="../../images/logo.png">
                    <nav>
                    <a class="text-nav" href="inicial.html">Página Inicial</a>
                    <a class="text-nav" href="listarMetas.php">Ver Metas</a>
                    <a class="text-nav" href="cadResiduos.php">Cadastrar Resíduos</a>
                    <a class="text-nav" href="ranking.php">Ranking</a>
                    </nav>
                </div>
            </header>
    <main>
        <div class="meta-container">
            <div class="form-container">
                <!--tela inicio-->
                <form class="form form-inicio">
                    <img class="logo" src="../../images/logo.png">
                    <a href="../../src/views/listarMetas.php" class="form-link-ini">Ver metas cadastradas</a>
                </form>
                
                <form action="../controllers/cadMetasController.php" method="post" onsubmit="return validarDatas()" class="form form-meta"> 
                    <h2 class="form-title">CADASTRAR NOVA META</h2><br>
                    <div class="form-input-container-meta">
                        <input type="text" class="form-input" name="titulo" placeholder="Titulo" required>
                        <input type="number" class="form-input" name="qtd" placeholder="Quantidade" required>
                        <select name="unidade" id="unidade" class="form-input" required>
                            <option value="" disabled selected>Escolha a unidade</option>
                            <option value="kg">kg</option>
                            <option value="unidade">Unidade</option>
                        </select>
                        <input type="date" class="form-input" name="data_inicial" id="data_inicial" required>
                        <input type="date" class="form-input" name="data_final" id="data_final" required>
                        <button type="submit" class="form-button">Cadastrar</button>
                    </div>
                
            </div>
        </div>
    </main>
    <a href="site.php">Voltar</a>
</body>
</html>