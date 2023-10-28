<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    
</head>
<body>
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

    <h1>Cadastrar</h1>
    <form action="cadastro.php" method="post">
        <input type="text" name="name" id="name" placeholder="Nome Completo" required> <br>
        <input type="email" name="email" id="email" placeholder="Email" required> <br>
        <input type="password" name="password" id="password" size="15" placeholder="Senha" required onchange="onChange()"> <br>
        <input type="password" name="confirm" id="confirm" size="15" placeholder="Confirmar Senha" required onchange="onChange()"> <br>
        <input type="submit">
    </form>

    <a href="index.php">Já tem conta?</a>

    
</body>
</html>