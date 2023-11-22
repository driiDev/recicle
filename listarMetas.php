<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: index.php"); // Redireciona para a página de login
    exit;
}

require_once "config.php";
include 'Meta.php';

$user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;

$meta = new Meta($conn);

// Chamar o método para listar as metas
$metas = $meta->listarMetas($user_id);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metas</title>
</head>
<body>
    <h1>Metas Cadastradas</h1>

    <?php
    if (!empty($metas)) {
        foreach ($metas as $meta) {
            // Formatar as datas
            $dataInicialFormatada = date('d/m/Y', strtotime($meta['data_inicial']));
            $dataFinalFormatada = date('d/m/Y', strtotime($meta['data_final']));

            // Calcular a porcentagem de conclusão da meta
            $porcentagemConcluida = ($meta['qtd_coletada'] / $meta['qtd']) * 100;

            // Exibir as informações da meta
            echo "<p>" . $meta['titulo'] . " - " . $dataInicialFormatada . " a " . $dataFinalFormatada . "</p>";
            echo "<p>Porcentagem concluída: " . number_format($porcentagemConcluida, 2) . "%</p>";
            echo "<a href='editarMeta.php?id=" . $meta['idmeta'] . "'>Editar</a>"; // Adiciona o link de editar
            echo "<a href='excluirMeta.php?id=" . $meta['idmeta'] . "' onclick='return confirm(\"Tem certeza que deseja excluir esta meta?\")'>Excluir</a>"; // Adiciona o link de excluir

            echo "<hr>"; // Adiciona uma linha horizontal para separar as metas
        }
    } else {
        echo "<p>Nenhuma meta cadastrada.</p>";
    }
    ?>
    <a href="site.php">Voltar</a>

</body>
</html>
