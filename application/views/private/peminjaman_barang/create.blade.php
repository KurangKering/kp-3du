 @extends('layouts.backend')
 @section('css')


 @endsection
 @section('content')
     <main class="main">
         <!-- Breadcrumb-->
         <ol class="breadcrumb"></ol>
         <div class="container-fluid">
             <div class="animated fadeIn">
                 <form class="form-horizontal" id="form-peminjaman" autocomplete="off" enctype="multipart/form-data">
                     <!-- /.row-->
                     <div class="row">
                         <div class="col-md-6">
                             <div class="card">
                                 <div class="card-header">Form Peminjaman Barang
                                 </div>
                                 <div class="card-body">
                                     <div id="error-message">

                                     </div>

                                     <div class="form-group row">
                                         <label class="col-md-4 col-form-label" for="inputNama">Nama </label>
                                         <div class="col-md-8">

                                             <div class="input-group-date">
                                                 <input required class="form-control date" id="" type="text"
                                                     name="inputNama" value="">

                                             </div>

                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label class="col-md-4 col-form-label" for="inputKegiatan">Kegiatan </label>
                                         <div class="col-md-8">

                                             <div class="input-group-date">
                                                 <textarea required class="form-control" id="inputKegiatan" type="text"
                                                     name="inputKegiatan"></textarea>

                                             </div>


                                         </div>
                                     </div>
                                     <div class="form-group row" id="data_1">
                                         <label class="col-md-4 col-form-label" for="detWaktuMulai">Waktu Peminjaman
                                         </label>
                                         <div class="col-md-5">
                                             <div class="input-group-date">
                                                 <input required onkeydown="return false" class="form-control date"
                                                     id="inputTanggal" type="text" name="inputTanggal"
                                                     value="{{ date('d-m-Y') }}">

                                             </div>

                                         </div>
                                         <div class="col-md-3">
                                             <div class="input-group clockpicker" id="waktu-mulai">
                                                 <input required onkeydown="return false" type="text" name="inputWaktuMulai"
                                                     id="inputWaktuMulai" class="form-control"
                                                     value="{{ date('H:i') }}">

                                             </div>

                                         </div>
                                     </div>
                                     <div class="form-group row" id="data_3">
                                         <label class="col-md-4 col-form-label" for="inputSyarat">Syarat Foto KTM </label>
                                         <div class="col-md-8">
                                             <div class="input-group " id="syarat">
                                                 <input type="file" class="form-control" id="inputSyarat"
                                                     name="inputSyarat">
                                             </div>

                                         </div>
                                     </div>


                                     {{-- <div class="form-group row" id="data_3">
 									<label class="col-md-4 col-form-label" for="detWaktuMulai">Waktu Selesai </label>
 									<div class="col-md-8">
 										<div class="input-group clockpicker" id="waktu-selesai">
 											<input required onkeydown="return false"  type="text" name="inputWaktuSelesai" id="inputWaktuSelesai" class="form-control" value="">

 										</div>

 									</div>
 								</div> --}}




                                 </div>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="card">
                                 <div class="card-header">Daftar Barang Tersedia
                                 </div>
                                 <div class="card-body">
                                     <div id="error-message">

                                     </div>

                                     <div class="form-group row">
                                         <label class="col-md-4 col-form-label" for="addNamaBarang">Nama Barang</label>
                                         <div class="col-md-8">

                                             <div class="input-group-date">
                                                 <select name="addNamaBarang" id="addNamaBarang" class="form-control">
                                                     <option value="">--silahkan pilih--</option>
                                                     @foreach ($daftarBarang as $barang)
                                                         <option data-satuan="{{ $barang->satuan }}"
                                                             data-sisa="{{ $barang->sisa }}" value="{{ $barang->id }}">
                                                             {{ $barang->nama_barang }}</option>
                                                     @endforeach
                                                 </select>

                                             </div>

                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label class="col-md-4 col-form-label" for="sisaTersedia">Total Tersedia</label>
                                         <div class="col-md-8">

                                             <div class="input-group-date">
                                                 <input class="form-control date" id="sisaTersedia" type="text"
                                                     name="sisaTersedia" value="" readonly>

                                             </div>

                                         </div>
                                     </div>

                                     <div class="form-group row">
                                         <label class="col-md-4 col-form-label" for="addJumlah">Jumlah Pinjam</label>
                                         <div class="col-md-8">

                                             <div class="input-group-date">
                                                 <input class="form-control date" id="addJumlah" type="number"
                                                     name="addJumlah" value="">

                                             </div>

                                         </div>
                                     </div>






                                     <div class="card-footer text-right">

                                         <button class="btn btn-primary" id="btnAddBarang" type="button">Tambah
                                             Barang</button>
                                     </div>


                                 </div>
                             </div>
                         </div>
                         <div class="col-md-12">


                             <div class="card">
                                 <div class="card-header">Daftar Peminjaman Barang
                                 </div>
                                 <div class="card-body">
                                     <div class="table-responsive">
                                         <table class="table table-striped table-bordered">
                                             <thead>
                                                 <tr>
                                                     <th>No</th>
                                                     <th>Nama Barang</th>
                                                     <th>Sisa</th>
                                                     <th>Jumlah</th>
                                                     <th>Satuan</th>
                                                     <th>Action</th>
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
         let $btnAdd = $("#btnAddBarang");
         let $addJumlah = $("#addJumlah");
         let $addNamaBarang = $("#addNamaBarang");


         const a = generateBarang({

             addFromClick: function(e) {

                 a.dom.$select.focus();
                 let id = a.dom.$select.val();
                 let nama = a.dom.$select.find(':selected').text();
                 let satuan = a.dom.$select.find(':selected').data('satuan');
                 let sisaTersedia = a.dom.$select.find(':selected').data('sisa');
                 let jumlah = a.dom.$inputJumlah.val();

                 if (sisaTersedia < jumlah || sisaTersedia == 0) {
                     a.dom.$inputJumlah.val('');
                     return;
                 }



                 let obj = {
                     id: id,
                     nama: nama,
                     jumlah: jumlah,
                     satuan: satuan,
                     sisa: sisaTersedia,
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
                 var formData = new FormData(a.dom.$form[0]);
                 var URL = SITE_URL + 'private/peminjaman_barang/store';
                 $.ajax({
                         url: URL,
                         type: 'POST',
                         data: formData,
                         cache: false,
                         contentType: false,
                         processData: false
                     })
                     .done(function(res) {
                         console.log(res);
                         if (res.success) {
                             swalInfo('Berhasil', 'success', 'Berhasil Menambah Data', 2000)
                                 .then(r => {
                                     location.href = SITE_URL + 'private/peminjaman_barang';
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




         $addNamaBarang.change(function() {
             var optionSelected = $("option:selected", this);
             var idBarang = optionSelected.val();
             var satuan = optionSelected.data('satuan') || '';
             var sisa = optionSelected.data('sisa') || '';

             var $sisaTersedia = $("#sisaTersedia");
             $sisaTersedia.val(sisa + ' ' + satuan);
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
