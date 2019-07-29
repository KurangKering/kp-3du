<?php $__env->startSection('css'); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<main class="main">
	<!-- Breadcrumb-->
	<ol class="breadcrumb"></ol>
	<div class="container-fluid">
		<div class="animated fadeIn">
			<!-- /.row-->
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">Hasil Disposisi
						</div>
						<div class="card-body">
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Dari</th>
										<th>Kepada</th>
										<th>Isi Disposisi</th>
									</tr>
								</thead>
								<tbody id="tbody-isi-disposisi">

									<?php $__currentLoopData = $peminjamanRuangan->lembar_disposisi->isi_disposisi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $isi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td style="width: 20%;"><?php echo e($allRole->where('id', $isi->from_role_id)->first()->role_name); ?></td>
										<td style="width: 20%;"><?php echo e($allRole->where('id',$isi->destination_role_id)->first()->role_name); ?></td>
										<td><?php echo e($isi->isiDisposisi); ?></td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="card">
						<div class="card-header">Form Terima Peminjaman Ruangan
						</div>
						<div class="card-body">
							<form method="POST" id="frm-terima" class="form-horizontal">
								<input type="hidden" name="peminjaman_ruangan_id" value="<?php echo e($peminjamanRuangan->id); ?>">
								<input type="hidden" name="valueSubmit" value="2">


								<div class="form-group row">
									<label class="col-md-4 col-form-label" for="inputRuangan">Nama </label>
									<div class="col-md-8">

										<div class="input-group-date">
											<input  class="form-control date" id="" type="text" name="" value="<?php echo e($peminjamanRuangan->nama); ?>" onkeydown="return false" >

										</div>

									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label" for="inputRuangan">Kegiatan </label>
									<div class="col-md-8">

										<div class="input-group-date">
											<input  class="form-control date" id="" type="text" name="" value="<?php echo e($peminjamanRuangan->kegiatan); ?>" onkeydown="return false"  >

										</div>

										
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-4 col-form-label" for="inputRuangan">Ruangan </label>
									<div class="col-md-8">

										<select  class="form-control" name="inputRuangan" id="inputRuangan">
											<?php $__currentLoopData = $dataRuangan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ruangan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option  <?php echo e($ruangan->id == $peminjamanRuangan->ruangan_id ? 'selected' : ''); ?> value="<?php echo e($ruangan->id); ?>"><?php echo e($ruangan->nama); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>

										
									</div>
								</div>
								<div class="form-group row" id="data_1">
									<label class="col-md-4 col-form-label" for="detWaktuMulai">Tanggal </label>
									<div class="col-md-8">
										<div class="input-group-date">
											<input onkeydown="return false" class="form-control date" id="inputTanggal" type="text" name="inputTanggal" value="<?php echo e($peminjamanRuangan->tanggal); ?>" >

										</div>

									</div>
								</div>
								<div class="form-group row" id="data_2">
									<label class="col-md-4 col-form-label" for="detWaktuMulai">Waktu Mulai </label>
									<div class="col-md-8">
										<div class="input-group clockpicker" id="waktu-mulai">
											<input onkeydown="return false"  type="text" name="inputWaktuMulai" id="inputWaktuMulai" class="form-control" value="<?php echo e($peminjamanRuangan->waktuMulai); ?>">

										</div>

									</div>
								</div>
								<div class="form-group row" id="data_3">
									<label class="col-md-4 col-form-label" for="detWaktuMulai">Waktu Selesai </label>
									<div class="col-md-8">
										<div class="input-group clockpicker" id="waktu-selesai">
											<input onkeydown="return false"  type="text" name="inputWaktuSelesai" id="inputWaktuSelesai" class="form-control" value="<?php echo e($peminjamanRuangan->waktuSelesai); ?>">

										</div>

									</div>
								</div>

								<div class="card-footer text-right">

									<button class="btn btn-primary mr-1 " id="btnTerima" type="submit">Terima</button>
								</div>


							</form>
						</div>
					</div>
					<div class="card">
						<div class="card-header">Daftar Peminjaman  <span id="ruangan">Ruangan <?php echo e($peminjamanRuangan->ruangan->nama); ?></span>  <span id="tanggal">Tanggal <?php echo e($peminjamanRuangan->tanggal); ?></span>
						</div>
						<div class="card-body">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Nama</th>
										<th>Kegiatan</th>
										<th>Tanggal</th>
										<th>Waktu Mulai</th>
										<th>Waktu Selesai</th>
									</tr>
								</thead>
								<tbody id="tbody-similiar-peminjaman">
									<?php $__currentLoopData = $similiarPeminjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $similiar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($similiar->nama); ?></td>
										<td><?php echo e($similiar->kegiatan); ?></td>
										<td><?php echo e($similiar->tanggal); ?></td>
										<td><?php echo e($similiar->waktuMulai); ?></td>
										<td><?php echo e($similiar->waktuSelesai); ?></td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- /.col-->
			</div>
			<!-- /.row-->
		</div>
	</div>
