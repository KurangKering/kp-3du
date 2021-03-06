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
						<div class="card-header">Daftar Permintaan Inventaris
							<div class="card-header-actions">
								<button class="btn btn-primary" type="button" onclick="location.href='<?php echo e(site_url('private/permintaan_inventaris/create')); ?>'">Tambah Permintaan</button>
							</div>
						</div>
						<div class="card-body">
							<table class="table table-striped table-bordered" id="table-inventaris">
								<thead>                                 
									<tr>
										
										<th>ID Permintaan</th>
										<th>Tanggal</th>
										<th class="">Action</th>
									</tr>
								</thead>
								<tbody>

									<?php $__currentLoopData = $daftarPermintaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permintaan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($permintaan->id); ?></td>
										<td><?php echo e(indoDate($permintaan->tanggal, 'd-m-Y H:i')); ?></td>
										<td style="width: 1%; white-space: nowrap">
											<button class="btn btn-success" onclick="show_modal(<?php echo e($permintaan->id); ?>)">Detail</button>
											<button class="btn btn-warning" onclick="location.href='<?php echo e(site_url('private/permintaan_inventaris/edit/'.$permintaan->id)); ?>'">Edit</button>
											<button class="btn btn-danger" onclick="show_delete(<?php echo e($permintaan->id); ?>)">Hapus</button>
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
<?php echo $__env->make('private.permintaan_inventaris.modal_permintaan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<!-- JS Libraies -->

<script>

	
	$("#table-inventaris").dataTable({
		"order" : [],
		"columnDefs": [
		{ "sortable": false, "targets": [2] }
		]
	});
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xZeroxSugarx\xampp\htdocs\kp-edu\application\views/private/permintaan_inventaris/index.blade.php ENDPATH**/ ?>