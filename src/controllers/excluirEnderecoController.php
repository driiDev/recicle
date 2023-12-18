<?php
session_start();

include_once '../config/config.php';
include '../models/Usuario.php';

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
    header("Location: ../views/perfil.php?exclusao=" . urlencode($message));
    exit;
}

// endereço após a exclusão (ou não)
$endereco = $usuario->obterEndereco($user_id);
?>