</main>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<!-- JS Libraies -->

<script>
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
				alert('selesai lebih kecil dari mulai');
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
				alert('selesai lebih kecil dari mulai');
			}
		},
	});

	let $elTanggal = $("#inputTanggal");
	let $elRuangan = $("#inputRuangan");

	let $elSelectedRuangan = '';
	let $el = $("#tbody-similiar-peminjaman");




	$("#inputTanggal, #inputRuangan").on('change', function(event) {
		event.preventDefault();	
		inputTanggal = $elTanggal.val();
		inputRuangan = $elRuangan.val();
		$elSelectedRuangan = $("#inputRuangan option:selected");
		loadPeminjamanSimiliar(inputRuangan, inputTanggal);

	});


	$("#frm-terima").submit(function(e) {
		e.preventDefault();

		var formData = $(this).serializeArray();


		$.ajax({
			url: SITE_URL + 'private/peminjaman_ruangan/update',
			type: 'POST',
			dataType: 'json',
			data: formData,
		})
		.done(function(response) {
			if (response.status == 'success') {
				swalInfo('Berhasil', 'success','','2000')
				.then((result) => {

					location.href = SITE_URL + 'private/peminjaman_ruangan/';

				})
			} else 
			{
				alert('gagal');
			}
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		

	})
	function loadPeminjamanSimiliar(paramRuangId = '', paramTanggal = '')
	{
		$("#tanggal").html("");
		$("#ruangan").html("");
		$.ajax({
			url: SITE_URL + 'private/peminjaman_ruangan/load_similiar_peminjaman/',
			type: 'GET',
			data: {ruangan_id : paramRuangId, tanggal : paramTanggal},
			dataType: 'json',
		})
		.done(function(response) {

			textRuangan = $elSelectedRuangan.text();
			displayTanggal = inputTanggal ? 'Tanggal : ' + inputTanggal :  '';
			displayRuangan = textRuangan ? 'Ruangan : ' + textRuangan :  '';

			$("#tanggal").html(displayTanggal);
			$("#ruangan").html(displayRuangan);
			$el.empty();

			$.each(response, function(index, val) {
				var tr = $("<tr/>");
				tr.append($("<td/>", {
					text  : val.nama,
					style   : "vertical-align:middle;",
				}))
				.append($("<td/>", {
					text  : val.kegiatan,
					style   : "vertical-align:middle;",
					class : 'text-center'
				}))
				.append($("<td/>", {
					text  : val.tanggal,
					style   : "vertical-align:middle;",
					class : 'text-center'
				}))
				.append($("<td/>", {
					text  : val.waktuMulai,
					style   : "vertical-align:middle;",
					class : 'text-center'
				}))
				.append($("<td/>", {
					text  : val.waktuSelesai,
					style   : "vertical-align:middle;",
					class : 'text-center'
				}))
				;
				$el.append(tr);
			});
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	}

</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xZeroxSugarx\xampp\htdocs\kp-edu\application\views/private/peminjaman_ruangan/terima_peminjaman.blade.php ENDPATH**/ ?>