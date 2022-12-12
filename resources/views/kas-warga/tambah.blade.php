@include("header")

<div class="container mt-5 mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="m-0 p-0">Input Kas Warga</h5>
                <a href="/kas-warga/tampil" class="btn btn-danger">Kembali</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{url('kas-warga/post-tambah')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nominal</label>
                            <input type="text" class="form-control" name="nominal" required placeholder="Nominal">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" required placeholder="Tanggal">
                        </div>
                        @if( Session::get('admin')->level == 'admin' && Session::get('admin')->rt == null)
                        <div class="form-group">
                            <label>RT</label>
                            <input type="text" class="form-control" name="rt" required placeholder="RT">
                        </div>
                        <div class="form-group">
                            <label>RW</label>
                            <input type="text" class="form-control" name="rw" required placeholder="RW">
                        </div>
                        @endif
                        <div class="form-group">
                            <label>Tipe</label>
                            <select name="tipe" id="" class="form-control">
                                <option value=""> -- Pilih Tipe --</option>
                                <option value="masuk"> Masuk </option>
                                <option value="keluar"> Keluar </option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="{{asset('js/jquery.blockUI.js')}}"></script>
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
@include("footer")
