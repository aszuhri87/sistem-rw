@include('header') @include('navbar')

<div class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="m-0 p-0">Ubah Data Warga</h5>
        <a
            href="/warga/tampil"
            class="btn btn-outline-danger"
            >Kembali</a
        >
    </div>
    <div class="card">
        <div class="card-body">
            <form
                action="/warga/post-ubah/{{ $warga->id }}"
                method="POST"
                id="ubah">
                @csrf
                <div class="form-group mb-3">
                    <label>No KK</label>
                    <input
                        type="text"
                        value="{{ $warga->no_kk }}"
                        class="form-control"
                        name="no_kk"
                        required
                        placeholder="Nomor KK" />
                </div>

                <div class="form-group mb-3">
                    <label>NIK</label>
                    <input
                        type="text"
                        value="{{ $warga->nik }}"
                        class="form-control"
                        name="nik"
                        required
                        placeholder="NIK" />
                </div>

                <div class="form-group mb-3">
                    <label>Nama Lengkap</label>
                    <input
                        type="text"
                        value="{{ $warga->nama_lengkap }}"
                        class="form-control"
                        name="nama_lengkap"
                        required
                        placeholder="Nama Lengkap" />
                </div>

                <div class="form-group mb-3">
                    <label>Tempat Lahir</label>
                    <input
                        type="text"
                        value="{{ $warga->tempat_lahir }}"
                        class="form-control"
                        name="tempat_lahir"
                        required
                        placeholder="Tempat Lahir" />
                </div>

                <div class="form-group mb-3">
                    <label>Tanggal Lahir</label>
                    <input
                        type="date"
                        value="{{ $warga->tanggal_lahir }}"
                        class="form-control"
                        name="tanggal_lahir"
                        required
                        placeholder="Tanggal Lahir" />
                </div>

                <div class="form-group mb-3">
                    <label>Jenis Kelamin</label>
                    <input
                        type="text"
                        value="{{ $warga->jenis_kelamin }}"
                        class="form-control"
                        name="jenis_kelamin"
                        required
                        placeholder="Jenis Kelamin" />
                </div>

                <div class="form-group mb-3">
                    <label>Agama</label>
                    <input
                        type="text"
                        value="{{ $warga->agama }}"
                        class="form-control"
                        name="agama"
                        required
                        placeholder="Agama" />
                </div>

                <div class="form-group mb-3">
                    <label>Alamat</label>
                    <input
                        type="text"
                        value="{{ $warga->alamat }}"
                        class="form-control"
                        name="alamat"
                        required
                        placeholder="Alamat" />
                </div>

                <div class="form-group mb-3">
                    <label>RT/RW</label>
                    <select
                        name="rt"
                        id="rt"
                        class="form-control">
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
                    <input
                        type="text"
                        value="{{ $warga->pendidikan }}"
                        class="form-control"
                        name="pendidikan"
                        required
                        placeholder="Pendidikan" />
                </div>

                <div class="form-group mb-3">
                    <label>Pekerjaan</label>
                    <input
                        type="text"
                        value="{{ $warga->pekerjaan }}"
                        class="form-control"
                        name="pekerjaan"
                        required
                        placeholder="Pekerjaan" />
                </div>

                <div class="form-group mb-3">
                    <label>Kewarganegaraan</label>
                    <input
                        type="text"
                        value="{{ $warga->kewarganegaraan }}"
                        class="form-control"
                        name="kewarganegaraan"
                        required
                        placeholder="Kewarganegaraan" />
                </div>

                <div class="form-group mb-3">
                    <label>Status Perkawinan</label>
                    <input
                        type="text"
                        value="{{ $warga->status_perkawinan }}"
                        class="form-control"
                        name="status_perkawinan"
                        required
                        placeholder="Status Perkawinan" />
                </div>

                <div class="form-group mb-3">
                    <label>Status Dalam Keluarga</label>
                    <select
                        name="status_dalam_keluarga"
                        class="form-control"
                        id="status_dalam_keluarga">
                        <option value="KEPALA KELUARGA">KEPALA KELUARGA</option>
                        <option value="ISTRI">ISTRI</option>
                        <option value="ANAK">ANAK</option>
                        <option value="FAMILI LAIN">FAMILI LAIN</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>Nama Ayah</label>
                    <input
                        type="text"
                        value="{{ $warga->nama_ayah }}"
                        class="form-control"
                        name="nama_ayah"
                        required
                        placeholder="Nama Ayah" />
                </div>

                <div class="form-group mb-3">
                    <label>Nama Ibu</label>
                    <input
                        type="text"
                        value="{{ $warga->nama_ibu }}"
                        class="form-control"
                        name="nama_ibu"
                        required
                        placeholder="Nama Ibu" />
                </div>

                <div class="form-group mb-3">
                    <label>Keterangan</label>
                    <input
                        type="text"
                        value="{{ $warga->keterangan }}"
                        class="form-control"
                        name="keterangan"
                        placeholder="Keterangan" />
                </div>

                <button
                    type="submit"
                    class="btn btn-primary btn-save">
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

       var data = {!! json_encode($warga) !!}

       $('#ubah').find('select[name="rt"]').find('option[value="' + data.id_rt_rw + '"]').prop('selected', true);
       $('#ubah').find('select[name="status_dalam_keluarga"]').find('option[value="' + data.status_dalam_keluarga +
          '"]').prop('selected', true);
    });
</script>

@include('warga.script') @include('footer')
