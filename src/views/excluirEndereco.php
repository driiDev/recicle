<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Endereço</title>
</head>
<body>
    <h1>Excluir Endereço</h1>

    <?php
    include '../controllers/excluirEnderecoController.php';
    if ($endereco && !empty($endereco['cep'])) {

        echo "<script>";
        echo "function confirmarExclusao() {";
        echo "  if (confirm('Tem certeza que deseja excluir o endereço?')) {";
        echo "    window.location.href = '../controllers/excluirEnderecoController.php?excluir=true&confirm=true';";
        echo "  }";
        echo "  return false;";
        echo "}";
        echo "</script>";
    } else {
        echo "<p>Nenhum endereço encontrado.</p>";
    }
    ?>

</body>
</html>
