@include("header")

@include("navbar")

        <div class="container mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="m-0 p-0">Data Kas Warga</h5>
                <div>
                <a href="/kas-warga/tambah" class="btn btn-success">Tambah</a>    
                </div>
            </div>
            <div class="card">
                <div class="card-body"> 
                    <table width="100%" class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>No</th>  
                                <th width="35%">NOMINAL</th> 
                                <th width="35%">TANGGAL</th> 
                                <th width="30%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kas_warga as $index => $item)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{$item->nominal}}</td>
                                <td>{{$item->tanggal}}</td>
                                <td class="text-center"> 
                                    <a href="/kas-warga/ubah/{{$item->id}}" class="btn btn-sm btn-warning">Ubah</a>
                                    <a href="/kas-warga/hapus/{{$item->id}}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Hapus?');">Hapus</a>
                                </td>
                            </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

@include("footer")