<?php
$chart3 = [];
$bulan = [];
$kas_warga->each(function ($kas_warga) use (&$chart3, &$bulan) {
    array_push($chart3, $kas_warga->jumlah);
    array_push($bulan, $kas_warga->bulan);
});

$chart3 = array_reverse($chart3);
$bulan = array_reverse($bulan);
?>
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
    data:@json ($bulan)
  },
  yAxis: {
    type: 'value'
  },
  series: [
    {
      data: @json ($chart3),
      type: 'line'
    }
  ]
};

if (option && typeof option === 'object') {
  myChart.setOption(option);
}

window.addEventListener('resize', myChart.resize);
</script>
