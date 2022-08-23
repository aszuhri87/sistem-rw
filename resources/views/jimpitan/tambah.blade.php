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
                        <label>ID Warga</label>
                        <input type="text" class="form-control" name="id_warga" id="id_warga" required placeholder="ID Warga">
                    </div>
                    <div class="form-group">
                        <label>Nominal</label>
                        <input type="text" class="form-control" name="nominal" id="nominal" required placeholder="Nominal">
                    </div>
                    <div class="d-flex mb-4">
                        @for($i=1; $i <= 10; $i++) <button type="button" class="btn btn-outline-primary btn-nominal" value="{{$i*500}}">{{$i*500}}</button>
                            @endfor
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        $(document).on('click', '.btn-nominal', function(e) {
            $('#nominal').val($(this).val())
        })

        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            console.log(`Code matched = ${decodedText}`, decodedResult);
            $('#id_warga').val(decodedText)
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            console.warn(`Code scan error = ${error}`);
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
    @include ("footer")
