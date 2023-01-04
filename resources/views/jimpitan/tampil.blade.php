@include ('header') @include ('navbar')

<body>
    <div class="container mb-5">
        @if ($errors->has('error'))
            <div class="alert alert-danger mt-3" style="text-align: left" role="alert">
                {{ $errors->first('error') }}
            </div>
            @endif @if (session('message'))
                <div class="alert alert-success mt-3" style="text-align: left" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="m-0 p-0">Data Jimpitan</h5>
            </div>
            <div class="row d-none mb-3" id="filter_card">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        Dari :
                                        <input type="date" name="dari" id="dari" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        Sampai :
                                        <input type="date" name="ke" id="ke" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control mt-4" id="cari" name="cari"
                                            placeholder="Cari.." />
                                    </div>
                                    <div class="form-group mb-3" style="margin-top: 40px">
                                        <select name="kategori" class="form-control" id="kategori">
                                            <option value="">Semua</option>
                                            <option value="Harian">Harian</option>
                                            <option value="Mingguan">Mingguan</option>
                                            <option value="Bulanan">Bulanan</option>
                                            <option value="Tahunan">Tahunan</option>
                                        </select>
                                    </div>
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
                            <div class="d-flex mb-3">
                                <a href="/jimpitan/tambah" class="btn btn-success p-2 mr-auto"
                                    style="margin-top: auto; margin-bottom: auto">Tambah</a>
                                <div>
                                    @if (Auth::user()->level == 'admin')
                                        <a href="/jimpitan/export" class="btn btn-primary p-2 ml-1">Laporan Excel</a>
                                    @endif
                                    <a class="btn btn-secondary p-2 m-1" id="filter_btn">Filter</a>
                                </div>
                            </div>
                            <table width="100%" class="table-bordered table-responsive table mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th width="30%">Nama</th>
                                        <th width="15%">Tanggal</th>
                                        <th width="15%">Nominal</th>
                                        <th width="20%">Kategori</th>
                                        <th width="20%" class="text-center">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jimpitan as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->nama_lengkap }}</td>
                                            <td>
                                                {{ date('d-m-Y H:i:s', strtotime($item->tanggal)) }}
                                            </td>
                                            <td>{{ $item->nominal }}</td>
                                            <td>{{ $item->kategori }}</td>
                                            <td class="text-center">
                                                <a href="/jimpitan/ubah/{{ $item->id }}"
                                                    class="btn btn-sm btn-warning m-1">Ubah</a>
                                                <a href="/jimpitan/hapus/{{ $item->id }}"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin Hapus?');">Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br />
                            <div id="paginate">{{ $jimpitan->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    @include('jimpitan.script') @include ('footer')
</body>
