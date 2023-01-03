@include ('header') @include ('navbar')

<body>
    <div class="container mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0 p-0">Tambah Jimpitan</h5>
            <a
                href="/jimpitan/tampil"
                class="btn btn-outline-danger"
                >Kembali</a
            >
        </div>
        @if (session('message'))
        <div
            class="alert alert-danger mt-3"
            style="text-align: left"
            role="alert">
            {{ session('message') }}
        </div>
        @endif
        <div class="card">
            <div class="card-body">
                {{--
                <div
                    id="reader"
                    width="600px"></div>
                --}}
                <a
                    href="/jimpitan/scan-qr"
                    class="btn btn-primary w-100 mb-3"
                    >Scan QrCode</a
                >
                <form
                    action="{{ url('jimpitan/tambah') }}"
                    method="POST">
                    @csrf
                    <div class="form-group">
                        <label>No KK</label>
                        <input
                            type="text"
                            class="form-control"
                            name="no_kk"
                            id="no_kk"
                            required
                            placeholder="No KK" />
                    </div>
                    <div class="form-group">
                        <label>Nominal</label>
                        <input
                            type="text"
                            class="form-control"
                            name="nominal"
                            id="nominal"
                            required
                            placeholder="Nominal" />
                    </div>
                    <div class="form-group mb-3">
                        <label>Kategori</label>
                        <select
                            name="kategori"
                            class="form-control"
                            id="kategori">
                            <option value="Harian">Harian</option>
                            <option value="Mingguan">Mingguan</option>
                            <option value="Bulanan">Bulanan</option>
                            <option value="Tahunan">Tahunan</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        @for ($i = 1; $i <= 10; $i++)
                        <button
                            type="button"
                            class="btn btn-outline-primary btn-nominal m-1"
                            value="{{ $i * 500 }}">
                            {{ $i * 500 }}
                        </button>
                        @endfor @for ($i = 2; $i <= 4; $i++)
                        <button
                            type="button"
                            class="btn btn-outline-primary btn-nominal m-1"
                            value="{{ $i * 5000 }}">
                            {{ $i * 5000 }}
                        </button>
                        @endfor
                    </div>
                    <button
                        type="submit"
                        class="btn btn-primary btn-save">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/jquery.blockUI.js') }}"></script>
    <script
        src="https://unpkg.com/html5-qrcode"
        type="text/javascript"></script>
    <script>
        @if (Session::get('scan_result'))
           $('#no_kk').val(atob('{{ Session::get('scan_result ') }}'))
        @endif

        $(document).on('click', '.btn-nominal', function(e) {
           $('#nominal').val($(this).val())
        })
    </script>

    @include('jimpitan.script') @include ('footer')
</body>
