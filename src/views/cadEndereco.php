<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Bevan&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <!--arquivo css para padronizar o todo-->
    <link rel="stylesheet" href="../../css/reset.css">
    <!--arquivo css com as cores do projeto-->
    <link rel="stylesheet" href="../../css/colors.css">
    <!--arquivo css para estilizar layout-->
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/cadastro.css">
    <title>Cadastrar Endereço</title>
</head>
<body>
    <main>
        <div class="login-container">
            <div class="form-container">
                <!--tela inicio-->
                <form class="form form-inicio">
                    <h2 class="form-title-ini">SEJA BEM-VINDO (A)</h2>
                    <img class="logo" src="../../images/logo.png">
                    <!--link para o formulario de login-->
                    <a href="../../src/views/perfil.php" class="form-link-ini">Voltar para perfil</a>
                </form>
                <!--tela cadastro de endereço-->
                <form action='../controllers/cadEnderecoController.php' method='post' class="form form-meta">
                    <h2 class="form-title">Cadastrar Endereço</h2>
                    <div class="form-input-container-residuo">
                        <input type="number" name="cep" class="form-input" placeholder="CEP" required>
                        <input type="text" name="rua" class="form-input" placeholder="Rua" required>
                        <input type="number" name="numero" class="form-input" placeholder="N°" required>
                        <input type="text" name="bairro" class="form-input" placeholder="Bairro" required>
                        <input type="text" name="cidade" class="form-input" placeholder="Cidade" required>
                    </div>
                    <button type="submit" name="cadastrar_endereco" class="form-button">Cadastrar</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
