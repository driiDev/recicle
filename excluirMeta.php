<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: index.php"); // Redireciona para a página de login
    exit;
}

require_once "config.php";
include 'Meta.php';

$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;

// Verificar se o parâmetro 'id' foi passado na URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $meta_id = $_GET['id'];

    // Criar uma instância da classe Meta
    $meta = new Meta($conn);

    // Verificar se a meta pertence ao usuário logado
    if ($meta->verificarUsuario($meta_id, $user_id)) {
        // Excluir a meta
        if ($meta->excluirMeta($meta_id)) {
            echo "<script>alert('Meta excluída com sucesso.'); window.location.href = 'listarMetas.php';</script>";
            exit;
        } else {
            echo "<script>alert('Erro ao excluir a meta.'); window.location.href = 'listarMetas.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Você não tem permissão para excluir esta meta.'); window.location.href = 'listarMetas.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID da meta inválido.'); window.location.href = 'listarMetas.php';</script>";
    exit;
}
?>
