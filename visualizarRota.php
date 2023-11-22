<?php
// rota.php

// Verifique se o parâmetro 'endereco' está presente na URL
if (isset($_GET['endereco'])) {
    $endereco = urldecode($_GET['endereco']);
} else {
    // Se não houver parâmetro, redirecione para a página principal ou trate conforme necessário
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

    <!-- Adicione a API do Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmHEXtD9tdIiGLYr0ToFJSzjX3eJe1A0k&callback=inicializarMapa" async defer></script>

    <!-- Adicione este bloco no head da sua página -->
    <script>
        var mapa; // Adicione uma variável global para o objeto do mapa
        var directionsRenderer; // Adicione uma variável global para o DirectionsRenderer

        function inicializarMapa() {
            // Lógica de inicialização do mapa, se necessário
            mapa = new google.maps.Map(document.getElementById('mapa'), {
                center: { lat: -29.90099748209841, lng: -51.22915883490828 },
                zoom: 14
            });

            directionsRenderer = new google.maps.DirectionsRenderer({ map: mapa });
        }

        function exibirRotaParaEndereco(endereco) {
            // Obter as coordenadas da cooperativa
            var cooperativaCoords = { lat: -29.90099748209841, lng: -51.22915883490828 };

            // Criar um marcador para a cooperativa
            var marcadorCooperativa = new google.maps.Marker({
                position: cooperativaCoords,
                map: mapa,
                title: 'Cooperativa'
            });

            // Geocodificar o endereço do usuário
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'address': endereco }, function (results, status) {
                if (status === 'OK') {
                    // Criar um marcador para o endereço do usuário
                    var marcadorUsuario = new google.maps.Marker({
                        position: results[0].geometry.location,
                        map: mapa,
                        title: 'Endereço do Usuário'
                    });

                    // Criar uma rota entre a cooperativa e o usuário
                    var directionsService = new google.maps.DirectionsService();
                    var request = {
                        origin: cooperativaCoords,
                        destination: results[0].geometry.location,
                        travelMode: 'DRIVING'
                    };

                    directionsService.route(request, function (response, status) {
                        if (status === 'OK') {
                            directionsRenderer.setDirections(response);
                        } else {
                            alert('Não foi possível calcular a rota.');
                        }
                    });
                } else {
                    alert('Não foi possível geocodificar o endereço do usuário.');
                }
            });
        }

        // Chame a função para exibir a rota ao carregar a página
        window.onload = function () {
            inicializarMapa();
            exibirRotaParaEndereco('<?php echo $endereco; ?>');
        };
    </script>
</head>
<body>
    <!-- Adicione este bloco onde você deseja que o mapa apareça -->
    <div id="mapa" style="height: 400px;"></div>
</body>
</html>
