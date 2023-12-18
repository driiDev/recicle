<?php
session_start();
include_once '../config/config.php';
include '../models/Residuo.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: ../index.php");
    exit;
}

$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;

$residuo = new Residuo($conn);
$residuos = $residuo->listarResiduosUsuario($user_id);
?>
