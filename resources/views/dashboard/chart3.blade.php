<script>
    var dom = document.getElementById('chart3-container');
    console.log(dom);

    var myChart = echarts.init(dom, null, {
        renderer: 'canvas',
        useDirtyRect: false
    });
    var app = {};
    var jimpit_per_bulan_sum = {!! json_encode($jimpit_per_bulan_sum) !!};

    var option;

    option = {
        xAxis: {
            type: 'category',
            data: jimpit_per_bulan_sum['bulan']
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: jimpit_per_bulan_sum['count'],
            type: 'line'
        }]
    };
    if (option && typeof option === 'object') {
        myChart.setOption(option);
    }

    window.addEventListener('resize', myChart.resize);
</script>
