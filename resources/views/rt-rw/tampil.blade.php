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
                <h5 class="m-0 p-0">Data RT/RW</h5>
                <div class="mb-3">
                    <input type="text" class="form-control" id="cari" name="cari" placeholder="Cari..">
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="/rt-rw/tambah" class="btn btn-success">Tambah</a>
                    </div>
                    <table width="100%" class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th width="30%">RT</th>
                                <th width="30%">RW</th>
                                <th width="30%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rt_rw as $index => $item)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$item->rt}}</td>
                                <td>{{$item->rw}}</td>
                                <td class="text-center">
                                    <a href="/rt-rw/get-ubah/{{$item->id}}" class="btn btn-sm btn-warning m-1">Ubah</a>
                                    <a href="/rt-rw/hapus/{{$item->id}}" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Hapus?');">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div id="paginate">
                        {{ $rt_rw->links() }}
                    </div>
                </div>
            </div>
        </div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@include('rt-rw.script')
@include("footer")
