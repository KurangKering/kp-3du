  <style>
      .popover {
          z-index: 60000 !important;
      }

  </style>

  <v id="modal-create-lembar-disposisi" style="display: none;">
      <div class="card">
          <form class="form-horizontal" action="" id="frm-create-lembar-disposisi" method="post"
              enctype="multipart/form-data">

              <div class="card-body">

                  <div id="error-message">

                  </div>
                  <input type="hidden" name="peminjamanRuanganId" value="">
                  <input type="hidden" name="valueSubmit" value="">
                  <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="nama">Nama</label>
                      <div class="col-md-8">
                          <input class="form-control" readonly name="nama" id="nama" type="text">

                      </div>
                  </div>


                  <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="nama">Kegiatan</label>
                      <div class="col-md-8">
                          <input class="form-control" readonly name="kegiatan" id="kegiatan" type="text">

                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="nama">Ruangan</label>
                      <div class="col-md-8">
                          <input class="form-control" readonly name="ruangan" id="ruangan" type="text">

                      </div>
                  </div>
                  <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="waktu">Waktu Peminjaman</label>
                      <div class="col-md-8">
                          <input class="form-control" readonly name="waktu" id="waktu" type="text">

                      </div>
                  </div>

              </div>
              @php
                  $disposisiRoles = hHasDisposisiRoles();
              @endphp
              <div class="card-body">
                  <div class="form-group row">
                      <label class="col-md-4 col-form-label">Disposisi Kepada</label>
                      <div class="col-md-8 col-form-label">

                          <div class="form-check">
                              <input class="form-check-input" checked="" id="disposisiSatu" type="radio"
                                  value="{{ $disposisiRoles['1']['id'] }}" name="disposisiSatu">
                              <label class="form-check-label"
                                  for="disposisiSatu">{{ $disposisiRoles['1']['role_name'] }}</label>
                          </div>


                      </div>
                  </div>
              </div>
              <div class="card-footer text-right">
                  <button class="btn btn-danger mr-1 btn-create-disposisi" data-value="-1" type="button">Tolak</button>
                  <button class="btn btn-primary mr-1 btn-create-disposisi" data-value="1" type="button">Submit</button>
              </div>

          </form>

      </div>
      </div>



      <div id="modal-show-disposisi" style="display: none;">
          <div class="card">
              <form class="form-horizontal" action="" id="frm-detail-peminjaman" method="post"
                  enctype="multipart/form-data">

                  <div class="card-body">

                      <div id="error-message">

                      </div>
                      <div class="form-group row">
                          <label class="col-md-3 col-form-label" for="detNama">Nama</label>
                          <div class="col-md-9">
                              <input class="form-control" id="detNama" onkeydown="return false" type="text"
                                  name="detNama">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-md-3 col-form-label" for="detKegiatan">Kegiatan</label>
                          <div class="col-md-9">
                              <input class="form-control" id="detKegiatan" onkeydown="return false" type="text"
                                  name="detKegiatan">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-md-3 col-form-label" for="detRuangan">Ruangan</label>
                          <div class="col-md-9">
                              <input class="form-control" id="detRuangan" onkeydown="return false" type="text"
                                  name="detRuangan">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-md-3 col-form-label" for="detWaktu">Waktu</label>
                          <div class="col-md-9">
                              <input class="form-control" id="detWaktu" onkeydown="return false" type="text"
                                  name="detWaktu">
                          </div>
                      </div>

                  </div>
              </form>

              <div class="card-footer text-right">

              </div>
          </div>
          <div class="card">
              <form class="form-horizontal" action="" id="frm-show-disposisi" method="post"
                  enctype="multipart/form-data">

                  <div class="card-body">
                      <div class="table-responsive">
                          <table class="table table-striped table-bordered">
                              <thead>
                                  <tr>
                                      <th style="text-align: center">Dari</th>
                                      <th style="text-align: center">Kepada</th>
                                      <th style="text-align: center">Isi Disposisi</th>
                                  </tr>
                              </thead>
                              <tbody id="tbody-isi-disposisi">

                              </tbody>
                          </table>
                      </div>
                      <div id="error-message">

                      </div>
                      <input type="hidden" name="valueSubmit" value="">
                      <input type="hidden" name="peminjaman_ruangan_id" value="">


                  </div>
                  <hr>
                  <div class="submit-area" style="display: none">

                      <div class="card-body">
                          <div class="hide-dulu" style="display: none">
                              <form action="" class="form-horizontal">

                                  <div class="form-group row" id="data_1">
                                      <label class="col-md-4 col-form-label" for="detWaktuMulai">Tanggal </label>
                                      <div class="col-md-8">
                                          <div class="input-group-date">
                                              <input onkeydown="return false" class="form-control date"
                                                  id="inputTanggal" type="text" name="inputTanggal">

                                          </div>

                                      </div>
                                  </div>
                                  <div class="form-group row" id="data_2">
                                      <label class="col-md-4 col-form-label" for="detWaktuMulai">Waktu Mulai
                                      </label>
                                      <div class="col-md-8">
                                          <div class="input-group clockpicker" id="waktu-mulai">
                                              <input onkeydown="return false" type="text" name="inputWaktuMulai"
                                                  id="inputWaktuMulai" class="form-control">

                                          </div>

                                      </div>
                                  </div>
                                  <div class="form-group row" id="data_3">
                                      <label class="col-md-4 col-form-label" for="detWaktuMulai">Waktu Selesai
                                      </label>
                                      <div class="col-md-8">
                                          <div class="input-group clockpicker" id="waktu-selesai">
                                              <input onkeydown="return false" type="text" name="inputWaktuSelesai"
                                                  id="inputWaktuSelesai" class="form-control">

                                          </div>

                                      </div>
                                  </div>


                              </form>
                          </div>
                      </div>

                      <div class="card-footer">
                          <div class="row">
                              <div class="col-md-6">

                                  <button class="btn btn-danger mr-1 btn-submit-peminjaman" data-value="-1"
                                      type="button">Tolak</button>
                              </div>
                              <div class="col-md-6 text-right">
                                  <button class="btn btn-primary mr-1 " id="btnTerima" type="button">Terima</button>

                              </div>
                          </div>
                      </div>
                  </div>


              </form>

          </div>
      </div>


      @section('js')
          @parent
          <script>
              let $modalShow = $("#modal-show-disposisi");
              let $modalCreate = $("#modal-create-lembar-disposisi");



              $modalCreate.iziModal({
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
              var tanggalDate = '';
              var varWaktuMulai = '';
              var varWaktuSelesai = '';

              $modalShow.iziModal({
                  subtitle: '',
                  zindex: 5000,
                  width: 800,

                  headerColor: '#6777ef',
                  onOpening: function(modal) {

                  },
                  onOpened: function(modal) {


                  },
                  onClosed: function(modal) {
                      tanggalDate.datepicker("destroy");
                  }

              });


              $(".btn-create-disposisi").click(function(e) {
                  e.preventDefault();
                  let val = $(this).data('value');
                  submitCreateLembarDisposisi(val);

              });
              $(".btn-submit-peminjaman").click(function(e) {
                  e.preventDefault();
                  let val = $(this).data('value');
                  submitPeminjaman(val);

              });
              var show_disposisi = function(id) {


                  url = SITE_URL + 'private/lembar_disposisi/info/' + id;
                  let $el = $("#tbody-isi-disposisi");
                  $el.empty();
                  $.ajax({
                          url: url,
                          type: 'GET',
                          dataType: 'json',
                      })
                      .done(function(response) {


                          $("#btnTerima").click(function(e) {
                              location.href = SITE_URL + 'private/peminjaman_ruangan/terima_peminjaman/' +
                                  response.peminjaman_ruangan_id;
                          });



                          $("input[name='peminjaman_ruangan_id']").val(response.peminjaman_ruangan_id);
                          let peminjaman = response.peminjaman_ruangan;

                          $("#detNama").val(peminjaman.nama);
                          $("#detKegiatan").val(peminjaman.kegiatan);
                          $("#detRuangan").val(peminjaman.ruangan.nama);
                          $("#detWaktu").val(peminjaman.tanggalWaktu);


                          $('.submit-area').css('display', 'none');

                          if (response.status == '2') {
                              if (peminjaman.status != '2' && peminjaman.status != '-1') {
                                  $(".submit-area").css('display', 'unset');
                              }
                          }



                          $.each(response.isi_disposisi, function(index, val) {
                              var tr = $("<tr/>");
                              tr.append($("<td/>", {
                                      text: val.from_role.role_name,
                                      style: "vertical-align:middle;width:20%;",
                                  }))
                                  .append($("<td/>", {
                                      text: val.destination_role.role_name,
                                      style: "vertical-align:middle;width:20%;",
                                      class: 'text-center'
                                  }))
                                  .append($("<td/>", {
                                      text: val.isiDisposisi,
                                      style: "vertical-align:middle;",
                                      class: 'text-center'
                                  }));
                              $el.append(tr);
                          });

                          $modalShow.iziModal('setTitle', 'Data Disposisi');
                          $modalShow.iziModal("open");
                          tanggalDate = $('#data_1 .date').datepicker({
                              keyboardNavigation: false,
                              forceParse: false,
                              calendarWeeks: true,
                              autoclose: true,
                              format: "dd-mm-yyyy",
                          });
                          varWaktuMulai = $('#waktu-mulai').clockpicker({
                              autoclose: true,
                              placement: 'top',
                              afterDone: function() {
                                  var mulai = varWaktuMulai.find('input').val();
                                  var selesai = varWaktuSelesai.find('input').val();

                                  if (selesai != '' && selesai < mulai) {
                                      alert('selesai lebih kecil dari mulai');
                                  }

                              }

                          });

                          varWaktuSelesai = $('#waktu-selesai').clockpicker({
                              autoclose: true,
                              placement: 'top',
                              afterDone: function() {
                                  var mulai = varWaktuMulai.find('input').val();
                                  var selesai = varWaktuSelesai.find('input').val();

                                  if (mulai != '' && selesai < mulai) {
                                      alert('selesai lebih kecil dari mulai');
                                  }
                              },
                          });



                          varWaktuMulai.find('input').val(response.peminjaman_ruangan.waktuMulai);
                          varWaktuSelesai.find('input').val(response.peminjaman_ruangan.waktuSelesai);
                          tanggalDate.datepicker('update', response.peminjaman_ruangan.tanggal);

                          document.activeElement.blur()



                          console.log("success");
                      })
                      .fail(function() {
                          console.log("error");
                      })
                      .always(function() {
                          console.log("complete");
                      });


              }
              var show_modal = function(id) {
                  clear_modal();

                  if (id) {
                      $.ajax({
                              url: SITE_URL + 'private/peminjaman_ruangan/info/' + id,
                              type: 'GET',
                              dataType: 'json',

                          })
                          .done(function(data) {


                              $("button[type='submit']").text('Disposisi');

                              $modalCreate.iziModal('setTitle', 'Form Lembar Disposisi');

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

                      $modalCreate.iziModal('setTitle', 'Form Input Pengguna Baru');
                      $modalCreate.iziModal("open");
                  }
              }
              var set_modal_data = function(data) {

                  $("#error-message").html("");
                  $("input[name='peminjamanRuanganId']").val(data.id);
                  $("input[name='nama']").val(data.nama);
                  $("input[name='kegiatan']").val(data.kegiatan);
                  $("input[name='ruangan']").val(data.ruangan.nama);
                  $("input[name='waktu']").val(data.waktu_mulai + ' - ' + data.waktu_selesai);

                  $modalCreate.iziModal('open');
                  $("#modal-create-lembar-disposisi .iziModal-wrap").scrollTop(0);
              }

              var submitPeminjaman = function(valSubmit) {


                  var url = SITE_URL + 'private/peminjaman_ruangan/update';
                  $("input[name='valueSubmit']").val(valSubmit);
                  $(".btn-submit-peminjaman").attr('disabled', true);
                  var formData = $('#frm-show-disposisi').serializeArray();
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
                              $("#modal-create-lembar-disposisi .iziModal-wrap").scrollTop(0);
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
                          $(".btn-submit-peminjaman").attr('disabled', false);
                          console.log("complete post");
                      });


              }
              var submitCreateLembarDisposisi = function(valSubmit) {


                  var url = SITE_URL + 'private/lembar_disposisi/create';
                  $("input[name='valueSubmit']").val(valSubmit);
                  $(".btn-create-disposisi").attr('disabled', true);
                  var formData = $('#frm-create-lembar-disposisi').serializeArray();

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
                              $("#modal-create-lembar-disposisi .iziModal-wrap").scrollTop(0);
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
                          $(".btn-create-disposisi").attr('disabled', false);
                          console.log("complete post");
                      });


              }
              var delete_ruangan = function(id) {
                  Swal.fire({
                      title: 'Hapus ?',
                      text: "Yakin ingin menghapus ruangan ini ?",
                      type: 'warning',
                      showCancelButton: true,
                      cancelButtonColor: '#3085d6',
                      confirmButtonColor: '#d33',
                      confirmButtonText: 'Ya, Hapus!'
                  }).then((result) => {
                      if (result.value) {
                          $.ajax({
                                  url: SITE_URL + 'private/ruangan/delete/ruangan/' + id,
                                  type: 'GET',
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
              var clear_modal = function() {
                  $("#error-message").html("");
                  $("input[name='id']").val("");
                  $("input[name='nama']").val("");
                  $('.input-data').attr('disabled', false);

              }
          </script>
      @endsection
