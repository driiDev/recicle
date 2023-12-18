<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resíduos para Coleta</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bevan&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&family=Montserrat:wght@400;600&family=Nunito&family=Roboto+Mono&display=swap" rel="stylesheet">
    <!--arquivo css com as cores do projeto-->
    <link rel="stylesheet" href="../../css/colors.css">
    <!--arquivo css para estilizar layout-->
    <link rel="stylesheet" href="../../css/coleta.css">
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
<header>
        <div class="div-nav">
        <img class="logo-header" src="../../images/logo.png">
        <nav>
            <a class="text-nav" href="coleta.php">Página Inicial</a>
            <a class="text-nav" href="residuosColetados.php">Resíduos Coletados</a>
            <a class="text-nav" href="../loginCooperativa.php">Sair</a>
        </nav>
        </div>
</header>
    <main>
        <div class="meta-container">
            <div class="form form-listar">

            
    <h1>Resíduos Cadastrados para Coleta Porta a Porta</h1>

<?php
include '../controllers/coletaController.php';
   if (is_array($residuosColetaPortaPorta)) {
    foreach ($residuosColetaPortaPorta as $residuo) {
        echo "<p class='form-text'>Nome do Usuário: " . $residuo['name'] . "</p>";
        echo "<p class='form-text'><strong>Endereço: </strong><br>" . $residuo['cep'] . "<br> " . $residuo['rua'] . ", <br>" . $residuo['numero'] . ",<br> " . $residuo['bairro'] . ", <br>" . $residuo['cidade'] . "</p>";
        echo "<p class='form-text'>Tipo de Resíduo: " . $residuo['tiporesiduo'] . "</p>";
        echo "<p class='form-text'>Quantidade: " . $residuo['qtd'] . "</p>";

        // botão para mostrar a rota
        echo "<div class= 'div-button'>";
        echo "<button class='form-button' onclick=\"mostrarRota('" . $residuo['cep'] . "', '" . $residuo['rua'] . "', '" . $residuo['numero'] . "', '" . $residuo['bairro'] . "', '" . $residuo['cidade'] . "')\">Mostrar Rota</button>";

        // formulário para confirmar a coleta
        echo "<form action='confirmarColeta.php' method='post'>";
        echo "<input type='hidden' name='idresiduo' value='" . $residuo['idresiduo'] . "'>";
        echo "<button class='form-button'  name='confirmar_coleta'>Confirmar Coleta</button>";
        echo '</div>';
        echo "</form>";

        echo "<hr>";
    }
} else {
    echo $residuosColetaPortaPorta;
}
   ?>
            </div>
        </div>
    </main>
</body>
</html>
