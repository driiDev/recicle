<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: ../index.php"); // Redireciona para a página de login
    exit;
}

include_once '../config/config.php';
include '../models/Residuo.php';

$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;

// Verificar se o ID foi passado na URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $residuo_id = $_GET['id'];

    // Criar uma instância da classe Residuo
    $residuo = new Residuo($conn);

    // Verificar se o resíduo pertence ao usuário logado
    if ($residuo->verificarUsuario($residuo_id, $user_id)) {
        // Excluir o resíduo
        if ($residuo->excluirResiduo($residuo_id)) {
            echo "<script>alert('Resíduo excluído com sucesso.'); window.location.href = '../views/listarResiduos.php';</script>";
            exit;
        } else {
            echo "<script>alert('Erro ao excluir o resíduo.'); window.location.href = '../views/listarResiduos.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Você não tem permissão para excluir este resíduo.'); window.location.href = '../views/listarResiduos.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID do resíduo inválido.'); window.location.href = '../views/listarResiduos.php';</script>";
    exit;
}
?>
