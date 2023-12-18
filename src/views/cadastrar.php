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
    <!--arquivo css para padronizar o todo-->
    <link rel="stylesheet" href="../../css/reset.css">
    <!--arquivo css com as cores do projeto-->
    <link rel="stylesheet" href="../../css/colors.css">
    <!--arquivo css para estilizar layout-->
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/cadastro.css">
    <title>Cadastro</title>

    <script>
        function onChange() {
            const password = document.querySelector('input[name=password]');
            const confirm = document.querySelector('input[name=confirm]');
            if (confirm.value === password.value) {
                confirm.setCustomValidity('');
            } else {
                confirm.setCustomValidity('As senhas não conferem');
            }
        }
    </script>
</head>
<body> 
    <main>
        <div class="login-container">
            <div class="form-container">
                <!--tela inicio-->
                <form action="../../controllers/cadastroController.php" method="post" class="form form-inicio">
                    <h2 class="form-title-ini">SEJA BEM-VINDO (A)</h2>
                    <img class="logo" src="../../images/logo.png">
                    <a class="form-link-ini">Já tem conta?</a>
                    <!--link para o formulario de login-->
                    <a href="../../src/index.php" class="form-link-ini">Acesse aqui</a>
                </form>
                <!--tela cadastro-->
                <form action="../controllers/cadastroController.php" method="post" class="form form-login">
                    <h2 class="form-title">Cadastre sua conta</h2>
                    <div class="form-input-container-cad">
                        <input type="text" name="name" class="form-input" placeholder="Nome Completo" required>
                        <input type="email" name="email" class="form-input" placeholder="Email" required>
                        <input type="password" name="password" class="form-input" placeholder="Senha" required onchange="onChange()">
                        <input type="password" name="confirm" class="form-input" placeholder="Confirme a senha" required onchange="onChange()">
                    </div>
                    <button class="form-button" type="submit" name="register">Cadastrar</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>

