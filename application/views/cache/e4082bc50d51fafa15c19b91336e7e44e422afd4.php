<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(site_url('assets/templates/backend/assets/modules/datatables/datatables.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(site_url('assets/templates/backend/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(site_url('assets/templates/backend/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(site_url('assets/templates/backend/assets/modules/prism/prism.css')); ?>">


<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="section">
	<div class="section-header">
		<h1>Daftar Ruangan</h1>
		<div class="section-header-breadcrumb">
			<button class="btn btn-success" id="modal-5" onclick="show_modal()">Tambah Ruangan</button>
		</div>
	</div>

	<div class="section-body">
		<div class="row">
			<div class="col-12">
				<div class="card">
					
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped" id="table-user">
								<thead>                                 
									<tr>
										
										<th>Nama</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									<?php $__currentLoopData = $data_user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($user->nama); ?></td>
										<td>
											<button class="btn btn-warning" onclick="show_modal(<?php echo e($user->id); ?>)">Edit</button>
											<button class="btn btn-danger" onclick="delete_user(<?php echo e($user->id); ?>)">Hapus</button>
										</td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</section>
<?php echo $__env->make('private.user.modal_user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>


<!-- JS Libraies -->
<script src="<?php echo e(site_url('assets/templates/backend/assets/modules/datatables/datatables.min.js')); ?>"></script>
<script src="<?php echo e(site_url('assets/templates/backend/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(site_url('assets/templates/backend/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')); ?>"></script>
<script src="<?php echo e(site_url('assets/templates/backend/assets/modules/jquery-ui/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(site_url('assets/templates/backend/assets/modules/prism/prism.js')); ?>"></script>

<script>
	
	$("#table-user").dataTable({
		"columnDefs": [
		{ "sortable": false, "targets": [2,3] }
		]
	});
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xZeroxSugarx\xampp\htdocs\kalender-edu\application\views/private/ruangan/index.blade.php ENDPATH**/ ?>