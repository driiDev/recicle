<?php
session_start();

include_once '../config/config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_recompensa']) && isset($_POST['meta_id'])) {
        $id_recompensa = $_POST['id_recompensa'];
        $meta_id = $_POST['meta_id'];

    // Verifica se a recompensa existe na tabela recompensas
    $sqlVerificaRecompensa = "SELECT COUNT(*) FROM recompensas WHERE id = ?";
    $stmtVerificaRecompensa = $conn->prepare($sqlVerificaRecompensa);
    $stmtVerificaRecompensa->bind_param("i", $id_recompensa);
    $stmtVerificaRecompensa->execute();
    $stmtVerificaRecompensa->bind_result($count);
    $stmtVerificaRecompensa->fetch();
    $stmtVerificaRecompensa->close();

    if ($count > 0) {
        // Atualiza a meta com o id da recompensa escolhida
        $sqlAtualizaMeta = "UPDATE metas SET recompensa_id = ? WHERE idmeta = ?";
        $stmtAtualizaMeta = $conn->prepare($sqlAtualizaMeta);
        $stmtAtualizaMeta->bind_param("ii", $id_recompensa, $meta_id);

        if ($stmtAtualizaMeta->execute()) {
            $stmtAtualizaMeta->close();
            echo "<script>alert('Recompensa escolhida com sucesso!');window.location.href = '../views/listarMetas.php';</script>";
        } else {
            echo "<script>alert('Erro durante a execução: " . $stmtAtualizaMeta->error . "');</script>";
        }
    } else {
        echo "<script>alert('Recompensa inválida.');window.location.href = '../views/listarMetas.php';</script>";
    }
        $conn->close();
        }
}
?>
