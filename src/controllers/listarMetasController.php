<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: index.php"); // Redireciona para a página de login
    exit;
}

include_once '../config/config.php';
include '../models/Meta.php';
include '../models/Recompensa.php';

$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;

$meta = new Meta($conn);

// Chamar o método para listar as metas
$metas = $meta->listarMetas($user_id);
?>