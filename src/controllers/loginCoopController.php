<?php
session_start();

include_once '../config/config.php';
include '../models/Cooperativa.php';

$cooperativa = new Cooperativa($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["user"];
    $password = $_POST["password"];

    $message = $cooperativa->autenticarCooperativa($user, $password);

    if ($message === "Login realizado") {
        $_SESSION["cooperativa_id"] = $cooperativa->getCooperativaId();
        header("Location: ../views/coleta.php");
        exit;
    }
}
?>