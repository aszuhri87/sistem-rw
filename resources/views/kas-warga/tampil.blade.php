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
        <h5 class="m-0 p-0">Data Kas Warga</h5>
    </div>
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                Dari :
                                <input type="date" name="dari" id="dari" class="form-control">
                            </div>
                            <div class="form-group">
                                Sampai :
                                <input type="date" name="ke" id="ke" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-4">
                                <select class="form-control" name="filter_type" id="filter_type">
                                    <option value="">--Tipe--</option>
                                    <option value="masuk"> Masuk </option>
                                    <option value="keluar"> Keluar </option>
                                </select>
                            </div>
                            <div class="form-group div-kategori d-none" style="margin-top: 39px">
                                <select name="kategori" id="kategori" class="form-control">
                                    <option value=""> -- Pilih Kategori --</option>
                                </select>
                            </div>
                            {{-- <button class="btn btn-primary mt-4" id="filter"> Filter</button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <a href="/kas-warga/tambah" class="btn btn-success">Tambah</a>
                    </div>
                    <table width="100%" class="table table-bordered mb-0 table-responsive">
                        <thead>
                            <option value=""></option>
                            <tr>
                                <th>No</th>
                                <th width="20%">NOMINAL</th>
                                <th width="15%" class="text-center">TANGGAL</th>
                                <th width="5%">RT</th>
                                <th width="5%">RW</th>
                                <th width="10%" class="text-center">TIPE</th>
                                <th width="20%" class="text-center">KATEGORI</th>
                                <th width="25%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kas_warga as $index => $item)
                            <tr>
                                <th scope="row">{{ $index+1 }}</th>
                                <td>{{ $item->nominal }}</td>
                                <td class="text-center">{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
                                <td class="text-center">{{ $item->rt }}</td>
                                <td class="text-center">{{ $item->rw }}</td>
                                <td class="text-center">{{ $item->tipe }}</td>
                                <td class="text-center">{{ $item->kategori }}</td>
                                <td class="text-center">
                                    <a href="/kas-warga/lihat/{{$item->id}}"
                                        class="btn btn-sm btn-primary m-1">Lihat</a>
                                    <a href="/kas-warga/ubah/{{$item->id}}" class="btn btn-sm btn-warning m-1">Ubah</a>
                                    <a href="/kas-warga/hapus/{{$item->id}}" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin Hapus?');">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <div id="paginate">
                        {{$kas_warga->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@include('kas-warga.script')
@include("footer")
