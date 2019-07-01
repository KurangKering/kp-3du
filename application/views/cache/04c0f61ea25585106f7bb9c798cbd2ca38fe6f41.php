  <div id="modal-user" style="display: none;">
    <form  id="frm-user">
      <input type="hidden" name="id" value="">
      <input type="hidden" name="type" value="get">
      <div class="card">
        <div class="card-body">
         <div id="error-message">

         </div>
         <div class="form-group">
          <label>Nama</label>
          <input type="text" name="nama"  id="nama" class="form-control">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email"  id="email" class="form-control">
        </div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="username"  id="username" class="form-control">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password"  id="password" class="form-control">
        </div>
        <div class="form-group">
          <label>Hak Akses</label>
          <select class="form-control" name="role_id" id="role_id">
            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($k); ?>"><?php echo e($role); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


          </select>
        </div>




      </div>
      <div class="card-footer text-right">
        <button class="btn btn-primary mr-1" type="submit">Submit</button>
        <button class="btn btn-secondary" type="reset">Reset</button>
      </div>
    </div>
  </form>

</div>


<div id="modal-detail" style="display: none;">
  <div class="box">
    <div class="box-header"></div>
    <div class="box-body">
      <form  id="frm-detail" class="form-horizontal">
        <div class="form-group ">
          <label for="" class="control-label col-lg-3">Nama</label>
          <div class="col-lg-9">
            <input type="text" readonly class="form-control" id="det-nama">
          </div>
        </div>
        <div class="form-group ">
          <label for="" class="control-label col-lg-3">Username</label>
          <div class="col-lg-9">
            <input type="text" readonly class="form-control" id="det-username">
          </div>
        </div>
        <div class="form-group ">
          <label for="" class="control-label col-lg-3">Email</label>
          <div class="col-lg-9">
            <input type="text" readonly class="form-control" id="det-email">
          </div>
        </div>
        <div class="form-group ">
          <label for="" class="control-label col-lg-3">Sub Bidang</label>
          <div class="col-lg-9">
            <input type="text" readonly class="form-control" id="det-subbidang">
          </div>
        </div>
        <div class="form-group ">
          <label for="" class="control-label col-lg-3">Hak Akses</label>
          <div class="col-lg-9">
            <input type="text" readonly class="form-control" id="det-hak-akses">
          </div>
        </div>
        <div class="box-footer">
         <div class="text-center">
           <button data-iziModal-close data-iziModal-transitionOut="bounceOutDown" class="btn bg-olive">Tutup</button>
         </div>
       </div>
     </form>
   </div>
 </div>
</div>


<?php $__env->startSection('js'); ?>
##parent-placeholder-93f8bb0eb2c659b85694486c41717eaf0fe23cd4##
<script>
  $("#modal-user").iziModal({
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
  $("#modal-detail").iziModal({
    title: 'Detail Pengguna',
    subtitle: '',
    headerColor: '#88A0B9',
    onOpening: function(modal){
      modal.startLoading();
    },
    onOpened: function(modal){
      modal.stopLoading();
    },

  });
  $("#frm-user").submit(function(e) {
    e.preventDefault();
    submit_user();

  })
  var show_detail = function(id)
  {
    axios.get(SITE_URL+id)
    .then(response => {
      res = response.data;
      res.subbid = res.subbidang ? res.subbidang.nama : '-';
      $("#det-nama").val(res.name);
      $("#det-username").val(res.username);
      $("#det-email").val(res.email);
      $("#det-subbidang").val(res.subbid);
      $("#det-hak-akses").val(res.hak_akses);
      $("#modal-detail").iziModal("open");  
    })
    .catch(err => {

    })
  }
  var show_modal = function(id)
  {
    clear_modal();

    if( id )
    {
      $.ajax({
        url: SITE_URL + 'private/user/info/'+id,
        type: 'GET',
        dataType: 'json',

      })
      .done(function(data) {


        $("input[name='type']").val("edit");
        $("button[type='submit']").text('Simpan');

        $("#modal-user").iziModal('setTitle', 'Form Ubah Data Pengguna');

        set_modal_data(data);


      })
      .fail(function() {
        console.log("error retrieve");
      })
      .always(function() {
        console.log("complete retrieve");
      });
      

    }
    else
    {
      $("input[name='type']").val("new");
      $("button[type='submit']").text('Tambah');

      $("#modal-user").iziModal('setTitle', 'Form Input Pengguna Baru');
      $("#modal-user").iziModal("open");
    }
  }
  var set_modal_data = function(data)
  {

    $("#error-message").html("");
    $("input[name='id']").val(data.id);
    $("input[name='nama']").val(data.nama);
    $("input[name='username']").val(data.username);
    $("input[name='email']").val(data.email);
    $("select[name='role_id']").val(data.role_id);
    $("#modal-user").iziModal('open');
    $("#modal-user .iziModal-wrap").scrollTop(0);            
  }
  var submit_user = function()
  {
    var type = $("input[name='type']").val();
    var uri = type == 'new'? 'store' : type == 'edit' ? 'update' : 'delete';
    var url = SITE_URL + 'private/user/' + uri;

    $("button[type='submit']").attr('disabled', true);
    var formData = $('#frm-user').serializeArray();

    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'json',
      data: formData,
    })
    .done(function(resp) {


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
       $("#modal-user .iziModal-wrap").scrollTop(0);  
     } else if (resp.status == 'success')
     {
      swalInfo('Berhasil', 'success','','2000')
      .then((result) => {

        location.reload();
        
      })
    } else 
    {
      alert('gagal');
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
  var delete_user = function(id)
  {
    Swal.fire({
      title: 'Hapus ?',
      text: "Yakin ingin menghapus user ini ?",
      type: 'warning',
      showCancelButton: true,
      cancelButtonColor: '#3085d6',
      confirmButtonColor: '#d33',
      confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
      if (result.value) {
       $.ajax({
        url: SITE_URL + 'private/user/delete/users/'+id,
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
    $("input[name='username']").val("");
    $("input[name='email']").val("");
    $("input[name='password']").val("");
    $("select[name='role_id']").val("");
    $('.input-data').attr('disabled', false);

  }
</script>
<?php $__env->stopSection(); ?><?php /**PATH D:\xZeroxSugarx\xampp\htdocs\kp-edu\application\views/private/user/modal_user.blade.php ENDPATH**/ ?>