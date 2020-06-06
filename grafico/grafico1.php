<script type="text/javascript">
    function consultarAPI() {
        am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_dark);
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("chartdiv", am4charts.XYChart);

        // Add percent sign to all numbers
        chart.numberFormatter.numberFormat = "#.##"; // "#.#'%'"

        // Get data
        <?php
            function getUrl($url) {
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                $resposta = curl_exec($curl);
                curl_close($curl);
                
                return json_decode($resposta, true);
            }

            function pegaArray($ano, $codIBGE) {
                $anoMes = ($ano * 100) + 1;
                $valor = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                for ($i = 0; $i < 12; $i++, $anoMes++) {
                    $urlConsul = "http://www.transparencia.gov.br/api-de-dados/bolsa-familia-por-municipio?mesAno=$anoMes&codigoIbge=$codIBGE&pagina=1";
                    $resultado = getUrl($urlConsul);
                    if (!empty($resultado)) {
                        $valor[$i] = $resultado[0]["valor"];
                        $beneficiados[$i] = $resultado[0]["quantidadeBeneficiados"];
                    }
                }
                return $valor;
            }

            // $ano = 2015;
            if(isset($_POST['ano_base'])){
                $ano = $_POST['ano_base'];
            }

            // $codIBGE = 3550308;
            if(isset($_POST['codigo_ibge'])){
                $codIBGE = $_POST['codigo_ibge'];
            }

            // $valorAnoAtual = pegaArray($ano, $codIBGE);
            // $valorAnoPassado1 = pegaArray(($ano - 1), $codIBGE);
            // $valorAnoPassado2 = pegaArray(($ano - 2), $codIBGE);

            $valorAnoAtual = [12595804.44, 12613158.43, 12705115.67, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            $valorAnoPassado1 = [11937086.69, 11925110.69, 11966028.29, 11987984.29, 11313335.55, 12024910.29, 11985988.29, 12014990.57, 12013932.08, 24179558.78, 24153731.00, 12067822.95];                    
            $valorAnoPassado2 = [1937086.69, 1925110.69, 1966028.29, 1987984.29, 1313335.55, 2024910.29, 1985988.29, 2014990.57, 2013932.08, 4179558.78, 4153731.00, 2067822.95];
            
            $beneficiadosAnoAtual = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        ?>

        var beneficiadosAtuais = [12118, 12066, 12154, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        var beneficiadosPassados1 = [11955, 11943, 11984, 12006, 11330, 12043, 12019, 12033, 12032, 12131, 12097, 12087];

        var valoresAtuais = [];
        <?php
        foreach($valorAnoAtual as $valor): ?>
            valoresAtuais.push(<?= $valor?>);
        <?php
        endforeach; ?>
        

        var valoresPassados1 = [];
        <?php
        foreach($valorAnoPassado1 as $valor): ?>
            valoresPassados1.push(<?= $valor?>);
        <?php
        endforeach; ?>
                                
        var valoresPassados2 = [];
        <?php
        foreach($valorAnoPassado2 as $valor): ?>
            valoresPassados2.push(<?= $valor?>);
        <?php
        endforeach; ?>

        var currentYear = valoresAtuais;
        var previousYear1 = valoresPassados1;
        var previousYear2 = valoresPassados2;

        // Add data
        chart.data = [{
            "mes": "Janeiro",
            "anoAnterior2": previousYear2[0],
            "anoAnterior1": previousYear1[0],
            "anoSelecionado": currentYear[0]
        }, {
            "mes": "Fevereiro",
            "anoAnterior2": previousYear2[1],
            "anoAnterior1": previousYear1[1],
            "anoSelecionado": currentYear[1]
        }, {
            "mes": "Março",
            "anoAnterior2": previousYear2[2],
            "anoAnterior1": previousYear1[2],
            "anoSelecionado": currentYear[2]
        }, {
            "mes": "Abril",
            "anoAnterior2": previousYear2[3],
            "anoAnterior1": previousYear1[3],
            "anoSelecionado": currentYear[3]
        }, {
            "mes": "Maio",
            "anoAnterior2": previousYear2[4],
            "anoAnterior1": previousYear1[4],
            "anoSelecionado": currentYear[4]
        }, {
            "mes": "Junho",
            "anoAnterior2": previousYear2[5],
            "anoAnterior1": previousYear1[5],
            "anoSelecionado": currentYear[5]
        }, {
            "mes": "Julho",
            "anoAnterior2": previousYear2[6],
            "anoAnterior1": previousYear1[6],
            "anoSelecionado": currentYear[6]
        }, {
            "mes": "Setembro",
            "anoAnterior2": previousYear2[7],
            "anoAnterior1": previousYear1[7],
            "anoSelecionado": currentYear[7]
        }, {
            "mes": "Setembro",
            "anoAnterior2": previousYear2[8],
            "anoAnterior1": previousYear1[8],
            "anoSelecionado": currentYear[8]
        }, {
            "mes": "Outubro",
            "anoAnterior2": previousYear2[9],
            "anoAnterior1": previousYear1[9],
            "anoSelecionado": currentYear[9]
        }, {
            "mes": "Novembro",
            "anoAnterior2": previousYear2[10],
            "anoAnterior1": previousYear1[10],
            "anoSelecionado": currentYear[10]
        }, {
            "mes": "Dezembro",
            "anoAnterior2": previousYear2[11],
            "anoAnterior1": previousYear1[11],
            "anoSelecionado": currentYear[11]
        }];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "mes";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.title.text = "Valor Destinado ao Município (R$)";
        valueAxis.title.fontWeight = 800;

        // Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.dataFields.valueY = "anoAnterior2";
        series.dataFields.categoryX = "mes";
        series.clustered = false;
        series.tooltipText = "Crescimento em {categoryX} (2018): [bold]{valueY}[/]";

        var series2 = chart.series.push(new am4charts.ColumnSeries());
        series2.dataFields.valueY = "anoAnterior1";
        series2.dataFields.categoryX = "mes";
        series2.clustered = false;
        series2.columns.template.width = am4core.percent(55);
        series2.tooltipText = "Crescimento em {categoryX} (2019): [bold]{valueY}[/]";

        var series3 = chart.series.push(new am4charts.ColumnSeries());
        series3.dataFields.valueY = "anoSelecionado";
        series3.dataFields.categoryX = "mes";
        series3.clustered = false;
        series3.columns.template.width = am4core.percent(25);
        series3.tooltipText = "Crescimento em {categoryX} (2020): [bold]{valueY}[/]";

        chart.cursor = new am4charts.XYCursor();
        chart.cursor.lineX.disabled = true;
        chart.cursor.lineY.disabled = true;

        }); // end am4core.ready()
    }
</script>