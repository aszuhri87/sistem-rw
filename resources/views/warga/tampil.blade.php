@include("header")

@include("navbar")
<div class="container mb-5">
    @if (session('message'))
    <div class="alert alert-success mt-5" role="alert">
        {{ session('message') }}
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger mt-5" role="alert">
        {{ session('error') }}
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="m-0 p-0">Data Kependudukan Warga</h5>
        <div>
            <input type="text" class="form-control" id="cari" name="cari" placeholder="Cari..">
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex mb-3">
                <a href="/warga/tambah" class="btn btn-success p-2 mr-auto m-1">Tambah</a>
                <div>
                    <a href="/warga/import" class="btn btn-primary p-2 ml-1">Import Data</a>
                </div>
            </div>
            <table width="100%" class="table table-bordered mb-0 table-responsive">
                <thead>
                    <tr>
                        <th width="5%"">No</th>
                        <th width=" 10%">NOMOR KK</th>
                        <th width="20%">NAMA</th>
                        <th width="10%">NIK</th>
                        <th width="5%">RT</th>
                        <th width="5%">RW</th>
                        <th width="30%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($warga as $index => $item)
                    <tr>
                        <th scope="row">{{ $loop->index + 1}}</th>
                        <td>{{$item->no_kk}}</td>
                        <td>{{$item->nama_lengkap}}</td>
                        <td>{{$item->nik}}</td>
                        <td>{{$item->rt}}</td>
                        <td>{{$item->rw}}</td>
                        <td class="text-center">
                            <a href="/warga/lihat/{{$item->id}}" class="btn btn-sm btn-primary m-1">Lihat</a>
                            <a href="/warga/ubah/{{$item->id}}" class="btn btn-sm btn-warning m-1">Ubah</a>
                            <a href="/warga/qrcode/{{$item->id}}" target="_blank" class="btn btn-sm btn-primary m-1">Qr
                                Code</a>
                            <a href="/warga/hapus/{{$item->id}}" class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin Hapus?');">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <div id="paginate">
                {{ $warga->links() }}
            </div>
        </div>
    </div>
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@include("warga.script")
@include("footer")
