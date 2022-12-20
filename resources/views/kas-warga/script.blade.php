<script type = "text/javascript" >
    $(document).ready(function () {
        $('#tipe').on('change', function (e) {
            if($(this).val() == 'masuk'){
                $('.kategori').removeClass('d-none').html(`
                    <label>Pilih Kategori</label>
                    <select name="kategori" id="kategori" class="form-control ">
                        <option value=""> -- Pilih Kategori --</option>
                        <option value="Iuran sampah"> Iuran sampah </option>
                        <option value="Sponsorship/donatur"> Sponsorship/donatur </option>
                        <option value="Sewa perlengkapan"> Sewa perlengkapan </option>
                        <option value="Parkir"> Parkir </option>
                        <option value="Sewa tempat"> Sewa tempat </option>
                        <option value="Peralenan"> Peralenan </option>
                        <option value="Lain-lain"> Lain-lain </option>
                    </select>
                `);
            } else if ($(this).val() == 'keluar'){
                $('.kategori').removeClass('d-none').html(`
                    <label>Pilih Kategori</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value=""> -- Pilih Kategori --</option>
                        <option value="Santunan"> Santunan </option>
                        <option value="Kerjabakti"> Kerjabakti  </option>
                        <option value="Kegiatan"> Kegiatan </option>
                        <option value="Belanja"> Belanja  </option>
                        <option value="Perawatan"> Perawatan</option>
                        <option value="Konsumsi"> Konsumsi </option>
                        <option value="Perlengkapan"> Perlengkapan  </option>
                        <option value="Peralenan"> Peralenan </option>
                        <option value="Iuran sampah"> Iuran sampah </option>
                        <option value="Lain-lain"> Lain-lain </option>
                    </select>
                `);
            } else {
                $('.kategori').addClass('d-none');
            }
        });

        $('#filter').on('click', function (e) {
            $('tbody tr').remove();
            $('#paginate').remove();

            let value = $('#filter_type').val();
            let ke = $('#ke').val();
            let dari = $('#dari').val();

            $.ajax({
                    type: 'get',
                    async: false,
                    cache: false,
                    url: '/kas-warga/filter',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'cari': value,
                        'ke': ke,
                        'dari': dari
                    },
                }).done(function (res, xhr, meta) {
                    let data = res.data;

                    data.forEach((item, i) => {
                        i += 1;

                        $('tbody').append(`
                    <tr>
                        <th scope="row">` + i + `</th>
                        <td>` + item.nominal + `</td>
                        <td>` + item.tanggal + `</td>
                        <td>` + item.tipe + `</td>
                        <td>` + item.rt + `</td>
                        <td>` + item.rw + `</td>
                        <td class="text-center">
                            <a href="/kas-warga/ubah/` + item.id + `" class="btn btn-sm btn-warning m-1">Ubah</a>
                            <a href="/kas-warga/hapus/` + item.id + `" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Hapus?');">Hapus</a>
                        </td>
                        </tr>`);
                    });

                })
                .fail(function (res, error) {
                    console.error(res.responseJSON.message, 'Gagal')
                })
                .always(function () {});

        })
    });
</script>
