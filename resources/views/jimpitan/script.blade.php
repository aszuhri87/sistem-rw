
<script type="text/javascript">
    $(document).ready(function() {
        $('#filter').on('click',function(e){
            $('tbody tr').remove();
            $('#paginate').remove();

            let value=$('#cari').val();
            let ke=$('#ke').val();
            let dari = $('#dari').val();

            $.ajax({
                type : 'get',
                async: false,
                cache: false,
                url : '/jimpitan/filter',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'cari': value,
                    'ke': ke,
                    'dari': dari
                },
        }).done(function(res, xhr, meta) {
            let data = res.data;

            data.forEach((item, i) => {
                    i+=1;

                    $('tbody').append(`
                    <tr>
                        <th scope="row">`+ i +`</th>
                        <td>`+item.nama_lengkap+`</td>
                        <td>`+item.tanggal+`</td>
                        <td>`+ item.nominal +`</td>
                        <td class="text-center">
                            <a href="/jimpitan/ubah/`+item.id+`" class="btn btn-sm btn-warning">Ubah</a>
                            <a href="/jimpitan/hapus/`+item.id+`" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Hapus?');">Hapus</a>
                        </td>
                        </tr>`
                    );
                });

            })
            .fail(function(res, error) {
                console.error(res.responseJSON.message, 'Gagal')
            })
            .always(function() { });

        })
    });
</script>
