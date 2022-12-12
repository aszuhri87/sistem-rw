
<script type="text/javascript">
    $(document).ready(function() {
        $('#cari').on('keyup',function(e){
            $('tbody tr').remove();
            $('#paginate').remove();

            let value=$('#cari').val();

            $.ajax({
                type : 'get',
                async: false,
                cache: false,
                url : '/admin/filter',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'cari': value,
                },
        }).done(function(res, xhr, meta) {
            let data = res.data;

            data.forEach((item, i) => {
                    i+=1;

                    $('tbody').append(`
                    <tr>
                        <th scope="row">`+ i +`</th>
                        <td>`+ item.nama +`</td>
                        <td>`+item.email+`</td>
                        <td>`+item.rt+`</td>
                        <td>`+item.rw+`</td>
                        <td>`+item.level+`</td>
                        <td class="text-center">
                            <a href="/admin/ubah/`+item.id+`" class="btn btn-sm btn-warning m-1">Ubah</a>
                            <a href="/admin/hapus/`+item.id+`" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Hapus?');">Hapus</a>
                        </td>
                    </tr>`
                    );
                });

            if(data.length == 0){
                $('tbody').append(`<tr><p> Data tidak ditemukan! </p></tr>`);
            }

            })
            .fail(function(res, error) {
                console.error(res.responseJSON.message, 'Gagal')
            })
            .always(function() { });

        })
    });
</script>