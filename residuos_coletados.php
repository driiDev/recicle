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

// chama o método para listar os resíduos coletados
$residuosColetados = $residuo->listarResiduosColetados();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resíduos Coletados</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #content {
            display: flex;
            justify-content: start;
            align-items: flex-start;
        }
        #myChart {
            width: 200px;
            height: 200px;
        }
    </style>
</head>
<body>
    <h1>Resíduos Coletados</h1>

    <div id="content">
        <div>
            <?php
            if (is_array($residuosColetados)) {
                echo "<p>Foram coletados " . count($residuosColetados) . " tipos de resíduos.</p>";
                foreach ($residuosColetados as $residuo) {
                    echo "<p>" . $residuo['qtd'] . " " . $residuo['tiporesiduo'] . "(s).</p>";
                }
            } else {
                echo $residuosColetados;
            }
            ?>
            <canvas id="myChart"></canvas>
        </div>

        
    </div>
    <div>
        
    </div>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [<?php echo '"' . implode('","', array_column($residuosColetados, 'tiporesiduo')) . '"'; ?>],
                datasets: [{
                    label: '# de Resíduos Coletados',
                    data: [<?php echo implode(',', array_column($residuosColetados, 'qtd')); ?>],
                    backgroundColor: [
                        'rgb(0,100,0)',
                        'rgb(60,179,113)',
                        'rgb(46,139,87)',
                        'rgb(0,128,0)',
                        'rgb(50,205,50)',
                        'rgb(152,251,152)',
                        'rgb(34,139,34)',
                        'rgb(102,205,170)',
                        'rgb(154,205,50)'
                    ],
                    borderColor: [
                        'rgb(143,188,143)'  
                    ],
                    borderWidth: 1
                }]
            },
        });
    </script>

</body>
</html>
