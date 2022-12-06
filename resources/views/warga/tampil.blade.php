@include("header")

@include("navbar")

<div class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="m-0 p-0">Data Kependudukan Warga</h5>
        <div>
            <a href="/warga/import" class="btn btn-primary">Import Warga</a>
            <a href="/warga/tambah" class="btn btn-success">Tambah</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table width="100%" class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th width="30%">NOMOR KK</th>
                        <th width="20%">NAMA</th>
                        <th width="20%">NIK</th>
                        <th width="30%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($warga as $index => $item)
                    <tr>
                        <td>{{$index + 1}}</td>
                        <td>{{$item->no_kk}}</td>
                        <td>{{$item->nama_lengkap}}</td>
                        <td>{{$item->nik}}</td>
                        <td class="text-center">

                            <a href="/warga/lihat/{{$item->id}}" class="btn btn-sm btn-primary">Lihat</a>
                            <a href="/warga/ubah/{{$item->id}}" class="btn btn-sm btn-warning">Ubah</a>
                            <a href="/warga/qr/{{$item->id}}" class="btn btn-sm btn-primary">Qr Code</a>
                            <a href="/warga/hapus/{{$item->id}}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Hapus?');">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include("footer")