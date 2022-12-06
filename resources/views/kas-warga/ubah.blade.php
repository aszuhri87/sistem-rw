@include("header")

@include("navbar")

<div class="container mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="m-0 p-0">Ubah Data Warga</h5>
                <a href="/kas-warga/tampil" class="btn btn-outline-danger">Kembali</a>
            </div>
            <div class="card">
                <div class="card-body"> 
                    <form action="/kas-warga/post-ubah/{{$kas_warga->id}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nominal</label>
                            <input type="text" value="{{$kas_warga->nominal}}" class="form-control" name="nominal" required placeholder="Nominal">
                        </div>  
                        <br>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" value="{{$kas_warga->tanggal}}" class="form-control" name="tanggal" required placeholder="Tanggal">
                        </div>  
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    @include("footer")