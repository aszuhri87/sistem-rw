@include("header")

@include("navbar")


<div class="container mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="m-0 p-0">Import Data Warga</h5>
                <a href="/warga/tampil" class="btn btn-danger">Kembali</a>
            </div>
            <div class="card">
                <div class="card-body"> 
                    <form action="{{url('warga/post-import')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>File</label>
                            <input type="file" class="form-control" name="file" required placeholder="File">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

@include("footer")