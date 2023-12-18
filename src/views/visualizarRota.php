<?php
session_start();

// Verifica se o parâmetro 'endereco' está presente na URL
if (isset($_GET['endereco'])) {
    $endereco = urldecode($_GET['endereco']);
} else {
    // Se não tiver, redireciona para a página principal
    header("Location: coleta.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rota para Endereço</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bevan&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&family=Montserrat:wght@400;600&family=Nunito&family=Roboto+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!--arquivo css com as cores do projeto-->
    <link rel="stylesheet" href="../../css/colors.css">
    <!--arquivo css para estilizar layout-->
    <link rel="stylesheet" href="../../css/visualizarRota.css">

    <!-- API do Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmHEXtD9tdIiGLYr0ToFJSzjX3eJe1A0k&callback=inicializarMapa" async defer></script>

    <script>
        var mapa;
        var directionsRenderer;

        function inicializarMapa() {
            mapa = new google.maps.Map(document.getElementById('mapa'), {
                center: { lat: -29.90099748209841, lng: -51.22915883490828 },
                zoom: 14
            });

            directionsRenderer = new google.maps.DirectionsRenderer({ map: mapa });
        }

        function exibirRotaParaEndereco(endereco) {
            // coordenadas da cooperativa
            // Rua Dom Pedrito, 800 - Mathias Velho
            var cooperativaCoords = { lat: -29.901217969059875, lng: -51.22947111285271 };

            // Cria um marcador para a cooperativa
            var marcadorCooperativa = new google.maps.Marker({
                position: cooperativaCoords,
                map: mapa,
                title: 'Cooperativa Coopcamate'
            });

            // Geocodificar o endereço do usuário
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'address': endereco }, function (results, status) {
                if (status === 'OK') {
                    // Cria um marcador para o endereço do usuário
                    var marcadorUsuario = new google.maps.Marker({
                        position: results[0].geometry.location,
                        map: mapa,
                        title: 'Endereço do Usuário'
                    });

                    // Cria uma rota entre a cooperativa e o usuário
                    var directionsService = new google.maps.DirectionsService();
                    var request = {
                        origin: cooperativaCoords,
                        destination: results[0].geometry.location,
                        travelMode: 'BICYCLING' //rota de bicicleta
                    };

                    directionsService.route(request, function (response, status) {
                        if (status === 'OK') {
                            directionsRenderer.setDirections(response);

                            // Calcula o tempo estimado de viagem
                            var distanceMatrixService = new google.maps.DistanceMatrixService();
                            distanceMatrixService.getDistanceMatrix({
                                origins: [cooperativaCoords],
                                destinations: [results[0].geometry.location],
                                travelMode: 'BICYCLING', //rota de bicicleta
                                    }, function (distanceMatrixResponse, distanceMatrixStatus) {
                                    if (distanceMatrixStatus === 'OK') {
                                        var durationText = distanceMatrixResponse.rows[0].elements[0].duration.text;

                                        // Exibe o tempo estimado na tela
                                        var tempoViagemElement = document.getElementById('tempoViagem');
                                        tempoViagemElement.innerHTML = 'Tempo estimado de viagem: ' + durationText;
                                        } else {
                                            alert('Não foi possível obter o tempo estimado de viagem.');
                                    }
                            });
                        } else {
                            alert('Não foi possível calcular a rota.');
                        }
                    });
                } else {
                    alert('Não foi possível geocodificar o endereço do usuário.');
                }
            });
        }

        // função para exibir a rota ao carregar a página
        window.onload = function () {
            inicializarMapa();
            exibirRotaParaEndereco('<?php echo $endereco; ?>');
        };
    </script>
</head>
<body>
<header>
        <div class="div-nav">
        <img class="logo-header" src="../../images/logo.png">
        <nav>
            <a class="text-nav" href="coleta.php">Página Inicial</a>
            <a class="text-nav" href="cadMetas.php">Resíduos para Coleta</a>
        </nav>
        </div>
</header>
<main>
    <div class="meta-container">
    <div class="form form-listar">
    <h1>Rota para a coleta</h1> 
    <div id="mapa" style="height: 500px;"></div>
    <div id="tempoViagem" class="form-text"></div>
    </div>
    </div>
    </main>
    

</body>
</html>
