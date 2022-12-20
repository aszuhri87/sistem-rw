@include("header")

<div class="container mt-5 mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="m-0 p-0">Input Kas Warga</h5>
                <a href="/kas-warga/tampil" class="btn btn-danger">Kembali</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="{{url('kas-warga/post-tambah')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Nominal</label>
                            <input type="text" class="form-control" name="nominal" required placeholder="Nominal">
                        </div>
                        <br>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" required placeholder="Tanggal">
                        </div>
                        @if( Auth::user()->level == 'admin' && Auth::user()->id_rt_rw == null)
                        <div class="form-group mb-3">
                            <label>RT/RW</label>
                            <select name="rt" id="rt" class="form-control" required>
                                <option value=""> -- </option>
                                @foreach($rt as $item)
                                    <option value="{{ $item->id }}">RT {{$item->rt}}/RW {{$item->rw}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="form-group">
                            <label>Tipe</label>
                            <select name="tipe" id="tipe" class="form-control" required>
                                <option value=""> -- Pilih Tipe --</option>
                                <option value="masuk"> Masuk </option>
                                <option value="keluar"> Keluar </option>
                            </select>
                        </div>

                        <div class="form-group div-kategori d-none">

                        </div>

                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea class="form-control" name="catatan" id="catatan" cols="30" rows="10"></textarea>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary btn-save">Simpan</button>
                    </form>
                </div>
            </div>
        </div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{asset('js/jquery.blockUI.js')}}"></script>
@include('kas-warga.script')
@include("footer")
