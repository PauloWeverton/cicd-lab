<!DOCTYPE html>
<html lang="pt-BR">

<?php require "grafico/grafico1.php"?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste Jenkins</title>

    <link rel="stylesheet" href="./css/global.css">

    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/dark.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

</head>

<body>
    <h1>Bolsa Família - Histórico de 2013 a 2015 - Juazeiro do Norte - CE</h1>
    <div id="chartdiv"></div>
    <hr/>
    <br>
    <form name="form" action="" method="post">
        <table>
            <tr>
                <td>
                    Ano : 
                </td>
                <td>
                    <input id="ano_base" type="text" name="ano_base" placeholder="2020">
                </td>
            </tr>
            <tr>
                <td>
                    Código do Município :
                </td>
                <td>
                    <input id="codigo_ibge" type="text" name="codigo_ibge" placeholder="2307304">
                </td>
            </tr>
        </table>
        <br>
        <input type="button" id="executaConsulta" value="Consultar" onclick="consultarAPI()">
        <br><br>
        <a href="https://www.ibge.gov.br/explica/codigos-dos-municipios.php">Códigos dos Municípios Brasileiros</a>
    </form>
</body>

</html>