<?php
session_start();

include_once '../config/config.php';
include '../models/Usuario.php';

$usuario = new Usuario($conn);
$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cadastrar_endereco'])) {
    $cep = $_POST["cep"];
    $rua = $_POST["rua"];
    $numero = $_POST["numero"];
    $bairro = $_POST["bairro"];
    $cidade = $_POST["cidade"];

    $message = $usuario->cadastrarEndereco($user_id, $cep, $rua, $numero, $bairro, $cidade);
    

    if ($message === "Endereço cadastrado com sucesso.") {
        echo '<script>';
        echo 'alert("Endereço cadastrado com sucesso.");';
        echo 'window.location.href = "../views/perfil.php";';
        echo '</script>';
        exit;
    } else {
        echo "<p>$message</p>";
    }
}

?>