 @extends('layouts.backend')
 @section('css')


 @endsection
 @section('content')
     <main class="main">
         <!-- Breadcrumb-->
         <ol class="breadcrumb"></ol>
         <div class="container-fluid">
             <div class="animated fadeIn">
                 <form class="form-horizontal" id="form-peminjaman" autocomplete="off">
                     <!-- /.row-->
                     <div class="row">
                         <div class="col-md-6">
                             <div class="card">
                                 <div class="card-header">Form Pengajuan Inventaris
                                 </div>
                                 <div class="card-body">

                                     <div id="error-message">

                                     </div>

                                     <div class="form-group row">
                                         <label class="col-md-4 col-form-label" for="addNamaInventaris">Nama
                                             Inventaris</label>
                                         <div class="col-md-8">

                                             <div class="input-group-date">
                                                 <select name="addNamaInventaris" id="addNamaInventaris"
                                                     class="form-control">
                                                     <option value="">--silahkan pilih--</option>
                                                     @foreach ($daftarInventaris as $inventaris)
                                                         <option data-satuan="{{ $inventaris->satuan }}"
                                                             value="{{ $inventaris->id }}">{{ $inventaris->nama }}
                                                         </option>
                                                     @endforeach
                                                 </select>

                                             </div>

                                         </div>
                                     </div>

                                     <div class="form-group row">
                                         <label class="col-md-4 col-form-label" for="addJumlah">Jumlah</label>
                                         <div class="col-md-8">

                                             <div class="input-group-date">
                                                 <input class="form-control date" id="addJumlah" type="number"
                                                     name="addJumlah" value="">

                                             </div>

                                         </div>
                                     </div>

                                     <div class="form-group row">
                                         <label class="col-md-4 col-form-label" for="">Satuan</label>
                                         <div class="col-md-8">

                                             <div class="input-group-date">
                                                 <input class="form-control date" id="satuan" type="text" name="" value=""
                                                     readonly>

                                             </div>

                                         </div>
                                     </div>






                                     <div class="card-footer text-right">

                                         <button class="btn btn-primary" id="btnAddInventaris" type="button">Tambah
                                             Inventaris</button>
                                     </div>








                                 </div>
                             </div>
                         </div>

                         <div class="col-md-6">


                             <div class="card">
                                 <div class="card-header">Daftar Inventaris
                                 </div>
                                 <div class="card-body">
                                     <div class="table-responsive">
                                         <table class="table table-striped table-bordered">
                                             <thead>
                                                 <tr>
                                                     <th style="width: 1%;white-space: nowrap">No</th>
                                                     <th>Nama</th>
                                                     <th style="width: 25%;white-space: nowrap">Jumlah</th>
                                                     <th style="width: 1%;white-space: nowrap">Satuan</th>
                                                     <th style="width: 1%;white-space: nowrap;">Action</th>
                                                 </tr>
                                             </thead>
                                             <tbody id="tbody-daftar-peminjaman"></tbody>
                                         </table>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <div class="col-md-12">
                             <div class="card-footer">
                                 <button type="submit" id="btn-submit"
                                     class="btn btn-block btn-lg btn-primary">SIMPAN</button>
                             </div>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </main>

 @endsection
 @section('js')
     <!-- JS Libraies -->

     <script>
         let $btnAdd = $("#btnAddInventaris");
         let $addJumlah = $("#addJumlah");
         let $addNamaInventaris = $("#addNamaInventaris");


         const a = generateInventaris({

             addFromClick: function(e) {

                 a.dom.$select.focus();
                 let id = a.dom.$select.val();
                 let nama = a.dom.$select.find(':selected').text();
                 let satuan = a.dom.$select.find(':selected').data('satuan');
                 let jumlah = a.dom.$inputJumlah.val();


                 let obj = {
                     id: id,
                     nama: nama,
                     jumlah: jumlah,
                     satuan: satuan,
                 };
                 if (a.validasiBarang(obj)) {
                     console.log(obj);
                     a.data.push(obj);
                     a.populateTable();
                 }

             },
             submitData: function(e) {
                 e.preventDefault();

                 a.dom.$btnSubmit.attr('disabled', true);
                 var formData = a.dom.$form.serializeArray();
                 var URL = SITE_URL + 'private/pengajuan_inventaris/store';
                 $.ajax({
                         url: URL,
                         type: 'POST',
                         dataType: 'json',
                         data: formData,
                     })
                     .done(function(res) {
                         console.log(res);
                         if (res.success) {
                             swalInfo('Berhasil', 'success', 'Berhasil Menambah Data', 2000)
                                 .then(r => {
                                     location.href = SITE_URL + 'private/pengajuan_inventaris';
                                 })
                         } else {

                             swalInfo('Gagal', 'warning', 'Periksa Input Data', 2000)

                         }
                     })
                     .fail(function() {
                         console.log("error");
                     })
                     .always(function() {
                         a.dom.$btnSubmit.attr('disabled', false);

                     });

             }

         });


         let $satuan = $("#satuan");

         $addNamaInventaris.change(function() {
             var optionSelected = $("option:selected", this);
             var idBarang = optionSelected.val();
             var satuan = optionSelected.data('satuan') || '';
             var sisa = optionSelected.data('sisa') || '';

             $satuan.val(satuan);
         })




         let tanggalDate = $('#data_1 .date').datepicker({
             keyboardNavigation: false,
             forceParse: false,
             calendarWeeks: true,
             autoclose: true,
             format: "dd-mm-yyyy",
         });
         let varWaktuMulai = $('#waktu-mulai').clockpicker({
             autoclose: true,
             placement: 'top',
             afterDone: function() {
                 var mulai = varWaktuMulai.find('input').val();
                 var selesai = varWaktuSelesai.find('input').val();

                 if (selesai != '' && selesai < mulai) {
                     varWaktuMulai.find('input').val('');
                 }

             }

         });
         let varWaktuSelesai = $('#waktu-selesai').clockpicker({
             autoclose: true,
             placement: 'top',
             afterDone: function() {
                 var mulai = varWaktuMulai.find('input').val();
                 var selesai = varWaktuSelesai.find('input').val();

                 if (mulai != '' && selesai < mulai) {
                     varWaktuSelesai.find('input').val('');

                 }
             },
         });
     </script>


 @endsection
