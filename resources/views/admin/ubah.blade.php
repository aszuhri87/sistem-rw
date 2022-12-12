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
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" value="{{$admin->nama}}" class="form-control" name="nama" placeholder="Nama">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" value="{{$admin->email}}" class="form-control" name="email" placeholder="Email">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text"  class="form-control" name="password" placeholder="Password">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>RT</label>
                            <input type="text" value="{{$admin->rt}}" class="form-control" name="rt" placeholder="RT">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>RW</label>
                            <input type="text" value="{{$admin->rw}}" class="form-control" name="rw" placeholder="RW">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Level</label>
                            <select name="level" class="form-control" id="level">
                                <option value="">-- Level --</option>
                                <option value="admin"> Admin </option>
                                <option value="penjimpit"> Pengambil Jimpitan </option>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <script src="{{asset('js/jquery.blockUI.js')}}"></script>
        <script>
            $(document).ready(function () {

                var data = {!! json_encode($admin) !!};

                $('#ubah').find('select[name="level"]').find('option[value="'+ data.level+'"]').prop('selected', true);

                $('.btn-save').click(function () {
                    $.blockUI({
                        message: '<div class="d-flex justify-content-center align-items-center"><p class="mr-50 mb-0">Mohon Tunggu...</p> <div class="spinner-grow spinner-grow-sm text-white" role="status"></div> </div>',
                        css: {
                            backgroundColor: 'transparent',
                            color: '#fff',
                            border: '0'
                        },
                        overlayCSS: {
                            opacity: 0.5
                        },
                        timeout: 1000,
                        baseZ: 2000
                    });
                });
            });

        </script>
@include("footer")
