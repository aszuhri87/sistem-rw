@include('header') @include('navbar')

<div class="container mb-5">
   <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="m-0 p-0">Ubah Data Warga</h5>
      <a href="/kas-warga/tampil" class="btn btn-outline-danger">Kembali</a>
   </div>
   <div class="card">
      <div class="card-body">
         <form
            action="/kas-warga/post-ubah/{{ $kas_warga->id }}"
            method="POST"
            id="ubah"
         >
            @csrf
            <div class="form-group mb-3">
               <label>Nominal</label>
               <input
                  type="text"
                  value="{{ $kas_warga->nominal }}"
                  class="form-control"
                  name="nominal"
                  required
                  placeholder="Nominal"
               />
            </div>

            <div class="form-group mb-3">
               <label>Tanggal</label>
               <input
                  type="date"
                  value="{{ $kas_warga->tanggal }}"
                  class="form-control"
                  name="tanggal"
                  required
                  placeholder="Tanggal"
               />
            </div>
            @if (Auth::user()->level == 'admin' && Auth::user()->id_rt_rw ==
            null)
            <div class="form-group mb-3 mb-3">
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
            @endif
            <div class="form-group mb-3">
               <label>Tipe</label>
               <select name="tipe" id="tipe" class="form-control">
                  <option value="">-- Pilih Tipe --</option>
                  <option value="masuk">Masuk</option>
                  <option value="keluar">Keluar</option>
               </select>
            </div>

            <div class="form-group mb-3 div-kategori d-none"></div>

            <div class="form-group mb-3">
               <label>Catatan</label>
               <textarea
                  class="form-control"
                  name="catatan"
                  id="catatan"
                  cols="30"
                  rows="10"
               ></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
         </form>
      </div>
   </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="{{ asset('js/jquery.blockUI.js') }}"></script>
<script>
   $(document).ready(function() {
      var data = {
         !!json_encode($kas_warga) !!
      };

      $('#ubah').find('select[name="tipe"]').find('option[value="' + data.tipe + '"]').prop('selected', true);
      $('#ubah').find('select[name="rt"]').find('option[value="' + data.id_rt_rw + '"]').prop('selected', true);
      $('#ubah').find('textarea[name="catatan"]').val(data.catatan);

      if ($('#tipe').val() == 'masuk') {
         $('.div-kategori').removeClass('d-none').html(`
                  <label>Pilih Kategori</label>
                  <select name="kategori" id="kategori" class="form-control">
                      <option value=""> -- Pilih Kategori --</option>
                      <option value="Iuran sampah"> Iuran sampah </option>
                      <option value="Sponsorship/donatur"> Sponsorship/donatur </option>
                      <option value="Sewa perlengkapan"> Sewa perlengkapan </option>
                      <option value="Parkir"> Parkir </option>
                      <option value="Sewa tempat"> Sewa tempat </option>
                      <option value="Peralenan"> Peralenan </option>
                      <option value="Lain-lain"> Lain-lain </option>
                  </select>
              `);
      } else if ($('#tipe').val() == 'keluar') {
         $('.div-kategori').removeClass('d-none').html(`
                  <label>Pilih Kategori</label>
                  <select name="kategori" id="kategori" class="form-control">
                      <option value=""> -- Pilih Kategori --</option>
                      <option value="Santunan"> Santunan </option>
                      <option value="Kerjabakti"> Kerjabakti  </option>
                      <option value="Kegiatan"> Kegiatan </option>
                      <option value="Belanja"> Belanja  </option>
                      <option value="Perawatan"> Perawatan</option>
                      <option value="Konsumsi"> Konsumsi </option>
                      <option value="Perlengkapan"> Perlengkapan  </option>
                      <option value="Peralenan"> Peralenan </option>
                      <option value="Iuran sampah"> Iuran sampah </option>
                      <option value="Lain-lain"> Lain-lain </option>
                  </select>
              `);
      }

      $('#ubah').find('select[name="kategori"]').find('option[value="' + data.kategori + '"]').prop('selected',
         true);

   });
</script>
@include('kas-warga.script') @include('footer')
