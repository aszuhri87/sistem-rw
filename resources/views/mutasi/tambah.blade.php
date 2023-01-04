@include ('header') @include ('navbar')

<body>
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0 p-0">DAFTAR ACCOUNT</h5>
            <a href="/admin/tampil" class="btn btn-danger">Kembali</a>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ url('admin/post-tambah') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" required placeholder="Nama" />
                    </div>
                    <br />
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" required placeholder="Email" />
                    </div>
                    <br />
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control" name="password" required placeholder="Password" />
                    </div>
                    <br />
                    <div class="form-group">
                        <label>RT</label>
                        <input type="text" class="form-control" name="rt" required placeholder="RT" />
                    </div>
                    <br />
                    <div class="form-group">
                        <label>RW</label>
                        <input type="text" class="form-control" name="rw" required placeholder="RW" />
                    </div>
                    <br />
                    <div class="form-group">
                        <label>Level</label>
                        <input type="text" class="form-control" name="level" required placeholder="Level" />
                    </div>
                    <br />
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
@include('footer')
