@include('header') @include('navbar')

<div class="container mb-5">
   <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="m-0 p-0">Import Data Warga</h5>
      <a href="/warga/tampil" class="btn btn-danger">Kembali</a>
   </div>
   <div class="card">
      <div class="card-body">
         <form
            action="{{ url('warga/post-import') }}"
            method="POST"
            enctype="multipart/form-data"
         >
            @csrf
            <div class="form-group">
               <label>File</label>
               <input
                  type="file"
                  class="dropify"
                  data-allowed-file-extensions="xls xlsx csv"
                  name="file"
                  required
               />
            </div>
            <button type="submit" class="btn btn-primary btn-save">
               Simpan
            </button>
         </form>
      </div>
   </div>
   <a href="/warga/download-format" class="btn btn-success mt-3"
      >Download Contoh Format</a
   >
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{ asset('js/dropify.js') }}"></script>
<script src="{{ asset('js/jquery.blockUI.js') }}"></script>

@include('warga.script') @include('footer')
