  <div id="modal-detail" style="display: none;">
      <form id="frm-peminjaman">
          <input type="hidden" name="id" value="">
          <input type="hidden" name="type" value="get">
          <div class="card">
              <div class="card-body">
                  <div id="error-message">

                  </div>
                  <div class="form-group">
                      <label><strong>Tanggal</strong></label>

                      <input type="text" name="tanggal" onkeydown="return false" id="tanggal" class="form-control">
                  </div>


              </div>

              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-striped table-bordered">

                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Nama Inventaris</th>
                                  <th>Jumlah</th>
                              </tr>
                          </thead>
                          <tbody id="table-det-pengajuan">

                          </tbody>
                      </table>
                  </div>
              </div>
              <div class="card-footer submit-area">
                  <div class="row">
                      <div class="col-md-6">
                          <button class="btn btn-warning mr-1  btn-submit" data-value="-1" type="button">Tolak</button>
                      </div>
                      <div class="col-md-6 text-right">
                          <button class="btn btn-primary mr-1 btn-submit" data-value="2" type="button">Terima</button>
                      </div>
                  </div>
              </div>
          </div>
      </form>
  </div>


  @section('js')
      @parent
      <script>
          $("#modal-detail").iziModal({
              subtitle: '',
              zindex: 5000,

              headerColor: '#6777ef',
              onOpening: function(modal) {
                  // modal.startLoading();
              },
              onOpened: function(modal) {
                  // modal.stopLoading();
              },

          });

          $(".btn-submit").click(function(e) {
              e.preventDefault();
              let val = $(this).data('value');
              submit_peminjaman(val);

          })
          var show_modal = function(id) {
              clear_modal();

              if (id) {
                  $.ajax({
                          url: SITE_URL + 'private/pengajuan_inventaris/info/' + id,
                          type: 'GET',
                          dataType: 'json',

                      })
                      .done(function(data) {


                          $("button[type='submit']").text('Simpan');

                          $("#modal-detail").iziModal('setTitle', 'Detail Pengajuan Inventaris');

                          set_modal_data(data);


                      })
                      .fail(function() {
                          console.log("error retrieve");
                      })
                      .always(function() {
                          console.log("complete retrieve");
                      });


              } else {
                  $("input[name='type']").val("new");
                  $("button[type='submit']").text('Tambah');

                  $("#modal-detail").iziModal('setTitle', 'Form Input Pengguna Baru');
                  $("#modal-detail").iziModal("open");
              }
          }
          var set_modal_data = function(data) {

              $("#error-message").html("");
              $("input[name='tanggal']").val(data.tanggal);
              var el = $("#table-det-pengajuan");
              el.empty();
              var noPage = 1;
              $.each(data.det_pengajuan_inventaris.reverse(), function(index, val) {

                  var tr = $("<tr/>");
                  tr.append($("<td/>", {
                          text: noPage,
                          class: 'text-center',
                          style: "vertical-align:middle;",
                      }))
                      .append($("<td/>", {
                          text: val.daftar_inventaris.nama,
                          style: "vertical-align:middle;",
                      }))
                      .append($("<td/>", {
                          text: val.jumlah + ' ' + val.daftar_inventaris.satuan,
                          style: "vertical-align:middle;",
                          class: 'text-center'
                      }))
                      .append($("<input>", {
                          type: "hidden",
                          name: "status",
                          value: '',
                      }));
                  el.append(tr);
                  noPage++;
              });
              console.log(data);
              if (data.status != 0) {
                  $(".submit-area").hide();

              } else {
                  $(".submit-area").show();

              }

              $("#modal-detail").iziModal('open');
              $("#modal-detail .iziModal-wrap").scrollTop(0);
          }
          var submit_peminjaman = function(valSubmit) {
              $("input[name='status']").val(valSubmit);

              var url = SITE_URL + 'private/peminjaman_barang/proses';

              $(".btn-submit").attr('disabled', true);
              var formData = $('#frm-peminjaman').serializeArray();

              $.ajax({
                      url: url,
                      type: 'POST',
                      dataType: 'json',
                      data: formData,
                  })
                  .done(function(resp) {


                      console.log(resp);
                      $('#error-message').html("");
                      if (resp.status == 'error') {
                          $("#error-message").html(
                              `<div class=\"alert alert-danger\">
         <strong>Ooops!</strong> Terdapat Error.<br><br>
         ` +
                              resp.messages +
                              `
         </div>
         `);
                          $("#modal-detail .iziModal-wrap").scrollTop(0);
                      } else if (resp.status == 'success') {
                          swalInfo('Berhasil', 'success', '', '2000')
                              .then((result) => {

                                  location.reload();

                              })
                      } else {
                          alert('gagal');
                      }
                  })
                  .fail(function() {
                      console.log("error post");
                  })
                  .always(function() {
                      $(".btn-submit").attr('disabled', false);
                      console.log("complete post");
                  });


          }

          var clear_modal = function() {
              $("#error-message").html("");
              $("input[name='id']").val("");
              $("input[name='nama']").val("");
              $('.input-data').attr('disabled', false);

          }

          var show_delete = function(id) {
              Swal.fire({
                  title: 'Hapus ?',
                  text: "Yakin ingin menghapus Data ini ?",
                  type: 'warning',
                  showCancelButton: true,
                  cancelButtonColor: '#3085d6',
                  confirmButtonColor: '#d33',
                  confirmButtonText: 'Ya, Hapus!'
              }).then((result) => {
                  if (result.value) {
                      $.ajax({
                              url: SITE_URL + 'private/pengajuan_inventaris/delete/',
                              type: 'POST',
                              data: {
                                  id: id
                              },
                              dataType: 'json',

                          })
                          .done(function(data) {

                              swalInfo('Berhasil', 'success', '', '2000')
                                  .then((res) => {

                                      location.reload();
                                  })

                          })
                          .fail(function() {
                              console.log("error retrieve");
                          })
                          .always(function() {
                              console.log("complete retrieve");
                          });
                  }


              })
          }
      </script>
  @endsection
