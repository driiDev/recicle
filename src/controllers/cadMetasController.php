<?php
session_start();
include_once '../config/config.php';
include '../models/Meta.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $qtd = $_POST["qtd"];
    $unidade = $_POST["unidade"];
    $data_inicial = $_POST["data_inicial"];
    $data_final = $_POST["data_final"];

    // Verificar se o usuário está autenticado (loggedin) e se tem um user_id na sessão
    if ($_SESSION["loggedin"] && isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];

        $meta = new Meta($conn);
        if ($meta->cadastrarMeta($titulo, $qtd, $unidade, $data_inicial, $data_final, $user_id)) {
            // Meta definida com sucesso
            echo "<script>alert('Meta definida com sucesso!'); window.location.href = '../views/listarMetas.php';</script>";
        } else {
            // Erro ao definir a meta
            echo "<script>alert('Erro ao definir a meta.'); window.location.href = 'cadMetasController.php';</script>";
        }
    } else {
        // Usuário não autenticado
        echo "<script>alert('Usuário não autenticado.'); window.location.href = 'cadMetasController.php';</script>";
    }
}

?>
