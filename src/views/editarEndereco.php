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
    <link rel="stylesheet" href="../../css/editar.css">
    <title>Cadastrar Endereço</title>
</head>
<body>
<header>
                <div class="div-nav">
                    <img class="logo-header" src="../../images/logo.png">
                    <nav>
                    <a class="text-nav" href="inicial.html">Página Inicial</a>
                    <a class="text-nav" href="perfil.php">Perfil</a>
                    <a class="text-nav" href="cadMetas.php">Metas</a>
                    <a class="text-nav" href="cadResiduos.php">Resíduos</a>
                    <a class="text-nav" href="ranking.php">Ranking</a>
                    </nav>
                </div>
            </header>
    <main>
        <div class="login-container">
            <div class="form-container">
                <!--tela inicio-->
                <form class="form form-inicio">
                    <img class="logo" src="../../images/logo.png">
                    <!--link para o formulario de login-->
                    <a href="../../src/views/perfil.php" class="form-link-ini">Voltar para perfil</a>
                </form>
                <!--tela cadastro de endereço-->
                <form action='../controllers/editarEnderecoController.php' method='post' class="form form-login">
                    <h2 class="form-title">Editar Endereço</h2>
                    <div class="form-input-container-residuo">
                        <input type="number" name="cep" class="form-input" placeholder="CEP" >
                        <input type="text" name="rua" class="form-input" placeholder="Rua">
                        <input type="number" name="numero" class="form-input" placeholder="N°" >
                        <input type="text" name="bairro" class="form-input" placeholder="Bairro" >
                        <input type="text" name="cidade" class="form-input" placeholder="Cidade" >
                    </div>
                    <button type="submit" name="editar_endereco" class="form-button">Editar</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
