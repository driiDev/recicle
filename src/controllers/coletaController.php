<?php
session_start();

include_once '../config/config.php';
include '../models/Residuo.php';

$cooperativa_id = $_SESSION["cooperativa_id"];
$residuo = new Residuo($conn);

if (!$cooperativa_id) {
    echo "Cooperativa não autenticada.";
    exit;
}
// chama o método para listar os resíduos cadastrados para coleta porta a porta
$residuosColetaPortaPorta = $residuo->listarResiduosColetaPortaPorta();

?>