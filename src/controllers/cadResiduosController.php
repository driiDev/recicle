<?php
session_start();
include_once '../config/config.php';
include '../models/Residuo.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: ../index.php");
    exit;
}

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tiporesiduo = $_POST["tiporesiduo"];
    $qtd = $_POST["qtd"];
    $unidade = $_POST["unidade"];
    $destinacao = $_POST["destinacao"];

    $user_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;

    $residuo = new Residuo($conn);
    if ($residuo->cadastrarResiduo($tiporesiduo, $qtd, $unidade, $destinacao, $user_id)) {
        $resultadoCadastro = $residuo->obterDetalhesResiduo($tiporesiduo);
        $mensagem = 'Se não tivesse sido descartado, demoraria '
            . $resultadoCadastro['tempo_decomposicao'] . 
            ' ATÉ SE DECOMPOR. <br><br>'. 'Classificação do resíduo: ' . $resultadoCadastro['classificacao'];
    
        header("Location: ../views/exibirResiduo.php?mensagem=" . urlencode($mensagem));
        exit;
    } else {
        $mensagem = 'Erro ao cadastrar resíduo.';
        header("Location: ../views/exibirResiduo.php?mensagem=" . urlencode($mensagem));
        exit;
    }
}
?>
