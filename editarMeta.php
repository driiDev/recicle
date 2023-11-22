<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: index.php"); // Redireciona para a página de login
    exit;
}

require_once "config.php";
include 'Meta.php';

$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;

$meta = new Meta($conn);

// Verifica se foi passado um ID válido pela URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $meta_id = $_GET['id'];

    // Carrega os detalhes da meta
    $metaDetalhes = $meta->carregarMeta($meta_id);

    if (!$metaDetalhes) {
        // Redireciona se a meta não existe ou não pertence ao usuário
        header("Location: listarMetas.php");
        exit;
    }
} else {
    // Redireciona se não houver um ID válido na URL
    header("Location: listarMetas.php");
    exit;
}

// Trata o envio do formulário de edição
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $qtd_coletada = $_POST['qtd_coletada'];

    // Executa a atualização da quantidade coletada
    if ($meta->atualizarMeta($meta_id, $qtd_coletada)) {
        header("Location: listarMetas.php");
        exit;
    } else {
        echo "Erro ao atualizar a meta.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Meta</title>
</head>
<body>
    <h1>Editar Meta</h1>
    <p>Título: <?= $metaDetalhes['titulo'] ?></p>
    <p>Quantidade desejada: <?= $metaDetalhes['qtd'] ?></p>
    <p>Data Inicial: <?= date('d/m/Y', strtotime($metaDetalhes['data_inicial'])) ?></p>
    <p>Data Final: <?= date('d/m/Y', strtotime($metaDetalhes['data_final'])) ?></p>

    <form action="" method="post">
    <label for="qtd_coletada">Quantidade coletada:</label>
    <input type="number" name="qtd_coletada" id="qtd_coletada" value="<?php echo $metaDetalhes['qtd_coletada']; ?>">

    <input type="submit" value="Salvar">
</form>

    </form>
</body>
</html>
