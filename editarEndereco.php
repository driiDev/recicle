<?php
session_start();
require_once "config.php";
include "Usuario.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: index.php");
    exit;
}

$usuario = new Usuario($conn);
$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['editar_endereco'])) {
        $cep = $_POST["cep"];
        $rua = $_POST["rua"];
        $numero = $_POST["numero"];
        $bairro = $_POST["bairro"];
        $cidade = $_POST["cidade"];

        $message = $usuario->editarEndereco($user_id, $cep, $rua, $numero, $bairro, $cidade);

        if ($message === "Endereço editado com sucesso.") {
            // Atualize o endereço após a edição
            $endereco = $usuario->obterEndereco($user_id);
            
            echo "<script>alert('$message'); window.location.href='perfil.php';</script>";
            exit;
        } else {
            echo "<p>$message</p>";
        }
    }
}

// Obtenha o endereço após a edição
$endereco = $usuario->obterEndereco($user_id);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Endereço</title>
</head>
<body>
    <h1>Editar Endereço</h1>

    <?php
    if ($endereco) {
        // Exibe o formulário preenchido com os dados existentes
        echo '<form action="editarEndereco.php" method="post">';
        echo '<input type="number" name="cep" id="cep" placeholder="Cep" value="' . $endereco['cep'] . '" required><br>';
        echo '<input type="text" name="rua" id="rua" placeholder="Rua" value="' . $endereco['rua'] . '" required><br>';
        echo '<input type="number" name="numero" id="numero" placeholder="Número" value="' . $endereco['numero'] . '" required><br>';
        echo '<input type="text" name="bairro" id="bairro" placeholder="Bairro" value="' . $endereco['bairro'] . '" required><br>';
        echo '<input type="text" name="cidade" id="cidade" placeholder="Cidade" value="' . $endereco['cidade'] . '" required><br>';
        echo '<input type="submit" name="editar_endereco" value="Editar">';
        echo '</form>';
    } else {
        echo '<p>Nenhum endereço encontrado.</p>';
    }
    ?>

</body>
</html>
