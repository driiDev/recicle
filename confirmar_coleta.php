<?php
session_start();

if (!isset($_SESSION["cooperativa_id"]) || empty($_SESSION["cooperativa_id"])) {
    header("Location: login_cooperativa.php");
    exit;
}

require_once "config.php";
include 'Residuo.php';

$cooperativa_id = $_SESSION["cooperativa_id"];
$residuo = new Residuo($conn);

if (!$cooperativa_id) {
    echo "Cooperativa não autenticada.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["confirmar_coleta"]) && isset($_POST["idresiduo"])) {
        $idresiduo = $_POST["idresiduo"];
        if ($residuo->confirmarColeta($idresiduo)) {
            echo "<script>alert('Coleta confirmada com sucesso!'); window.location.href='coleta.php';</script>";
            exit;
        } else {
            echo "Algo deu errado. Por favor, tente novamente mais tarde.";
        }
    }
}
?>
