  <div id="modal-inventaris" style="display: none;">
    <form  id="frm-inventaris">
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
          <label>Stock</label>
          <input type="number" name="stock"  id="stock" class="form-control">
        </div>
        <div class="form-group">
          <label>Satuan</label>
          <input type="text" name="satuan"  id="satuan" class="form-control">
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
        
        <div class="box-footer">
         <div class="text-center">
           <button data-iziModal-close data-iziModal-transitionOut="bounceOutDown" class="btn bg-olive">Tutup</button>
         </div>
       </div>
     </form>
   </div>
 </div>
</div>


@section('js')
@parent
<script>
  $("#modal-inventaris").iziModal({
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
  $("#frm-inventaris").submit(function(e) {
    e.preventDefault();
    submit_inventaris();

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
        url: SITE_URL + 'private/daftar_inventaris/info/'+id,
        type: 'GET',
        dataType: 'json',

      })
      .done(function(data) {


        $("input[name='type']").val("edit");
        $("button[type='submit']").text('Simpan');

        $("#modal-inventaris").iziModal('setTitle', 'Form Ubah Inventaris');

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

      $("#modal-inventaris").iziModal('setTitle', 'Form Input Inventaris Baru');
      $("#modal-inventaris").iziModal("open");
    }
  }
  var set_modal_data = function(data)
  {

    $("#error-message").html("");
    $("input[name='id']").val(data.id);
    $("input[name='nama']").val(data.nama);
    $("input[name='stock']").val(data.stock);
    $("input[name='satuan']").val(data.satuan);
    $("#modal-inventaris").iziModal('open');
    $("#modal-inventaris .iziModal-wrap").scrollTop(0);            
  }
  var submit_inventaris = function()
  {
    var type = $("input[name='type']").val();
    var uri = type == 'new'? 'store' : type == 'edit' ? 'update' : 'delete';
    var url = SITE_URL + 'private/daftar_inventaris/' + uri;


    $("button[type='submit']").attr('disabled', true);
    var formData = $('#frm-inventaris').serializeArray();


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
       $("#modal-inventaris .iziModal-wrap").scrollTop(0);  
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
  var delete_inventaris = function(id)
  {
    Swal.fire({
      title: 'Hapus ?',
      text: "Yakin ingin menghapus inventaris ini ?",
      type: 'warning',
      showCancelButton: true,
      cancelButtonColor: '#3085d6',
      confirmButtonColor: '#d33',
      confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
      if (result.value) {
       $.ajax({
        url: SITE_URL + 'private/daftar_inventaris/delete/daftar_inventaris/'+id,
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
@endsection