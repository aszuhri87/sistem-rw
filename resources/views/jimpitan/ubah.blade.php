@include ('header') @include ('navbar')

<body>
    <div class="container mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0 p-0">Ubah Jimpitan</h5>
            <a href="/jimpitan/tampil" class="btn btn-outline-danger">Kembali</a>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="/jimpitan/ubah/{{ $jimpitan->id }}" method="POST" id="ubah">
                    @csrf
                    <div class="form-group">
                        <label>ID Warga</label>
                        <input type="text" class="form-control" name="id_warga" value="{{ $jimpitan->id_warga }}"
                            disabled />
                    </div>
                    <div class="form-group">
                        <label>Nominal</label>
                        <input type="text" class="form-control" name="nominal" value="{{ $jimpitan->nominal }}"
                            required placeholder="Nominal" />
                    </div>
                    <div class="form-group mb-3">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control" id="kategori">
                            <option value="Harian">Harian</option>
                            <option value="Mingguan">Mingguan</option>
                            <option value="Bulanan">Bulanan</option>
                            <option value="Tahunan">Tahunan</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-save">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="{{ asset('js/jquery.blockUI.js') }}"></script>
    <script>
        $(document).ready(function() {
            var data = {
                !!json_encode($jimpitan) !!
            };

            $('#ubah').find('select[name="kategori"]').find('option[value="' + data
                .kategori + '"]').prop('selected',
                true);
        });
    </script>
    @include('jimpitan.script') @include('footer')
</body>
