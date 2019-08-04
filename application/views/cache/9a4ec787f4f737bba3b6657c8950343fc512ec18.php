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
						<div class="card-header">Data Peminjaman Barang
							<div class="card-header-actions">
								<button type="button" class="btn btn-primary" onclick="location.href='<?php echo e(site_url('private/peminjaman_barang/create')); ?>'">Tambah Peminjaman</button>
							</div>
							
						</div>
						<div class="card-body">
							<table class="table table-striped table-bordered" id="table-ruangan">
								<thead>                                 
									<tr>
										
										<th>Nama</th>
										<th>Kegiatan</th>
										<th style="white-space: nowrap; width: 1%;">Waktu Mulai</th>
										<th style="white-space: nowrap; width: 1%;">Waktu Pengembalian</th>
										<th>Status</th>
										<th class="">Action</th>
									</tr>
								</thead>
								<tbody>

									<?php $__currentLoopData = $dataPeminjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peminjaman): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($peminjaman->nama); ?></td>
										<td><?php echo e($peminjaman->kegiatan); ?></td>
										<td style="white-space: nowrap; width: 1%;"><?php echo e(indoDate($peminjaman->waktu_mulai, 'd-m-Y H:i')); ?></td>
										<td style="white-space: nowrap; width: 1%;"><?php echo e($peminjaman->waktu_pengembalian ? indoDate($peminjaman->waktu_pengembalian, 'd-m-Y H:i') :  '-'); ?></td>
										<td style="white-space: nowrap; width: 1%;"><?php echo e(hStatusPeminjamanBarang($peminjaman->status)); ?></td>
										<td style="width: 1%; white-space: nowrap">
											<button class="btn btn-primary" onclick="show_modal(<?php echo e($peminjaman->id); ?>)">Detail</button>
											<button class="btn btn-warning" onclick="location.href='<?php echo e(site_url('private/peminjaman_barang/edit/'.$peminjaman->id)); ?>'">Edit</button>
											<button class="btn btn-danger" onclick="show_delete(<?php echo e($peminjaman->id); ?>)"/>Delete</button>
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
<?php echo $__env->make('private.peminjaman_barang.modal_detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xZeroxSugarx\xampp\htdocs\kp-edu\application\views/private/peminjaman_barang/index.blade.php ENDPATH**/ ?>