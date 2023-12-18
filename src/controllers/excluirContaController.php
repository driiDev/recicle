<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: index.php"); // Redireciona para a página de login
    exit;
}

include_once '../config/config.php';
include '../models/Usuario.php';

$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;

$erroSenha = false; // Variável para indicar se houve erro na senha

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $senhaDigitada = $_POST["senha"];

    $usuario = new Usuario($conn);

    // Verificar se a senha digitada está correta
    if ($usuario->verificarSenha($user_id, $senhaDigitada)) {
        // Senha correta, então procede com a exclusão da conta
        $resultadoExclusao = $usuario->excluirConta($user_id);

        if ($resultadoExclusao === "Conta excluída com sucesso") {
            echo "<script>alert('Conta excluída com sucesso.'); window.location.href = '../index.php';</script>";
        } else {
            echo "<script>alert('Erro ao excluir a conta.'); window.location.href = '/index.php';</script>";
        }
    } else {
        // Senha incorreta, exibir mensagem de erro
        $erroSenha = true;
    }
}
?>