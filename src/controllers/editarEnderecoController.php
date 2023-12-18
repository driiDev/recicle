<?php
session_start();
include_once '../config/config.php';
include '../models/Usuario.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: index.php");
    exit;
}

$usuario = new Usuario($conn);
$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['editar_endereco'])) {
        $cep = $_POST["cep"];
        $rua = $_POST["rua"];
        $numero = $_POST["numero"];
        $bairro = $_POST["bairro"];
        $cidade = $_POST["cidade"];

        $message = $usuario->editarEndereco($user_id, $cep, $rua, $numero, $bairro, $cidade);

        if ($message === "Endereço editado com sucesso.") {
            // Atualiza o endereço depois de editado
            $endereco = $usuario->obterEndereco($user_id);
            
            echo "<script>alert('$message'); window.location.href='../views/perfil.php';</script>";
            exit;
        } else {
            echo "<p>$message</p>";
        }
    }
}
// Pega o endereço depois de editado
$endereco = $usuario->obterEndereco($user_id);
?>