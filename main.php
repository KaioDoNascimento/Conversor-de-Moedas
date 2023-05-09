<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio 004</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h1>Conversor de Moedas</h1>
        <?php 
        $pattern = numfmt_create('pt_BR',NumberFormatter::CURRENCY);
        # Cria o formato padrão para visualizar valores monetários

        $begin = date('m-d-Y',strtotime('-7 days')); 
        $end = date('m-d-Y');
        $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\'05-02-2023\'&@dataFinalCotacao=\'05-09-2023\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,cotacaoVenda,dataHoraCotacao';
        $data = json_decode(file_get_contents($url),true);
        $cotacao = $data["value"][0]['cotacaoCompra'];
        # Usando a API do BCB para conseguir o valor do dólar

        $balance = floatval($_GET["num"]) ?? 0;
        $dolar = $balance/$cotacao;

        print "<p> Seus ".numfmt_format_currency($pattern, $balance, "BRL")." equivalem a <strong> ".numfmt_format_currency($pattern,$dolar,"USD")."</strong> </p>";

        ?>
        <button onclick="javascript:history.go(-1)">Voltar</button>
    </main>
</body>
</html>