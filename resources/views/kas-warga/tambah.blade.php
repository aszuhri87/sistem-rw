@include("header")

<br>
<br>
<br>
<div class="container mb-5">
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
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

@include("footer")