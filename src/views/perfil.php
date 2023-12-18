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
    <link rel="stylesheet" href="../../css/perfil.css">
    <title>Perfil do Usuário</title>
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
        <div class="perfil-container">
            <div class="form form-listar">

    <?php
    session_start();

    include_once '../config/config.php';
    include '../models/Usuario.php';

    $usuario = new Usuario($conn);
    $user_id = $_SESSION["user_id"];

    $endereco = $usuario->obterEndereco($user_id);

    echo "<h2 class='form-title'>PERFIL</h2>";
    echo "<p class='form-text'>Nome: " . $_SESSION["name"] . "</p>";
    echo "<p class='form-text'>Email: " . $_SESSION["email"] . "</p>";
    echo "<div class='div-excluir'>";
    echo "<button class='form-button' onclick=\"window.location.href='excluirConta.php'\">Excluir Conta</button>";
    echo "</div>";



    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cadastrar_endereco'])) {
        $cep = $_POST["cep"];
        $rua = $_POST["rua"];
        $numero = $_POST["numero"];
        $bairro = $_POST["bairro"];
        $cidade = $_POST["cidade"];

        $message = $usuario->cadastrarEndereco($user_id, $cep, $rua, $numero, $bairro, $cidade);

        echo "<p>$message</p>";
    }

    // Verificar se o usuário tem um endereço cadastrado
    if ($endereco && !empty($endereco['cep'])) {

        // Se o usuário tiver um endereço cadastrado, mostrar os dados do endereço
        echo "<h2 class='form-title'>ENDEREÇO</h2>";
        echo "<p class='form-text'>Cep: " . $endereco['cep'] . "</p>";
        echo "<p class='form-text'>Rua: " . $endereco['rua'] . "</p>";
        echo "<p class='form-text'>Número: " . $endereco['numero'] . "</p>";
        echo "<p class='form-text'>Bairro: " . $endereco['bairro'] . "</p>";
        echo "<p class='form-text'>Cidade: " . $endereco['cidade'] . "</p>";

        echo "<div class= 'div-button'>";
        echo "<button class='form-button' onclick=\"window.location.href='editarEndereco.php'\">Editar Endereço</button>";

        echo "<button class='form-button' onclick='confirmarExclusao()'>Excluir Endereço</button>";
            echo "<script>";
            echo "function confirmarExclusao() {";
            echo "  if (confirm('Tem certeza que deseja excluir o endereço?')) {";
            echo "    window.location.href = '../controllers/excluirEnderecoController.php?excluir=true&confirm=true';";
            echo "  }";
            echo "}";
            echo "</script>";

    } else {
        // Mostrar o formulário de endereço apenas se o usuário não tiver nenhum endereço cadastrado
        echo "<h2 class='form-title'>ENDEREÇO</h2>";
        echo "<div class='div-button'>";
        echo "<button class='form-button' onclick=\"window.location.href='cadEndereco.php'\">Cadastrar Endereço</button>";
        echo "</div>";
        
    }
    ?>
   
            </div>
        </div>
    </main>

</body>
</html>
