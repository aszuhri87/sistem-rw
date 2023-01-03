@include('header') @include('navbar')

<div class="fs-1 text-center">DETAIL KAS WARGA</div>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="m-0 p-0">Detail Kas Warga</h5>
        <a
            href="/kas-warga/tampil"
            class="btn btn-danger"
            >Kembali</a
        >
    </div>
    <div class="card">
        <div class="card-body">
            <form action="">
                <div class="form-group">
                    <label>Nominal</label>
                    <input
                        type="text"
                        class="form-control"
                        value="{{ $kas_warga->nominal }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>Tanggal</label>
                    <input
                        type="date"
                        class="form-control"
                        value="{{ $kas_warga->tanggal }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>RT</label>
                    <input
                        type="text"
                        class="form-control"
                        value="{{ $kas_warga->rt }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>RW</label>
                    <input
                        type="text"
                        class="form-control"
                        value="{{ $kas_warga->rw }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>Tipe</label>
                    <input
                        type="date"
                        class="form-control"
                        value="{{ $kas_warga->tipe }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>kategori</label>
                    <input
                        type="text"
                        class="form-control"
                        value="{{ $kas_warga->kategori }}"
                        disabled />
                </div>
                <br />
                <div class="form-group">
                    <label>Catatan</label>
                    <textarea
                        id="catatan"
                        cols="30"
                        rows="10"
                        class="form-control"></textarea>
                </div>
                <br />
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
       var data = {
          !!json_encode($kas_warga) !!
       };

       $('#catatan').val(data.catatan);

    });
</script>
@include('footer')
