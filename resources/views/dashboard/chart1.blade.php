<?php
$chart1 = [];
$daftar_warga = \App\Models\Warga::get();
$warga_rt ->each(function ($warga) use(&$chart1){
    array_push($chart1,[
      'value' => $warga->jumlah,
      'name' => 'RT '.$warga->rt,
    ]);
});


?>
<script>
var dom = document.getElementById('chart1-container');
var myChart = echarts.init(dom, null, {
  renderer: 'canvas',
  useDirtyRect: false
});
var app = {};
var kas_masuk = {!! json_encode($kas_masuk) !!};
var kas_keluar = {!! json_encode($kas_keluar) !!};

var option;
option = {
  tooltip: {
    trigger: 'item'
  },
  legend: {
    top: '5%',
    left: 'center'
  },
  series: [
    {
      name: 'Warga',
      type: 'pie',
      radius: ['40%', '70%'],
      avoidLabelOverlap: false,
      itemStyle: {
        borderRadius: 10,
        borderColor: '#fff',
        borderWidth: 2
      },
      label: {
        show: false,
        position: 'center'
      },
      emphasis: {
        label: {
          show: true,
          fontSize: '40',
          fontWeight: 'bold'
        }
      },
      labelLine: {
        show: false
      },
      data: @json ($chart1)
    }
  ]
};

if (option && typeof option === 'object') {
  myChart.setOption(option);
}

window.addEventListener('resize', myChart.resize);
</script>
