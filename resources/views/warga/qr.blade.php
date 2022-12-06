<body>
    <div id="qrcode"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ url('js/qrcode.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        new QRCode(document.getElementById("qrcode"), "{{base64_encode($warga->no_kk)}}");
    </script>
</body>