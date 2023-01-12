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
            color: "#3cb44c",
            data: jumlah,
            type: 'line',
            lineStyle: {
                color: "#e09820"
            }
        }]
    };

    if (option && typeof option === 'object') {
        myChart.setOption(option);
    }

    window.addEventListener('resize', myChart.resize);
</script>
