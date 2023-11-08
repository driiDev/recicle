<?php
require_once "config.php"; // Configuração do banco de dados
include 'Residuo.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tiporesiduo = $_POST["tiporesiduo"];
    $qtd = $_POST["qtd"];
    $destinacao = $_POST["destinacao"];

    $residuo = new Residuo($conn);
    if ($residuo->cadastrarResiduo($tiporesiduo, $qtd, $destinacao)) {
        echo "Resíduo cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar resíduo.";
    }
}
?>
