<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: ../index.php");
    exit;
}

include_once '../config/config.php';
include '../models/Usuario.php';

$usuario = new Usuario($conn);

// Obtém a lista de usuários e suas pontuações
$usuariosRanking = $usuario->obterRanking();
?>