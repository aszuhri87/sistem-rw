<?php
// $chart3 = [];
// $bulan = [];
// console.log($kas_warga)
// $kas_warga->each(function ($kas_warga) use (&$chart3, &$bulan) {
//     array_push($chart3, $kas_warga->jumlah);
//     array_push($bulan, $kas_warga->bulan);
// });
// $chart3 = array_reverse($chart3);
// $bulan = array_reverse($bulan); ?>

<script>
    var data = {!! json_encode($kas_warga) !!};

    var bulan = [];
    var jumlah = [];

    data.forEach(element => {
        bulan.push(element.bulan);
        jumlah.push(element.jumlah);

    });

    var dom = document.getElementById('chart3-container');
    var myChart = echarts.init(dom, null, {
        renderer: 'canvas',
        useDirtyRect: false
    });
    var app = {};

    var option;

    option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: { type: 'line' }
        },
        legend: {},
        xAxis: {
            type: 'category',
            axisTick: {
                alignWithLabel: true
            },
            axisLabel: {
                fontSize: 10,
                fontWeight: 'bold'
            },
            data: bulan,
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: jumlah,
            type: 'line'
        }]
    };

    if (option && typeof option === 'object') {
        myChart.setOption(option);
    }

    window.addEventListener('resize', myChart.resize);
</script>
