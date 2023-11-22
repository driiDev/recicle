<?php
session_start();

if (!isset($_SESSION["cooperativa_id"]) || empty($_SESSION["cooperativa_id"])) {
    header("Location: login_cooperativa.php");
    exit;
}

require_once "config.php";
include 'Residuo.php';

$cooperativa_id = $_SESSION["cooperativa_id"];
$residuo = new Residuo($conn);

if (!$cooperativa_id) {
    echo "Cooperativa não autenticada.";
    exit;
}

//  chama o método para listar os resíduos cadastrados para coleta porta a porta
$residuosColetaPortaPorta = $residuo->listarResiduosColetaPortaPorta();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resíduos para Coleta</title>
  <!-- API do Google Maps -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmHEXtD9tdIiGLYr0ToFJSzjX3eJe1A0k&callback=inicializarMapa" async defer></script>

<script>
    function inicializarMapa() {
    }
    function mostrarRota(cep, rua, numero, bairro, cidade) {
        // junta o endereço para pegar a localização completa
        var enderecoCompleto = cep + ' ' + rua + ', ' + numero + ', ' + bairro + ', ' + cidade;

        // Redirecionar para a pagina com os parâmetros de endereço
        window.location.href = 'visualizarRota.php?endereco=' + encodeURIComponent(enderecoCompleto);
    }

</script>

</head>
<body>
    <h1>Resíduos Cadastrados para Coleta Porta a Porta</h1>

<?php
   if (is_array($residuosColetaPortaPorta)) {
    foreach ($residuosColetaPortaPorta as $residuo) {
        echo "<p>Nome do Usuário: " . $residuo['name'] . "</p>";
        echo "<p>Endereço: <br>" . $residuo['cep'] . "<br> " . $residuo['rua'] . ", <br>" . $residuo['numero'] . ",<br> " . $residuo['bairro'] . ", <br>" . $residuo['cidade'] . "</p>";
        echo "<p>Tipo de Resíduo: " . $residuo['tiporesiduo'] . "</p>";
        echo "<p>Quantidade: " . $residuo['qtd'] . "</p>";

        // botão para mostrar a rota
        echo "<button onclick=\"mostrarRota('" . $residuo['cep'] . "', '" . $residuo['rua'] . "', '" . $residuo['numero'] . "', '" . $residuo['bairro'] . "', '" . $residuo['cidade'] . "')\">Mostrar Rota</button>";

        // formulário para confirmar a coleta
        echo "<form action='confirmar_coleta.php' method='post'>";
        echo "<input type='hidden' name='idresiduo' value='" . $residuo['idresiduo'] . "'>";
        echo "<input type='submit' name='confirmar_coleta' value='Confirmar Coleta'>";
        echo "</form>";

        echo "<hr>";
    }
} else {
    echo $residuosColetaPortaPorta;
}
   ?>
   <br><br>
   <a href="residuos_coletados.php">Visualizar resíduos coletados</a>

</body>
</html>
