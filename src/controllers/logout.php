<?php
session_start();

include_once '../config/config.php';

function logout() {
    unset($_SESSION["loggedin"]);
    header("Location: ../index.php");
    exit;
}

if (isset($_POST["logout"])) {
    logout();
}
?>
