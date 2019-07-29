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
						<div class="card-header">Daftar Barang
							<div class="card-header-actions">
								<button class="btn btn-primary" type="button" onclick="show_modal()">Tambah Barang</button>
							</div>
						</div>
						<div class="card-body">
							<table class="table table-striped table-bordered" id="table-barang">
								<thead>                                 
									<tr>
										
										<th>ID Barang</th>
										<th>Nama Barang</th>
										<th>Satuan</th>
										<th class="">Action</th>
									</tr>
								</thead>
								<tbody>

									<?php $__currentLoopData = $dataBarang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $barang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($barang->id); ?></td>
										<td><?php echo e($barang->nama_barang); ?></td>
										<td><?php echo e($barang->satuan); ?></td>
										<td style="width: 1%; white-space: nowrap">
											<button class="btn btn-warning" onclick="show_modal(<?php echo e($barang->id); ?>)">Edit</button>
											<button class="btn btn-danger" onclick="delete_barang(<?php echo e($barang->id); ?>)">Hapus</button>
										</td>
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
<?php echo $__env->make('private.daftar_barang.modal_barang', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<!-- JS Libraies -->

<script>

	
	$("#table-barang").dataTable({
		"order" : [],
		"columnDefs": [
		{ "sortable": false, "targets": [2] }
		]
	});
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xZeroxSugarx\xampp\htdocs\kp-edu\application\views/private/daftar_barang/index.blade.php ENDPATH**/ ?>