@include ("header")
@include ("navbar")
<style>
    #chart1-container {
  position: relative;
  height: 100vh;
  overflow: hidden;
}
    #chart2-container {
  position: relative;
  height: 100vh;
  overflow: hidden;
}
#chart3-container {
  position: relative;
  height: 100vh;
  overflow: hidden;
}

</style>
<body>
    <div class="container mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0 p-0">Dashboard</h5>
        </div>
        <div class="row mb-3">
          <div class="col-6">
              <div class="card">
                <br>
              <h5 class="text-center" >Dashboard Perbandingan Jumlah Warga RW 05</h5>
                <div class="card-body">
                  <div id="chart1-container"></div>
                </div>
              </div>
          </div>
          <div class="col-6">
              <div class="card">
                <br>
              <h5 class="text-center" >Dashboard Perbandingan Warga Laki-Laki/Perempuan</h5>
                <div class="card-body">
                  <div id="chart2-container"></div>
                </div>
              </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-12">
              <div class="card">
              <h5 class="text-center" >Dashboard Diagram Khas Warga PerBulan</h5>
                <div class="card-body">
                  <div id="chart3-container"></div>
                </div>
              </div>
          </div>
        </div>  
    </div>
    <script src="https://fastly.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
@include("dashboard.chart1")
@include("dashboard.chart2")
@include("dashboard.chart3")



@include ("footer")
