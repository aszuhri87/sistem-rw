@include ("header")
@include ("navbar")

<body>
    <div class="container mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0 p-0">Tambah Jimpitan</h5>
            <a href="/jimpitan/tampil" class="btn btn-outline-danger">Kembali</a>
        </div>
        <div class="card">
            <div class="card-body">
                <div id="reader" width="600px"></div>

                <form action="{{url('jimpitan/tambah')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>No KK</label>
                        <input type="text" class="form-control" name="no_kk" id="no_kk" required placeholder="No KK">
                    </div>
                    <div class="form-group">
                        <label>Nominal</label>
                        <input type="text" class="form-control" name="nominal" id="nominal" required placeholder="Nominal">
                    </div>
                    <div class="mb-4">
                        @for($i=1; $i <= 10; $i++) <button type="button" class="btn btn-outline-primary btn-nominal m-1" value="{{$i*500}}">{{$i*500}}</button>
                            @endfor
                    </div>
                    <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('js/jquery.blockUI.js')}}"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        $(document).on('click', '.btn-nominal', function(e) {
            $('#nominal').val($(this).val())
        })

        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            console.log(`Code matched = ${decodedText}`, decodedResult);
            $('#no_kk').val(atob(decodedText))
            html5QrcodeScanner.clear();
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
        }

        function StopQR() { html5QrCode.stop().then((ignore) => { // QR Code scanning is stopped.
        }).catch((err) => { // Stop failed, handle it.
            });
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>

    <script>
        $(document).ready(function () {
            $('.btn-save').click(function () {
                $.blockUI({
                    message: '<div class="d-flex justify-content-center align-items-center"><p class="mr-50 mb-0">Mohon Tunggu...</p> <div class="spinner-grow spinner-grow-sm text-white" role="status"></div> </div>',
                    css: {
                        backgroundColor: 'transparent',
                        color: '#fff',
                        border: '0'
                    },
                    overlayCSS: {
                        opacity: 0.5
                    },
                    timeout: 1000,
                    baseZ: 2000
                });
            });
        });

    </script>
    @include ("footer")
