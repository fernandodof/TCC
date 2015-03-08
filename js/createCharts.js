function createTop5Chart(top5){
    $(function () {
    $('#chartContaier').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Mais Vendidos'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'sans-serif, Verdana'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Vendas'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Vendas: <b>{point.y}</b>'
        },
        series: [{
            name: 'Vendas',
            data: top5,
            dataLabels: {
                enabled: true,
                rotation: 1,
                color: '#42586E',
                align: 'right',
                format: '{point.y}', // one decimal
                y: 20, // 10 pixels down from the top
                style: {
                    fontSize: '14px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
}