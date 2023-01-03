<script type="text/javascript">
   $(document).ready(function () {
      $(".btn-save").click(function () {
         $.blockUI({
            message:
               '<div class="d-flex justify-content-center align-items-center"><p class="mr-50 mb-0">Mohon Tunggu...</p> <div class="spinner-grow spinner-grow-sm text-white" role="status"></div> </div>',
            css: {
               backgroundColor: "transparent",
               color: "#fff",
               border: "0",
            },
            overlayCSS: {
               opacity: 0.5,
            },
            timeout: 1000,
            baseZ: 2000,
         });
      });

      $("#filter_btn").on("click", function (e) {
         if ($("#filter_card").hasClass("d-none")) {
            $("#filter_card").removeClass("d-none");
            $("#filter_btn")
               .removeClass("btn-secondary")
               .addClass("btn-danger")
               .html("Tutup");
         } else {
            $("#filter_card").addClass("d-none");
            $("#filter_btn")
               .removeClass("btn-danger")
               .addClass("btn-secondary")
               .html("Filter");
         }
      });

      $(":input").on("change keyup", function (e) {
         $("tbody tr").remove();
         $("#paginate").remove();

         let value = $("#cari").val();
         let ke = $("#ke").val();
         let dari = $("#dari").val();
         let kategori = $("#kategori").val();

         $.ajax({
            type: "get",
            async: false,
            cache: false,
            url: "/jimpitan/filter",
            data: {
               _token: "{{ csrf_token() }}",
               cari: value,
               ke: ke,
               dari: dari,
               kategori: kategori,
            },
         })
            .done(function (res, xhr, meta) {
               let data = res.data;

               data.forEach((item, i) => {
                  i += 1;

                  $("tbody").append(
                     `
                    <tr>
                        <th scope="row">` +
                        i +
                        `</th>
                        <td>` +
                        item.nama_lengkap +
                        `</td>
                        <td>` +
                        item.tanggal +
                        `</td>
                        <td>` +
                        item.nominal +
                        `</td>
                        <td>` +
                        item.kategori +
                        `</td>
                        <td class="text-center">
                            <a href="/jimpitan/ubah/` +
                        item.id +
                        `" class="btn btn-sm btn-warning m-1">Ubah</a>
                            <a href="/jimpitan/hapus/` +
                        item.id +
                        `" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Hapus?');">Hapus</a>
                        </td>
                        </tr>`
                  );
               });
            })
            .fail(function (res, error) {
               console.error(res.responseJSON.message, "Gagal");
            })
            .always(function () {});
      });
   });
</script>
