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
							<table class="table table-striped" id="table-ruangan">
								<thead>                                 
									<tr>
										
										<th>ID</th>
										<th>ID Lembar Disposisi</th>
										<th>ID Surat</th>
										<th>Jenis</th>
										<th>Isi</th>
										<th>Dari</th>
										<th>Tujuan</th>
										<th class="">Action</th>
									</tr>
								</thead>
								<tbody>

									<?php $__currentLoopData = $dataIsi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $isi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($isi->id); ?></td>
										<td><?php echo e($isi->lembar_disposisi_id); ?></td>
										<td><?php echo e($isi->lembar_disposisi->reference->id); ?></td>
										<td><?php echo e(hReferenceTable($isi->lembar_disposisi->reference_table)); ?></td>
										<td><?php echo e($isi->isi); ?></td>
										<td><?php echo e($isi->from); ?></td>
										<td><?php echo e($isi->destination); ?></td>
										<td>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<!-- JS Libraies -->

<script>

	
	$("#table-ruangan").dataTable({
		"columnDefs": [
		{ "sortable": false, "targets": [2] }
		]
	});
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xZeroxSugarx\xampp\htdocs\kp-edu\application\views/private/isi_disposisi/index.blade.php ENDPATH**/ ?>