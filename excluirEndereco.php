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

// Verifica se o link de exclusão foi clicado e se o usuário confirmou
if (isset($_GET['excluir']) && isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
    $message = $usuario->excluirEndereco($user_id);

    // Redireciona de volta para a página de perfil após a exclusão
    header("Location: perfil.php?exclusao=".urlencode($message));
    exit;
}

// Obtém o endereço atualizado após a possível exclusão
$endereco = $usuario->obterEndereco($user_id);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Endereço</title>
</head>
<body>
    <h1>Excluir Endereço</h1>

    <?php
    if ($endereco && !empty($endereco['cep'])) {
        // Se o usuário tiver um endereço cadastrado, mostrar os dados do endereço
        echo "<h2>Endereço</h2>";
        echo "<p>Cep: " . $endereco['cep'] . "</p>";
        echo "<p>Rua: " . $endereco['rua'] . "</p>";
        echo "<p>Número: " . $endereco['numero'] . "</p>";
        echo "<p>Bairro: " . $endereco['bairro'] . "</p>";
        echo "<p>Cidade: " . $endereco['cidade'] . "</p>";

        // Adicione o link para excluir o endereço com confirmação
        echo "<p><a href='#' onclick='return confirmarExclusao()'>Excluir Endereço</a></p>";

        // Script JavaScript para confirmar a exclusão e redirecionar para a página de perfil
        echo "<script>";
        echo "function confirmarExclusao() {";
        echo "  if (confirm('Tem certeza que deseja excluir o endereço?')) {";
        echo "    window.location.href = 'excluirEndereco.php?excluir=true&confirm=true';";
        echo "  }";
        echo "  return false;";
        echo "}";
        echo "</script>";
    } else {
        echo "<p>Nenhum endereço encontrado.</p>";
    }
    ?>

</body>
</html>
