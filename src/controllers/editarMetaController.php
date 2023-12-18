<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: ../index.php"); // Redireciona para a página de login
    exit;
}

include_once '../config/config.php';
include '../models/Meta.php';

$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;

$meta = new Meta($conn);

// Verifica se foi passado um ID pela URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $meta_id = $_GET['id'];

    // Carrega os detalhes da meta
    $metaDetalhes = $meta->carregarMeta($meta_id);

    if (!$metaDetalhes) {
        // Redireciona se a meta não existe
        header("Location: ../views/listarMetas.php");
        exit;
    }
} else {
    // Redireciona se não tiver um ID na URL
    header("Location: ../views/listarMetas.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $qtd_coletada = $_POST['qtd_coletada'];

    // Atualize a quantidade coletada no banco de dados
    if ($meta->atualizarMeta($meta_id, $qtd_coletada)) {
        // Verifique se a quantidade coletada atingiu a quantidade desejada
        if ($qtd_coletada == $metaDetalhes['qtd']) {
            // Marque a meta como atingida
            $meta->completarMeta($meta_id, $qtd_coletada);
        }
        
        header("Location: ../views/listarMetas.php");
        exit;
    } else {
        echo "Erro ao atualizar a meta.";
    }
}

?>