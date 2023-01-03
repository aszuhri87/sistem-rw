@include('header')

<body>
    <div class="container mt-5">
        <div class="card justify-content-center">
            <div class="card-body">
                <center>
                    <div id="qr-print">
                        <div
                            id="qrcode"
                            class="justify-content-center">
                            <img
                                class="img-thumbnail"
                                src="{{ $dataUri }}"
                                width="300"
                                height="300"
                                style="margin-top: 20px" />
                        </div>
                        <br />
                        <hr />
                    </div>
                    <button
                        type="button"
                        class="btn btn-primary"
                        id="btn-print">
                        Print kode QR
                    </button>
                </center>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

    <script>
        var data = {!! json_encode($warga) !!}

        $(document).on('click', '#btn-print', function(event) {
           event.preventDefault();

           printJS({
              printable: 'qrcode',
              type: 'html',
              style: '#qrcode{  display: flex; justify-content: center;}',
              documentTitle: data.nama_lengkap + '_QR_Code_' + Date.now()
           });

           document.title = data.nama_lengkap + '_QR_Code_' + Date.now();

        });
    </script>
</body>
