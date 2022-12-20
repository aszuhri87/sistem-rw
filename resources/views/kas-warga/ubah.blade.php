@include("header")

@include("navbar")

<div class="container mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="m-0 p-0">Ubah Data Warga</h5>
                <a href="/kas-warga/tampil" class="btn btn-outline-danger">Kembali</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="/kas-warga/post-ubah/{{$kas_warga->id}}" method="POST" id="ubah">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Nominal</label>
                            <input type="text" value="{{$kas_warga->nominal}}" class="form-control" name="nominal" required placeholder="Nominal">
                        </div>

                        <div class="form-group mb-3">
                            <label>Tanggal</label>
                            <input type="date" value="{{$kas_warga->tanggal}}" class="form-control" name="tanggal" required placeholder="Tanggal">
                        </div>
                        @if( Auth::user()->level == 'admin' && Auth::user()->id_rt_rw == null)
                        <div class="form-group mb-3 mb-3">
                            <label>RT/RW</label>
                            <select name="rt" id="rt" class="form-control">
                                <option value=""> -- </option>
                                @foreach($rt as $item)
                                    <option value="{{ $item->id }}">RT {{$item->rt}}/RW {{$item->rw}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="form-group mb-3">
                            <label>Tipe</label>
                            <select name="tipe" id="" class="form-control">
                                <option value=""> -- Pilih Tipe --</option>
                                <option value="masuk"> Masuk </option>
                                <option value="keluar"> Keluar </option>
                            </select>
                        </div>

                        <div class="form-group mb-3 kategori d-none">

                        </div>

                        <div class="form-group mb-3">
                            <label>Catatan</label>
                            <textarea class="form-control" name="catatan" id="catatan" cols="30" rows="10"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="{{asset('js/jquery.blockUI.js')}}"></script>
    <script>
        $(document).ready(function () {
            var data = {!! json_encode($kas_warga) !!};

            $('#ubah').find('select[name="tipe"]').find('option[value="'+ data.tipe+'"]').prop('selected', true);
            $('#ubah').find('select[name="rt"]').find('option[value="'+ data.id_rt_rw+'"]').prop('selected', true);
            $('#ubah').find('select[name="kategori"]').find('option[value="'+ data.kategori+'"]').prop('selected', true);
            $('#ubah').find('textarea[name="catatan"]').val(data.catatan);

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
@include('kas-warga.script')
@include("footer")
