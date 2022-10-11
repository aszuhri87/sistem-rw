<script>
  var dom = document.getElementById('chart3-container');
var myChart = echarts.init(dom, null, {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};

var option;

option = {
  xAxis: {
    type: 'category',
    data: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul','Agu','Sep','Okt','Nov','Des']
  },
  yAxis: {
    type: 'value'
  },
  series: [
    {
      data: [550000, 300000, 500000, 600000, 1000000, 500000, 850000, 800000, 750000, 469000, 754000, 650000],
      type: 'line'
    }
  ]
};

if (option && typeof option === 'object') {
  myChart.setOption(option);
}

window.addEventListener('resize', myChart.resize);
</script>