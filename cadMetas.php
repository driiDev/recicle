<?php
require_once "config.php"; // Configuração do banco de dados
include 'Meta.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $qtd = $_POST["qtd"];
    $periodo = $_POST["periodo"];

    $meta = new Meta($conn);
    if ($meta->cadastrarMeta($titulo, $qtd, $periodo)) {
        echo "Meta definida com sucesso!";
    } else {
        echo "Erro ao definir a meta.";
    }
}
?>
