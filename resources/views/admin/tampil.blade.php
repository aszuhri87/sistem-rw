@include("header")

@include("navbar")

<div class="container mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="m-0 p-0">Data Account Admin</h5>
                <a href="/admin/get-tambah" class="btn btn-success">Tambah</a>
            </div>
            <div class="card">
                <div class="card-body"> 
                    <table width="100%" class="table table-bordered mb-0">
                        <thead>
                            <tr>
                            <th>No</th>
                                <th width="30%">Nama</th> 
                                <th width="30%">Email</th> 
                                <th width="20%">Password</th> 
                                <th width="20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admin as $index => $item)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$item->nama}}</td> 
                                <td>{{$item->email}}</td> 
                                <td>{{$item->password}}</td> 
                                <td class="text-center">
                                    <a href="/admin/get-ubah/{{$item->id}}" class="btn btn-sm btn-warning">Ubah</a>
                                    <a href="/admin/get-hapus/{{$item->id}}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Hapus?');">Hapus</a>
                                </td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include("footer")