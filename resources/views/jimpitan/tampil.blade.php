@include ("header")
@include ("navbar")

<body>
    <div class="container mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="m-0 p-0">Data Jimpitan</h5>
                <a href="/jimpitan/tambah" class="btn btn-success">Tambah</a>
        </div>
        <div class="card">
            <div class="card-body">
                <table width="100%" class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th width="20%">ID Warga </th>
                            <th width="30%">Nama </th>
                            <th width="30%">Nominal </th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jimpitan as $index => $item)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$item->id_warga}}</td>
                            <td>{{$item->nama_lengkap}}</td>
                            <td>{{$item->nominal}}</td>
                            <td class="text-center">
                                <a href="/jimpitan/ubah/{{$item->id}}" class="btn btn-sm btn-warning">Ubah</a>
                                <a href="/jimpitan/hapus/{{$item->id}}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Hapus?');">Hapus</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include ("footer")
