@include ("header")
@include ("navbar")
<style>
    #chart1-container {
        position: relative;
        height: 80vh;
        overflow: hidden;
    }

    #chart2-container {
        position: relative;
        height: 80vh;
        overflow: hidden;
    }

    #chart3-container {
        position: relative;
        height: 80vh;
        overflow: hidden;
    }

    #chart4-container {
        position: relative;
        height: 80vh;
        overflow: hidden;
    }

    #chart5-container {
        position: relative;
        height: 80vh;
        overflow: hidden;
    }

    #chart6-container {
        position: relative;
        height: 80vh;
        overflow: hidden;
    }

</style>

<body>
    <div class="container mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0 p-0">Dashboard</h5>
        </div>
        <div class="row mb-3">
            <div class="col-md-6 col-sm-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        @if( Auth::user()->level == 'admin')
                        <div class="card mb-3">
                            <div class="card-header">
                                Total Warga
                            </div>
                            <div class="card-body">
                                <h1>{{$warga}}</h1>
                            </div>
                        </div>
                        @endif
                        <div class="card mb-3">
                            <div class="card-header">
                                Total Jimpitan
                            </div>
                            <div class="card-body">
                                <h1>{{number_format($jimpitan, 0);}}</h1>
                            </div>
                        </div>
                        @if( Auth::user()->level == 'admin')
                        <div class="card mb-3">
                            <div class="card-header">
                                Total Kas Masuk
                            </div>
                            <div class="card-body">
                                <h1>{{ number_format($kas_masuk, 0); }}</h1>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                Total Kas Keluar
                            </div>
                            <div class="card-body">
                                <h1>{{ number_format($kas_keluar, 0); }}</h1>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @if( Auth::user()->level == 'admin')
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <br>
                    <h5 class="text-center">Dashboard Perbandingan Jumlah Warga </h5>
                    <div class="card-body">
                        <div id="chart1-container"></div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        @if( Auth::user()->level == 'admin')
        <div class="row mb-3">
            <div class="col-md-6 col-sm-12 mb-3">
                <div class="card">
                    <br>
                    <h5 class="text-center">Dashboard Perbandingan Warga Laki-Laki/Perempuan</h5>
                    <div class="card-body">
                        <div id="chart2-container"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-12 mb-3">
                <div class="card">
                    <br>
                    <h5 class="text-center">Dashboard Diagram Kas Warga PerBulan</h5>
                    <div class="card-body">
                        <div id="chart5-container"></div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <br>
                    <h5 class="text-center">Diagram Jimpitan PerBulan</h5>
                    <div class="card-body">
                        <div id="chart4-container"></div>
                    </div>
                </div>
            </div>
        </div>

        @if( Auth::user()->level == 'admin')
        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <br>
                    <h5 class="text-center">Dashboard Diagram Kas Warga PerBulan</h5>
                    <div class="card-body">
                        <div id="chart3-container"></div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <script src="https://fastly.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>

    @include("dashboard.chart4")
    @include("dashboard.chart1")
    @include("dashboard.chart2")
    @include("dashboard.chart3")
    @include("dashboard.chart5")
    @include("dashboard.chart6")
    @include ("footer")
