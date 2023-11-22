<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: index.php");
    exit;
}

require_once "config.php";
include "Usuario.php";

$usuario = new Usuario($conn);
$user_id = $_SESSION["user_id"];

$endereco = $usuario->obterEndereco($user_id);

echo "<p>Nome: " . $_SESSION["name"] . "</p>";
echo "<p>Email: " . $_SESSION["email"] . "</p>";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cadastrar_endereco'])) {
    // Processar o formulário de endereço se ele foi enviado
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
    echo "<h2>Endereço</h2>";
    echo "<p>Cep: " . $endereco['cep'] . "</p>";
    echo "<p>Rua: " . $endereco['rua'] . "</p>";
    echo "<p>Número: " . $endereco['numero'] . "</p>";
    echo "<p>Bairro: " . $endereco['bairro'] . "</p>";
    echo "<p>Cidade: " . $endereco['cidade'] . "</p>";

    echo "<p><a href='editarEndereco.php'>Editar Endereço</a></p>";
    echo "<p><a href='excluirEndereco.php'>Excluir Endereço</a></p>";
} else {
    // Mostrar o formulário de endereço apenas se o usuário não tiver nenhum endereço cadastrado
    echo "<form action='cadEndereco.php' method='post'>";
    echo "<label>Cep:</label> <input type='number' name='cep' required><br>";
    echo "<label>Rua:</label> <input type='text' name='rua' required><br>";
    echo "<label>Número:</label> <input type='number' name='numero' required><br>";
    echo "<label>Bairro:</label> <input type='text' name='bairro' required><br>";
    echo "<label>Cidade:</label> <input type='text' name='cidade' required><br>";
    echo "<input type='submit' name='cadastrar_endereco' value='Cadastrar'>";
    echo "</form>";
}
?>
<a href="site.php">Voltar</a>

