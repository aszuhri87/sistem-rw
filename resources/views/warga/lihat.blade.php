@include('header') @include('navbar')

<div class="fs-1 text-center">DETAIL KEPENDUDUKAN WARGA</div>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="m-0 p-0">Detail Data Warga</h5>
        <a
            href="/warga/tampil"
            class="btn btn-danger"
            >Kembali</a
        >
    </div>
    <div class="card">
        <div class="card-body">
            <form action="">
                <div class="form-group">
                    <label>No KK</label>
                    <input
                        type="text"
                        name="no_kk"
                        class="form-control"
                        value="{{ $warga->no_kk }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>NIK</label>
                    <input
                        type="text"
                        name="nik"
                        class="form-control"
                        value="{{ $warga->nik }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>Nama</label>
                    <input
                        type="text"
                        name="nama_lengkap"
                        class="form-control"
                        value="{{ $warga->nama_lengkap }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input
                        type="text"
                        name="tempat_lahir"
                        class="form-control"
                        value="{{ $warga->tempat_lahir }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input
                        type="date"
                        name="tanggal_lahir"
                        class="form-control"
                        value="{{ $warga->tanggal_lahir }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <input
                        type="text"
                        name="jenis_kelamin"
                        class="form-control"
                        value="{{ $warga->jenis_kelamin }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>Agama</label>
                    <input
                        type="text"
                        name="agama"
                        class="form-control"
                        value="{{ $warga->agama }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>Alamat</label>
                    <input
                        type="text"
                        name="alamat"
                        class="form-control"
                        value="{{ $warga->alamat }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>RT</label>
                    <input
                        type="text"
                        name="rt"
                        class="form-control"
                        value="{{ $warga->rt }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>RW</label>
                    <input
                        type="date"
                        name="rw"
                        class="form-control"
                        value="{{ $warga->rw }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>Pendidikan</label>
                    <input
                        type="text"
                        name="pendidikan"
                        class="form-control"
                        value="{{ $warga->pendidikan }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>Pekerjaan</label>
                    <input
                        type="text"
                        name="pekerjaan"
                        class="form-control"
                        value="{{ $warga->pekerjaan }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>Kewarganegaraan</label>
                    <input
                        type="text"
                        name="kewarganegaraan"
                        class="form-control"
                        value="{{ $warga->kewarganegaraan }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>Status Perkawinan</label>
                    <input
                        type="text"
                        name="status_perkawinan"
                        class="form-control"
                        value="{{ $warga->status_perkawinan }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>Status Dalam Keluarga</label>
                    <input
                        type="text"
                        name="status_dalam_keluarga"
                        class="form-control"
                        value="{{ $warga->status_dalam_keluarga }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>Nama Ayah</label>
                    <input
                        type="text"
                        name="nama_ayah"
                        class="form-control"
                        value="{{ $warga->nama_ayah }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>Nama Ibu</label>
                    <input
                        type="text"
                        name="nama_ibu"
                        class="form-control"
                        value="{{ $warga->nama_ibu }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>Keterangan</label>
                    <input
                        type="text"
                        name="keterangan"
                        class="form-control"
                        value="{{ $warga->keterangan }}"
                        disabled />
                </div>
                <br />
            </form>
        </div>
    </div>
</div>

@include('footer')
