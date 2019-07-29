 
 <?php $__env->startSection('css'); ?>


 <?php $__env->stopSection(); ?>
 <?php $__env->startSection('content'); ?>
 <main class="main">
 	<!-- Breadcrumb-->
 	<ol class="breadcrumb"></ol>
 	<div class="container-fluid">
 		<div class="animated fadeIn">
 			<form  class="form-horizontal" id="form-peminjaman">
 				<input type="hidden" name="peminjaman_barang_id" value="<?php echo e($peminjamanBarang->id); ?>">
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
 											<input required  class="form-control date" id="" type="text" name="inputNama" value="<?php echo e($peminjamanBarang->nama); ?>" >

 										</div>

 									</div>
 								</div>
 								<div class="form-group row">
 									<label class="col-md-4 col-form-label" for="inputKegiatan">Kegiatan </label>
 									<div class="col-md-8">

 										<div class="input-group-date">
 											<textarea required  class="form-control" id="inputKegiatan" type="text" name="inputKegiatan"><?php echo e($peminjamanBarang->kegiatan); ?></textarea>

 										</div>


 									</div>
 								</div>
 								<div class="form-group row" id="data_1">
 									<label class="col-md-4 col-form-label" for="detWaktuMulai">Tanggal </label>
 									<div class="col-md-8">
 										<div class="input-group-date">
 											<input required onkeydown="return false" class="form-control date" id="inputTanggal" type="text" name="inputTanggal" value="<?php echo e($peminjamanBarang->tanggal); ?>" >

 										</div>

 									</div>
 								</div>
 								
 								
 								<div class="form-group row" id="data_2">
 									<label class="col-md-4 col-form-label" for="detWaktuMulai">Waktu Mulai </label>
 									<div class="col-md-8">
 										<div class="input-group clockpicker" id="waktu-mulai">
 											<input required onkeydown="return false"  type="text" name="inputWaktuMulai" id="inputWaktuMulai" class="form-control" value="<?php echo e($peminjamanBarang->waktuMulai); ?>">

 										</div>

 									</div>
 								</div>
 								<div class="form-group row" id="data_3">
 									<label class="col-md-4 col-form-label" for="detWaktuMulai">Waktu Selesai </label>
 									<div class="col-md-8">
 										<div class="input-group clockpicker" id="waktu-selesai">
 											<input required onkeydown="return false"  type="text" name="inputWaktuSelesai" id="inputWaktuSelesai" class="form-control" value="<?php echo e($peminjamanBarang->waktuSelesai); ?>">

 										</div>

 									</div>
 								</div>
 								<div class="form-group row" >
 									<label class="col-md-4 col-form-label" for="detWaktuMulai">Status Peminjaman </label>
 									<div class="col-md-8">
 										<div class="input-group-date">
 											<select name="status" id="status" class="form-control">
 												<?php $__currentLoopData = hStatusPeminjamanBarang(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statKey => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 												<option <?php echo e($statKey == $peminjamanBarang->status ? 'selected' : ''); ?> value="<?php echo e($statKey); ?>"><?php echo e($status); ?></option>
 												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 											</select>
 										</div>

 									</div>
 								</div>

 								


 							</div>
 						</div>
 					</div><div class="col-md-6">
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
 												<?php $__currentLoopData = $daftarBarang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $barang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 												<option data-satuan="<?php echo e($barang->satuan); ?>" value="<?php echo e($barang->id); ?>"><?php echo e($barang->nama_barang); ?></option>
 												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 											</select>

 										</div>

 									</div>
 								</div>
 								<div class="form-group row">
 									<label class="col-md-4 col-form-label" for="addSatuan">Satuan</label>
 									<div class="col-md-8">

 										<div class="input-group-date">
 											<input required  class="form-control date" id="addSatuan" type="text" name="addSatuan" readonly >

 										</div>

 									</div>
 								</div>
 								<div class="form-group row">
 									<label class="col-md-4 col-form-label" for="addJumlah">Jumlah</label>
 									<div class="col-md-8">

 										<div class="input-group-date">
 											<input   class="form-control date" id="addJumlah" type="number" name="addJumlah" value="" >

 										</div>

 									</div>
 								</div>






 								<div class="card-footer text-right">

 									<button class="btn btn-primary mr-1 " id="btnAddBarang" type="button">Tambah Barang</button>
 								</div>


 							</div>
 						</div>
 					</div>
 					<div class="col-md-12">


 						<div class="card">
 							<div class="card-header">Daftar Peminjaman Barang
 							</div>
 							<div class="card-body">
 								<table class="table table-striped">
 									<thead>
 										<tr>
 											<th>No</th>
 											<th>Nama Barang</th>
 											<th>Satuan</th>
 											<th>Jumlah</th>
 											<th>Action</th>
 										</tr>
 									</thead>
 									<tbody id="tbody-daftar-peminjaman"></tbody>
 								</table>
 							</div>
 						</div>
 					</div>
 					<div class="col-md-12">
 						<div class="card-footer">
 							<button type="submit" id="btn-submit" class="btn btn-block btn-lg btn-success">SIMPAN</button>
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
 	<?php 
 	$phpArrRequested = $requestedBarang;
 	$jsArrRequested = json_encode($phpArrRequested);
 	echo "var arr_barang = " . $jsArrRequested . ";\n";
 	?>

 	const a = generateBarang({
 		data : arr_barang,
 		submitData : function(e)
 		{
 			e.preventDefault();
 			a.dom.$btnSubmit.attr('disabled', true);
 			var formData = a.dom.$form.serializeArray();
 			console.log(formData);
 			var URL = SITE_URL + 'private/peminjaman_barang/update';
 			$.ajax({
 				url: URL,
 				type: 'POST',
 				dataType: 'json',
 				data: formData,
 			})
 			.done(function(res) {

 				if (res.success)
 				{
 					swalInfo('Berhasil' , 'success', 'Berhasil Merubah Data', 1500)
 					.then(r => {
 						location.href= SITE_URL + 'private/peminjaman_barang';
 					})
 					
 				}
 				else 
 				{
 					swalInfo('Gagal !' , 'warning', 'Periksa Form Data', 1500)
 					
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
 	
 	let $btnAdd  = $("#btnAddBarang");
 	let $addJumlah = $("#addJumlah");
 	let $addNamaBarang = $("#addNamaBarang");




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
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xZeroxSugarx\xampp\htdocs\kp-edu\application\views/private/peminjaman_barang/edit.blade.php ENDPATH**/ ?>