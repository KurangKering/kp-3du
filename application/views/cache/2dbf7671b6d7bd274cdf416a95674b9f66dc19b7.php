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
						<div class="card-header">Data Pengajuan Inventaris

							
						</div>
						<div class="card-body">
							<table class="table table-striped" id="table-ruangan">
								<thead>                                 
									<tr>
										
										<th>Nama</th>
										<th>No Identitas</th>
										<th>Pekerjaan</th>
										<th>Keperluan</th>
										<th>Ruangan</th>
										<th>Waktu</th>
										<th>Tgl Peminjaman</th>
										<th>Status</th>
										<th class="">Action</th>
									</tr>
								</thead>
								<tbody>

									<?php $__currentLoopData = $dataPeminjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peminjaman): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($peminjaman->nama); ?></td>
										<td><?php echo e($peminjaman->number_id); ?></td>
										<td><?php echo e($peminjaman->pekerjaan); ?></td>
										<td><?php echo e($peminjaman->keperluan->keperluan); ?></td>
										<td><?php echo e($peminjaman->ruangan->nama); ?></td>
										<td><?php echo e($peminjaman->waktu->mulai . ' - '. $peminjaman->waktu->selesai); ?></td>
										<td><?php echo e($peminjaman->tgl_peminjaman); ?></td>
										<td><?php echo e($peminjaman->status); ?></td>
										<td>
											<button class="btn btn-warning" onclick="show_modal(<?php echo e($peminjaman->id); ?>)">Edit</button>
											<button class="btn btn-danger" onclick="delete_ruangan(<?php echo e($peminjaman->id); ?>)">Hapus</button>
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
<?php echo $__env->make('private.ruangan.modal_ruangan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xZeroxSugarx\xampp\htdocs\kp-edu\application\views/private/pengajuan_inventaris/index.blade.php ENDPATH**/ ?>