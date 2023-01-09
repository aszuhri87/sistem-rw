<script>
    var dom = document.getElementById('chart4-container');
    console.log(dom);

    var myChart = echarts.init(dom, null, {
        renderer: 'canvas',
        useDirtyRect: false
    });
    var app = {};
    var data = {!! json_encode($jimpit_per_bulan_sum) !!};

    var bulan = [];
    var jumlah = [];


    data.forEach(element => {
        bulan.push(element.bulan);
        jumlah.push(element.count);

    });
    console.log(bulan);

    var option;

    option = {
        tooltip: {
            trigger: 'axis',
            axisPointer: { type: 'line' }
        },
        xAxis: {
            type: 'category',
            data: bulan,
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: jumlah,
            type: 'bar'
        }]
    };
    if (option && typeof option === 'object') {
        myChart.setOption(option);
    }

    window.addEventListener('resize', myChart.resize);
</script>
