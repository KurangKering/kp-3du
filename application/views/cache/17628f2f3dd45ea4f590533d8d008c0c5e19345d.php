  <div id="modal-isi-disposisi" style="display: none;">


    <div class="card">
     <form class="form-horizontal" action="" id="frm-isi-disposisi" method="post" enctype="multipart/form-data">

      <div class="card-body">

       <div id="error-message">

       </div>
       <input type="hidden" id="from_role_id" name="from_role_id" value="<?php echo e($currentRole->id); ?>">
       <input type="hidden" id="lembar_disposisi_id" name="lembar_disposisi_id" value="">
       <div class="form-group row">
        <label class="col-md-4 col-form-label" for="nama">Dari</label>
        <div class="col-md-8">
         <?php echo e($currentRole->role_name); ?>

       </div>

     </div>
     <div class="form-group row">
      <label class="col-md-4 col-form-label" for="isi_disposisi">Isi Disposisi</label>
      <div class="col-md-8 col-form-label">
        <select class="form-control" name="isi_disposisi" id="isi_disposisi">
          <?php $__currentLoopData = hIsiDisposisi(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $isi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($val); ?>"><?php echo e($isi); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        
      </div>

    </div>
    <div id="area-penolakan">
      
    </div>


  </div>

  
  <div class="card-footer text-right">
    <button class="btn btn-primary mr-1" type="submit">Submit</button>
  </div>

</form>

</div>
</div>


<div id="modal-detail-peminjaman" style="display: none;">


  <div class="card">
   <form class="form-horizontal" action="" id="frm-detail-peminjaman" method="post" enctype="multipart/form-data" >

    <div class="card-body">

     <div id="error-message">

     </div>
     <div class="form-group row">
      <label class="col-md-3 col-form-label" for="detNama">Nama</label>
      <div class="col-md-9">
        <input class="form-control" id="detNama" onkeydown="return false" type="text" name="detNama">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-md-3 col-form-label" for="detKegiatan">Kegiatan</label>
      <div class="col-md-9">
        <input class="form-control" id="detKegiatan" onkeydown="return false" type="text" name="detKegiatan">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-md-3 col-form-label" for="detRuangan">Ruangan</label>
      <div class="col-md-9">
        <input class="form-control" id="detRuangan" onkeydown="return false" type="text" name="detRuangan">
      </div>
    </div><div class="form-group row">
      <label class="col-md-3 col-form-label" for="detWaktu">Waktu</label>
      <div class="col-md-9">
        <input class="form-control" id="detWaktu" onkeydown="return false" type="text" name="detWaktu">
      </div>
    </div>



  </div>


  <div class="card-footer text-right">
  </div>

</form>

</div>
</div>






<?php $__env->startSection('js'); ?>
##parent-placeholder-93f8bb0eb2c659b85694486c41717eaf0fe23cd4##
<script>
  $(function() {
    let $areaPenolakan = $("#area-penolakan");
    $("#isi_disposisi").on('change', function(event) {
      var valIsi = $(this).find("option:selected").val();
      if (valIsi === '-1') {
        $areaPenolakan.html(`
          <div class="form-group row">
          <label class="col-md-4 col-form-label" for="isi_penolakan">Isi Penolakan</label>
          <div class="col-md-8 col-form-label">
          <textarea name="isi_penolakan" required id="isi_penolakan" class="form-control"></textarea>
          </div>
          </div>
          `);
      } else {
        $areaPenolakan.html("");
      }
    });

  });
  let $modalIsiDisposisi = $("#modal-isi-disposisi");
  let $modalDetailPeminjaman = $("#modal-detail-peminjaman");

  let $inputIsiDisposisi = $("#isi_disposisi");

  $modalIsiDisposisi.iziModal({
    subtitle: '',
    zindex: 5000,

    headerColor: '#6777ef',
    onOpening: function(modal){
      // modal.startLoading();
    },
    onOpened: function(modal){
      // modal.stopLoading();
    },

  });
  $modalDetailPeminjaman.iziModal({
    subtitle: '',
    zindex: 5000,

    headerColor: '#6777ef',
    onOpening: function(modal){
      // modal.startLoading();
    },
    onOpened: function(modal){
      // modal.stopLoading();
    },

  });
  
  $("#frm-isi-disposisi").submit(function(e) {
    e.preventDefault();
    submitIsiDisposisi();

  })
  var show_peminjaman = function(id)
  {
    url = SITE_URL + 'private/peminjaman_ruangan/info/'+id;
    $.ajax({
      url: url,
      type: 'GET',
      dataType: 'json',
    })
    .done(function(response) {
      console.log("success");

      $("#detNama").val(response.nama);
      $("#detKegiatan").val(response.kegiatan);
      $("#detRuangan").val(response.ruangan.nama);
      $("#detWaktu").val(response.tanggal);

      $modalDetailPeminjaman.iziModal('setTitle', 'Detail Peminjaman Ruangan');
      $modalDetailPeminjaman.iziModal("open");

    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
    
  }
  var show_modal = function(id)
  {
    clear_modal();

    $("#lembar_disposisi_id").val(id);
    $("button[type='submit']").text('Disposisi');

    $modalIsiDisposisi.iziModal('setTitle', 'Form Isi Disposisi');
    $modalIsiDisposisi.iziModal("open");
  }

  var set_modal_data = function(data)
  {

    $("#error-message").html("");
    $("input[name='lembarDisposisiId']").val(data.id);
    $("input[name='nama']").val(data.nama);
    $("input[name='number_id']").val(data.number_id);
    $("input[name='pekerjaan']").val(data.pekerjaan);
    $("input[name='keperluan']").val(data.keperluan.keperluan);
    $("input[name='ruangan']").val(data.ruangan.nama);
    $("input[name='waktu']").val(data.waktu_mulai + ' - '+ data.waktu_selesai);
    $("input[name='tgl_peminjaman']").val(data.tgl_peminjaman);

    $modalIsiDisposisi.iziModal('open');
    $("#modal-isi-disposisi .iziModal-wrap").scrollTop(0);            
  }
  var submitIsiDisposisi = function()
  {
    var url = SITE_URL + 'private/isi_disposisi/create';

    $("button[type='submit']").attr('disabled', true);
    var formData = $('#frm-isi-disposisi').serializeArray();

    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: formData,
    })
    .done(function(resp) {
      console.log(resp);

      $('#error-message').html("");
      if (resp.status == 'error') 
      {
       $("#error-message").html(
         `<div class=\"alert alert-danger\">
         <strong>Ooops!</strong> Terdapat Error.<br><br>
         `
         +resp.messages+
         `
         </div>
         `);
       $("#modal-isi-disposisi .iziModal-wrap").scrollTop(0);  
     } else if (resp.status == 'success')
     {
      swalInfo('Berhasil', 'success','','2000')
      .then((result) => {
        location.reload();

      })
    } else 
    {
      swalInfo('Gagal', 'error','','2000')
      .then((result) => {


      })
    }
  })
    .fail(function() {
      console.log("error post");
    })
    .always(function() {
      $("button[type='submit']").attr('disabled', false);
      console.log("complete post");
    });


  }
  var delete_ruangan = function(id)
  {
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
        url: SITE_URL + 'private/ruangan/delete/ruangan/'+id,
        type: 'GET',
        dataType: 'json',

      })
       .done(function(data) {

        swalInfo('Berhasil', 'success','','2000')
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
  var clear_modal = function()
  {
    $("#error-message").html("");
    $("input[name='id']").val("");
    $("input[name='nama']").val("");
    $('.input-data').attr('disabled', false);

  }
</script>
<?php $__env->stopSection(); ?><?php /**PATH D:\xZeroxSugarx\xampp\htdocs\kp-edu\application\views/private/lembar_disposisi/modal_isi_disposisi.blade.php ENDPATH**/ ?>