<?php
session_start();

if (!isset($_SESSION["cooperativa_id"]) || empty($_SESSION["cooperativa_id"])) {
    header("Location: loginCooperativa.php");
    exit;
}

include_once '../config/config.php';
include '../models/Residuo.php';

$cooperativa_id = $_SESSION["cooperativa_id"];
$residuo = new Residuo($conn);
$usuario = new Usuario($conn);

if (!$cooperativa_id) {
    echo "Cooperativa não autenticada.";
    exit;
}

// método para listar os resíduos coletados
$residuosColetados = $residuo->listarResiduosColetados();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel="stylesheet" href="../../css/ResiduoColetado.css">
    <title>Resíduos Coletados</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
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
    <h1>Resíduos Coletados</h1>
    <form method="post" action="">
    <label for="usuario" class='form-text'>Filtrar por usuário:</label>
    <select name="usuario" id="usuario">
        <option value="">Todos os Usuarios</option>
        <?php
        $usuarios = $usuario->obterTodosUsuarios();
        foreach ($usuarios as $u) {
            $selected = ($_POST['usuario'] == $u['id']) ? 'selected' : '';
            echo "<option value='{$u['id']}' $selected>{$u['name']}</option>";
        }
        ?>
    </select>
    <button type="submit" class='form-button'>Filtrar</button>
</form>

<?php
// Adicione esta verificação para ver se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['usuario']) && $_POST['usuario'] !== '') {
        // Seleciona um usuário específico
        $usuario_id_filtrado = $_POST['usuario'];
        $residuosColetados = $residuo->listarResiduosColetados($usuario_id_filtrado);
    } else {
        // Todos os resíduos coletados
        $residuosColetados = $residuo->listarResiduosColetados();
    }
} else {
    $residuosColetados = $residuo->listarResiduosColetados();
}
?>

    <div id="content">
        <div>
            <?php
            if (is_array($residuosColetados)) {
                echo "<p class='form-text'>Foram coletados " . count($residuosColetados) . " tipos de resíduos.</p>";
                foreach ($residuosColetados as $residuo) {
                    echo "<p class='form-text'>" . $residuo['qtd'] . " " . $residuo['tiporesiduo'] . "(s).</p>";
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
                    label: 'Resíduos Coletados',
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
                        'rgb(154,205,50)',
                        'rgb(153,204,50)',
                        'rgb(66,111,66)',
                        'rgb(127,255,0)',
                        'rgb(137, 201, 137)',
                        'rgb(66, 107, 66)',
                        'rgb(75, 150, 75)',
                        'rgb(59, 148, 59)',
                        'rgb(67, 191, 67)'
                    ],
                    borderColor: [
                        'rgb(143,188,143)'  
                    ],
                    borderWidth: 1
                }]
            },
        });
    </script>
     </div>
    </div>
    </main>

</body>
</html>
