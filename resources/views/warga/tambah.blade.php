@include("header")

@include("navbar")

<div class="container mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="m-0 p-0">Input Kependudukan Warga</h5>
                <a href="/warga/tampil" class="btn btn-danger">Kembali</a>
            </div>
            <div class="card">
                <div class="card-body"> 
                    <form action="{{url('warga/post-tambah')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nomor KK</label>
                            <input type="text" class="form-control" name="no_kk" required placeholder="Nomor KK">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" class="form-control" name="nik" required placeholder="NIK">
                        </div> 
                        <br>
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" required placeholder="Nama Lengkap">
                        </div> 
                        <br>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" required placeholder="Tempat Lahir">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" required placeholder="Tanggal Lahir">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <input type="text" class="form-control" name="jenis_kelamin" required placeholder="Jenis Kelmain">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Agama</label>
                            <input type="text" class="form-control" name="agama" required placeholder="Agama">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="alamat" required placeholder="Alamat">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>RT</label>
                            <input type="text" class="form-control" name="rt" required placeholder="RT">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>RW</label>
                            <input type="text" class="form-control" name="rw" required placeholder="RW">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Pendidikan</label>
                            <input type="text" class="form-control" name="pendidikan" required placeholder="Pendidikan">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <input type="text" class="form-control" name="pekerjaan" required placeholder="Pekerjaan">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Kewarganegaraan</label>
                            <input type="text" class="form-control" name="kewarganegaraan" required placeholder="Kewarganegaraan">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Status Perkawinan</label>
                            <input type="text" class="form-control" name="status_perkawinan" required placeholder="Status Perkawinan">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Status Dalam Keluarga</label>
                            <input type="text" class="form-control" name="status_dalam_keluarga" required placeholder="Status Dalam Keluarga">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Nama Ayah</label>
                            <input type="text" class="form-control" name="nama_ayah" required placeholder="Nama Ayah">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Nama Ibu</label>
                            <input type="text" class="form-control" name="nama_ibu" required placeholder="Nama Ibu">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" required placeholder="Keterangan">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

@include("footer")