@include('header') @include('navbar')

<div class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="m-0 p-0">Input Kependudukan Warga</h5>
        <a href="/warga/tampil" class="btn btn-danger">Kembali</a>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ url('warga/post-tambah') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label>Nomor KK</label>
                    <input type="text" class="form-control" name="no_kk" required placeholder="Nomor KK" />
                </div>

                <div class="form-group mb-3">
                    <label>NIK</label>
                    <input type="text" class="form-control" name="nik" required placeholder="NIK" />
                </div>

                <div class="form-group mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap" required
                        placeholder="Nama Lengkap" />
                </div>

                <div class="form-group mb-3">
                    <label>Tempat Lahir</label>
                    <input type="text" class="form-control" name="tempat_lahir" required
                        placeholder="Tempat Lahir" />
                </div>

                <div class="form-group mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" required
                        placeholder="Tanggal Lahir" />
                </div>

                <div class="form-group mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                        <option value="">-- Pilih --</option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>Agama</label>
                    <input type="text" class="form-control" name="agama" required placeholder="Agama" />
                </div>

                <div class="form-group mb-3">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="alamat" required placeholder="Alamat" />
                </div>

                <div class="form-group mb-3">
                    <label>RT/RW</label>
                    <select name="rt" id="rt" class="form-control">
                        <option value="">--</option>
                        @foreach ($rt as $item)
                            <option value="{{ $item->id }}">
                                RT {{ $item->rt }}/RW {{ $item->rw }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>Pendidikan</label>
                    <input type="text" class="form-control" name="pendidikan" required placeholder="Pendidikan" />
                </div>

                <div class="form-group mb-3">
                    <label>Pekerjaan</label>
                    <input type="text" class="form-control" name="pekerjaan" required placeholder="Pekerjaan" />
                </div>

                <div class="form-group mb-3">
                    <label>Kewarganegaraan</label>
                    <input type="text" class="form-control" name="kewarganegaraan" required
                        placeholder="Kewarganegaraan" />
                </div>

                <div class="form-group mb-3">
                    <label>Status Perkawinan</label>
                    <input type="text" class="form-control" name="status_perkawinan" required
                        placeholder="Status Perkawinan" />
                </div>

                <div class="form-group mb-3">
                    <label>Status Dalam Keluarga</label>
                    <select name="status_dalam_keluarga" class="form-control" id="status_dalam_keluarga" required>
                        <option value="KEPALA KELUARGA">KEPALA KELUARGA</option>
                        <option value="ISTRI">ISTRI</option>
                        <option value="ANAK">ANAK</option>
                        <option value="FAMILI LAIN">FAMILI LAIN</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>Nama Ayah</label>
                    <input type="text" class="form-control" name="nama_ayah" required placeholder="Nama Ayah" />
                </div>

                <div class="form-group mb-3">
                    <label>Nama Ibu</label>
                    <input type="text" class="form-control" name="nama_ibu" required placeholder="Nama Ibu" />
                </div>

                <div class="form-group mb-3">
                    <label>Keterangan</label>
                    <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" />
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

@include('warga.script') @include('footer')
