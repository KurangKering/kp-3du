 
 <?php $__env->startSection('css'); ?>


 <?php $__env->stopSection(); ?>
 <?php $__env->startSection('content'); ?>
 <main class="main">
 	<!-- Breadcrumb-->
 	<ol class="breadcrumb"></ol>
 	<div class="container-fluid">
 		<div class="animated fadeIn">
 			<form  class="form-horizontal" id="form-peminjaman" autocomplete="off">
 				<!-- /.row-->
 				<div class="row">
 					<div class="col-md-6">
 						<div class="card">
 							<div class="card-header">Form Permintaan Inventaris
 							</div>
 							<div class="card-body">
 								<div id="error-message">

 								</div>

 								<div class="form-group row"></div>
 								
 								
 								
 								
 								
 								

 								


 							</div>
 						</div>
 					</div><div class="col-md-6">
 						<div class="card">
 							<div class="card-header">Form Inventaris
 							</div>
 							<div class="card-body">
 								<div id="error-message">

 								</div>

 								<div class="form-group row">
 									<label class="col-md-4 col-form-label" for="addNamaInventaris">Nama Inventaris</label>
 									<div class="col-md-8">

 										<div class="input-group-date">
 											<select name="addNamaInventaris" id="addNamaInventaris" class="form-control">
 												<option value="">--silahkan pilih--</option>
 												<?php $__currentLoopData = $daftarInventaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inventaris): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 												<option data-satuan="<?php echo e($inventaris->satuan); ?>" data-stock="<?php echo e($inventaris->stock); ?>" value="<?php echo e($inventaris->id); ?>"><?php echo e($inventaris->nama); ?></option>
 												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 											</select>

 										</div>

 									</div>
 								</div>
 								<div class="form-group row">
 									<label class="col-md-4 col-form-label" for="stockTersedia">Stock Tersedia</label>
 									<div class="col-md-8">

 										<div class="input-group-date">
 											<input   class="form-control date" id="stockTersedia" type="text" name="stockTersedia" value="" readonly>

 										</div>

 									</div>
 								</div>
 								
 								<div class="form-group row">
 									<label class="col-md-4 col-form-label" for="addJumlah">Jumlah Permintaan</label>
 									<div class="col-md-8">

 										<div class="input-group-date">
 											<input   class="form-control date" id="addJumlah" type="number" name="addJumlah" value="" >

 										</div>

 									</div>
 								</div>

 								






 								<div class="card-footer text-right">

 									<button class="btn btn-primary" id="btnAddInventaris" type="button">Tambah Barang</button>
 								</div>


 							</div>
 						</div>
 					</div>
 					<div class="col-md-12">


 						<div class="card">
 							<div class="card-header">Daftar Inventaris 
 							</div>
 							<div class="card-body">
 								<table class="table table-striped table-bordered">
 									<thead>
 										<tr>
 											<th>No</th>
 											<th>Nama Inventaris</th>
 											<th>Stock</th>
 											<th>Jumlah</th>
 											<th>Satuan</th>
 											<th>Action</th>
 										</tr>
 									</thead>
 									<tbody id="tbody-daftar-permintaan"></tbody>
 								</table>
 							</div>
 						</div>
 					</div>
 					<div class="col-md-12">
 						<div class="card-footer">
 							<button type="submit" id="btn-submit" class="btn btn-block btn-lg btn-primary">SIMPAN</button>
 						</div>
 					</div>
 				</div>
 			</form>
 		</div>
 	</div>
 </main>

 <?php $__env->stopSection(); ?>
 <?php $__env->startSection('js'); ?>
 <!-- JS Libraies -->

 <script>
 	let $btnAdd  = $("#btnAddInventaris");
 	let $addJumlah = $("#addJumlah");
 	let $addNamaInventaris = $("#addNamaInventaris");


 	const a = genPermintaanInventaris( {
 		addFromClick : function()
 		{
 			a.dom.$select.focus();
 			let id = a.dom.$select.val();
 			let nama = a.dom.$select.find(':selected').text();
 			let jumlah = a.dom.$inputJumlah.val();
 			let satuan = a.dom.$select.find(':selected').data('satuan');
 			let stockTersedia = a.dom.$select.find(':selected').data('stock');

 			if (stockTersedia < jumlah || stockTersedia == 0) {
 				a.dom.$inputJumlah.val('');
 				return; 
 			}
 			let obj = {
 				id : id,
 				nama : nama,
 				jumlah : jumlah,
 				satuan : satuan,
 				stock : stockTersedia,

 			};
 			if (a.validasiBarang(obj)) {
 				a.data.push(obj);
 				a.populateTable();
 			}
 		},
 		submitData : function(e) 
 		{
 			e.preventDefault();

 			a.dom.$btnSubmit.attr('disabled', true);
 			var formData = a.dom.$form.serializeArray();
 			var URL = SITE_URL + 'private/permintaan_inventaris/store';
 			$.ajax({
 				url: URL,
 				type: 'POST',
 				dataType: 'json',
 				data: formData,
 			})
 			.done(function(res) {
 				console.log(res);
 				if (res.success)
 				{
 					swalInfo('Berhasil', 'success', 'Berhasil Menambah Data', 2000)
 					.then(r => {
 						location.href = SITE_URL + 'private/permintaan_inventaris';
 					})
 				}
 				else 
 				{

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
 	
 	


 	$addNamaInventaris.change(function() {
 		var optionSelected =  $("option:selected", this);
 		var idBarang = optionSelected.val();
 		var satuan = optionSelected.data('satuan') || '';
 		var stock = optionSelected.data('stock') || ''	;

 		var $stockTersedia = $("#stockTersedia");
 		$stockTersedia.val(stock + ' ' + satuan);
 	})




 	let tanggalDate = $('#data_1 .date').datepicker({
 		keyboardNavigation: false,
 		forceParse: false,
 		calendarWeeks: true,
 		autoclose: true,
 		format: "dd-mm-yyyy",
 	});
 	let varWaktuMulai =  $('#waktu-mulai').clockpicker({
 		autoclose: true,
 		placement: 'top',
 		afterDone : function() {
 			var mulai =  varWaktuMulai.find('input').val();
 			var selesai =  varWaktuSelesai.find('input').val();

 			if (selesai != '' && selesai < mulai) 
 			{
 				varWaktuMulai.find('input').val('');
 			}

 		}

 	});
 	let varWaktuSelesai = $('#waktu-selesai').clockpicker({
 		autoclose: true,
 		placement: 'top',
 		afterDone: function() {
 			var mulai =  varWaktuMulai.find('input').val();
 			var selesai =  varWaktuSelesai.find('input').val();

 			if (mulai != '' && selesai < mulai) 
 			{
 				varWaktuSelesai.find('input').val('');
 				
 			}
 		},
 	});

 </script>


 <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xZeroxSugarx\xampp\htdocs\kp-edu\application\views/private/permintaan_inventaris/create.blade.php ENDPATH**/ ?>