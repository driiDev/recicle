<?php
session_start();
require_once "config.php"; // Configuração do banco de dados
include 'Residuo.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tiporesiduo = $_POST["tiporesiduo"];
    $qtd = $_POST["qtd"];
    $destinacao = $_POST["destinacao"];

    $user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;

    $residuo = new Residuo($conn);
    if ($residuo->cadastrarResiduo($tiporesiduo, $qtd, $destinacao, $user_id)) {
    // Resíduo cadastrado com sucesso
        echo "<script>alert('Resíduo cadastrado com sucesso!'); window.location.href = 'site.php';</script>";
} else {
    // Erro ao cadastrar resíduo
    echo "<script>alert('Erro ao cadastrar resíduo.'); window.location.href = 'residuos.php';</script>";
}

}
?>
