@include('header') @include('navbar')

<div class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="m-0 p-0">Tambah Data RT/RW</h5>
        <a href="/rt-rw/tampil" class="btn btn-outline-danger">Kembali</a>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="/rt-rw/post-tambah" method="POST" id="ubah">
                @csrf
                <div class="form-group mb-3">
                    <label>RT</label>
                    <input type="text" class="form-control" required name="rt" placeholder="RT" />
                </div>

                <div class="form-group mb-3">
                    <label>RW</label>
                    <input type="text" class="form-control" required name="rw" placeholder="RW" />
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
@include('rt-rw.script') @include('footer')
