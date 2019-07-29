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
						<div class="card-header">Data Isi Disposisi

						</div>
						<div class="card-body">
							<table class="table table-striped table-bordered" id="table-ruangan">
								<thead>                                 
									<tr>
										
										<th>ID</th>
										<th>ID Lembar Disposisi</th>
										<th>Dari</th>
										<th>Kepada</th>
										<th>Isi</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									<?php $__currentLoopData = $dataIsi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $isi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($isi->id); ?></td>
										<td><?php echo e($isi->lembar_disposisi_id); ?></td>
										<td><?php echo e($isi->from_role->role_name); ?></td>
										<td><?php echo e($isi->destination_role->role_name); ?></td>
										<td style="width: 1%; white-space: nowrap">
											<?php
											$statDis = '';
											if ($isi->status == '1') {
												$statDis = 
												'
												<button class="btn btn-md btn-block btn-success" type="button">
												<span>
												<i class="icon-check icons font-2xl d-block"></i>
												</span>
												</button>
												';
											}
											else if ($isi->status == '-1') {
												$statDis = 
												'
												<button class="btn btn-md btn-block btn-danger" type="button">
												<span>
												<i class="icon-ban icons font-2xl d-block"></i>
												</span>
												</button>
												';
											}
											?>
											<?php echo $statDis; ?>

											
										</td>
										<td style="width: 1%; white-space: nowrap" >
											
											<button onclick="show_disposisi(<?php echo e($isi->lembar_disposisi->id); ?>)" class="btn btn-md btn-block btn-info" type="button">
												Data Disposisi
											</button>
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
<?php echo $__env->make('private.peminjaman_ruangan.modal_create_lembar_disposisi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<!-- JS Libraies -->

<script>

	
	$("#table-ruangan").dataTable({
		"order" : [],
		"columnDefs": [
		{ "sortable": false, "targets": [2] }
		]
	});
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xZeroxSugarx\xampp\htdocs\kp-edu\application\views/private/isi_disposisi/index.blade.php ENDPATH**/ ?>