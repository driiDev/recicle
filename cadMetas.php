<?php
require_once "config.php"; // Configuração do banco de dados
include 'Meta.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $qtd = $_POST["qtd"];
    $data_inicial = $_POST["data_inicial"];
    $data_final = $_POST["data_final"];

    $meta = new Meta($conn);
    if ($meta->cadastrarMeta($titulo, $qtd, $data_inicial, $data_final)) {
        echo "Meta definida com sucesso!";
    } else {
        echo "Erro ao definir a meta.";
    }
}
?>
