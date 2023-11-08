<?php
require_once "config.php"; // Configuração do banco de dados
include 'Residuo.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["tiporesiudo"];
    $qtd = $_POST["qtd"];
    $periodo = $_POST["destinacao"];

    $meta = new Residuo($conn);
    if ($meta->cadastrarResiduo($titulo, $qtd, $periodo)) {
        echo "Resíduo cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar resíduo.";
    }
}
?>
