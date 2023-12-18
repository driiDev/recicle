<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bevan&display=swap" rel="stylesheet">
    <!--arquivo css para padronizar o todo-->
    <link rel="stylesheet" href="../css/reset.css">
    <!--arquivo css com as cores do projeto-->
    <link rel="stylesheet" href="../css/colors.css">
    <!--arquivo css para estilizar layout-->
    <link rel="stylesheet" href="../css/main.css">

    <script>
        // Verifica se o usuário está logado e redireciona para site.php
        <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
            window.location.href = "../views/inicial.html";
        <?php endif; ?>
    </script>
</head>
<body> 
    <main>
        <div class="login-container">
            <div class="form-container">
                <!--tela inicio-->
                <form class="form form-inicio">
                    <h2 class="form-title-ini">SEJA BEM-VINDO (A)</h2>
                    <img class="logo" src="../images/logo.png">
                    <a class="form-link-ini">Ainda não tem uma conta?</a>
                    <!--link para o formulario de cadastro-->
                    <a href="views/cadastrar.php" class="form-link-ini">Cadastre-se</a>
                </form>
                <!--tela login do usuario-->
                <form action="controllers/loginController.php" method="post" class="form form-login">
                    <h2 class="form-title">Acesse sua conta</h2>
                    <div class="form-input-container">
                        <input type="email" name="email" class="form-input" placeholder="Email" required>
                        <input type="password" name="password" class="form-input" placeholder="Senha" required>
                    </div>
                    <button type="submit" class="form-button" name="login">Entrar</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
