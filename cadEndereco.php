<?php
session_start();
require_once "config.php";
include "Usuario.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: index.php");
    exit;
}

$usuario = new Usuario($conn);
$user_id = $_SESSION["user_id"];

// Cadastrar endereço
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cadastrar_endereco'])) {
    $cep = $_POST["cep"];
    $rua = $_POST["rua"];
    $numero = $_POST["numero"];
    $bairro = $_POST["bairro"];
    $cidade = $_POST["cidade"];

    $message = $usuario->cadastrarEndereco($user_id, $cep, $rua, $numero, $bairro, $cidade);

    if ($message === "Endereço cadastrado com sucesso.") {
        // Se o endereço foi cadastrado com sucesso, exibir o alerta em JavaScript e redirecionar
        echo '<script>';
        echo 'alert("Endereço cadastrado com sucesso.");';
        echo 'window.location.href = "perfil.php";';
        echo '</script>';
        exit;
    } else {
        echo "<p>$message</p>";
    }
}   

// Editar endereço
if (isset($_GET['editar']) && $_GET['editar'] == 1) {
    $endereco = $usuario->obterEndereco($user_id);
}

// Excluir endereço
if (isset($_GET['excluir']) && $_GET['excluir'] == 1) {
    $usuario->excluirEndereco($user_id);
    header("Location: perfil.php");
    exit;
}
?>

