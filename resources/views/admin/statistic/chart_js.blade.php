<script>
    window.onload = function () {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "dark1", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Статистика просмотров по ATX за месяц."
            },
            axisY: {
                title: "Просмотры"
            },
            data: [{
                type: "column",
                showInLegend: true,
                legendMarkerColor: "grey",
                legendText: "Классификации",
                dataPoints: {!! $charts['month']  !!}
            }]
        });
        var chart2 = new CanvasJS.Chart("chartContainer2", {
            animationEnabled: true,
            theme: "light1", // "light1", "light2", "dark1", "dark2"
            title: {
                text: "Статистика просмотров по ATX за квартал."
            },
            axisY: {
                title: "Просмотры"
            },
            data: [{
                type: "column",
                showInLegend: true,
                legendMarkerColor: "grey",
                legendText: "Классификации",
                dataPoints: {!! $charts['quarter']  !!}
            }]
        });
        chart.render();
        chart2.render();

    }
</script>