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
						<div class="card-header">Data Pengguna

							<button class="btn btn-primary" type="button" onclick="show_modal()">Tambah Pengguna</button>
						</div>
						<div class="card-body">
							<table class="table table-striped" id="table-user">
								<thead>                                 
									<tr>
										
										<th>Nama</th>
										<th>Email</th>
										<th>Username</th>
										<th>Akses</th>
										<th class="">Action</th>
									</tr>
								</thead>
								<tbody>

									<?php $__currentLoopData = $data_user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($user->nama); ?></td>
										<td><?php echo e($user->email); ?></td>
										<td><?php echo e($user->username); ?></td>
										<td><?php echo e($user->role->role_name); ?></td>
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
				<!-- /.col-->
			</div>
			<!-- /.row-->
		</div>
	</div>
</main>
<?php echo $__env->make('private.user.modal_user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<!-- JS Libraies -->

<script>

	
	$("#table-user").dataTable({
		"columnDefs": [
		{ "sortable": false, "targets": [2,3] }
		]
	});
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xZeroxSugarx\xampp\htdocs\kp-edu\application\views/private/user/index.blade.php ENDPATH**/ ?>