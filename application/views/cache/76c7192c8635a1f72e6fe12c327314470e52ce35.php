<?php $__env->startSection('css'); ?>

<style>
	th {
		text-align: center;
	}
</style>
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
						<div class="card-header">Data Lembar Disposisi

						</div>
						<div class="card-body">
							<table class="table table-striped table-bordered" id="table-ruangan">
								<thead>                                 
									<tr>
										
										<th>ID</th>
										<th>Posisi</th>
										<th>Tanggal</th>
										<th>Status</th>
										<th class="">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $dataLembar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lembar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($lembar->id); ?></td>
										<td><?php echo e($lembar->position_role->role_name); ?></td>
										<td><?php echo e($lembar->tanggal); ?></td>

										<td style="width: 1%; white-space: nowrap">
											<?php
											$statDis = '';
											if ($lembar->status == '1') {
												$statDis = 
												'
												<button onclick="show_disposisi('.$lembar->id.')" class="btn btn-sm btn-block btn-warning" type="button">
												<span>
												<i class="icon-reload icons font-2xl d-block"></i>
												</span>
												</button>
												';
											}
											else if ($lembar->status == '2') {
												$statDis = 
												'
												<button onclick="show_disposisi('.$lembar->id.')" class="btn btn-sm btn-block btn-success" type="button">
												<span>
												<i class="icon-check icons font-2xl d-block"></i>
												</span>
												</button>
												';
											}
											?>
											<?php echo $statDis; ?>

											
										</td>
										
										<td style="width: 1%; white-space: nowrap;"> 
											<div class="input-group-btn">
												<button onclick="show_peminjaman(<?php echo e($lembar->peminjaman_ruangan_id); ?>)" class="btn btn-sm btn-info">Lihat Peminjaman</button>
												<?php if($lembar->availableDisposisi): ?>
												<button class="btn btn-primary btn-sm btn-dark" onclick="show_modal(<?php echo e($lembar->id); ?>)">Isi Disposisi</button>
												<?php endif; ?>
											</div>

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
<?php echo $__env->make('private.lembar_disposisi.modal_isi_disposisi', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xZeroxSugarx\xampp\htdocs\kp-edu\application\views/private/lembar_disposisi/index.blade.php ENDPATH**/ ?>