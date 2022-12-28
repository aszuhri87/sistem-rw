@include("header")

@include("navbar")

<div class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="m-0 p-0">Ubah Data Admin</h5>
        <a href="/admin/tampil" class="btn btn-outline-danger">Kembali</a>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="/admin/post-ubah/{{$admin->id}}" method="POST" id="ubah">
                @csrf
                <div class="form-group mb-3">
                    <label>Nama</label>
                    <input type="text" value="{{$admin->nama}}" class="form-control" name="nama" placeholder="Nama">
                </div>

                <div class="form-group mb-3">
                    <label>Email</label>
                    <input type="text" value="{{$admin->email}}" class="form-control" name="email" placeholder="Email">
                </div>

                <div class="form-group mb-3">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password" placeholder="Password">
                </div>

                <div class="form-group mb-3">
                    <label>RT/RW</label>
                    <select name="rt" id="rt" class="form-control">
                        <option value=""> -- </option>
                        @foreach($rt as $item)
                        <option value="{{ $item->id }}">RT {{$item->rt}}/RW {{$item->rw}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>Level</label>
                    <select name="level" class="form-control" id="level">
                        <option value="">-- Level --</option>
                        <option value="admin"> Admin </option>
                        <option value="penjimpit"> Pengambil Jimpitan </option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-save">Simpan</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="{{asset('js/jquery.blockUI.js')}}"></script>
<script>
    $(document).ready(function () {

        var data = {!!json_encode($admin) !!};

        $('#ubah').find('select[name="level"]').find('option[value="' + data.level + '"]').prop('selected', true);
        $('#ubah').find('select[name="rt"]').find('option[value="' + data.id_rt_rw + '"]').prop('selected', true);
    });

</script>

@include('admin.script')
@include("footer")
