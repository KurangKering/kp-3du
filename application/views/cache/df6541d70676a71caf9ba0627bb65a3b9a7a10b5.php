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
						<div class="card-header">Data Peminjaman Ruangan

							<div class="card-header-actions">
								<button type="button" class="btn btn-primary" id="btn-create" onclick="location.href='<?php echo e(site_url('private/peminjaman_ruangan/create')); ?>'">Pinjam Ruangan</button>
							</div>
							
						</div>

						<div class="card-body">
							<table class="table table-striped table-bordered" id="table-ruangan">
								<thead>                                 
									<tr>
										
										<th>Nama</th>
										<th>Kegiatan</th>
										<th>Ruangan</th>
										<th>Waktu </th>
										<th style="width: 1%; white-space: nowrap;">Status Peminjaman</th>
										<th style="width: 1%; white-space: nowrap">Status Disposisi</th>
									</tr>
								</thead>
								<tbody>

									<?php $__currentLoopData = $dataPeminjaman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $peminjaman): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php
									$tanggal = indoDate($peminjaman->waktu_mulai, 'd-m-Y');
									$waktuMulai = indoDate($peminjaman->waktu_mulai, 'H:i');
									$waktuSelesai = indoDate($peminjaman->waktu_selesai, 'H:i');
									?>
									<tr>
										<td><?php echo e($peminjaman->nama); ?></td>
										<td><?php echo e($peminjaman->kegiatan->nama_kegiatan); ?></td>
										<td><?php echo e($peminjaman->ruangan->nama); ?></td>
										<td style="white-space: nowrap; width: 1%;"><?php echo e($peminjaman->tanggal); ?></td>
										<td style="text-align: center; width: 1%; white-space: nowrap">
											<?php $stat = ''; 
											if ($peminjaman->status == '2') {

												$stat = '
												<button class="btn btn-md btn-block btn-success" type="button">
												<span class="">
												<i class="icon-check icons font-2xl d-block"></i>
												</span>
												</button>
												';
											} else if($peminjaman->status == '-1')
											{

												$stat = 
												'
												<button  class="btn btn-md btn-block btn-danger" type="button">
												<span>
												<i class="icon-ban icons font-2xl d-block"></i>
												</span>
												</button>
												';
											} else 
											{

												$stat = 
												'
												<button  class="btn btn-md btn-block btn-warning" type="button">
												<span>
												<i class="icon-reload icons font-2xl d-block"></i>
												</span>
												</button>
												';
											}

											?>
											
											<?php echo $stat; ?>

										</td>
										<td style="width: 1%; white-space: nowrap">
											<?php if($peminjaman->lembar_disposisi): ?>
											<?php
											$statDis = '';
											if ($peminjaman->lembar_disposisi->status == '1') {
												$statDis = 
												'
												<button onclick="show_disposisi('.$peminjaman->lembar_disposisi->id.')" class="btn btn-md btn-block btn-warning" type="button">
												<span>
												<i class="icon-reload icons font-2xl d-block"></i>
												</span>
												</button>
												';
											}
											else if ($peminjaman->lembar_disposisi->status == '2') {
												$statDis = 
												'
												<button onclick="show_disposisi('.$peminjaman->lembar_disposisi->id.')" class="btn btn-md btn-block btn-success" type="button">
												<span>
												<i class="icon-check icons font-2xl d-block"></i>
												</span>
												</button>
												';
											}
											?>
											<?php echo $statDis; ?>

											<?php else: ?>
											<button  type="button" class="btn active btn-block btn-light" >Belum ada</button>
											<?php endif; ?>
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
<?php echo $__env->make('layouts.backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xZeroxSugarx\xampp\htdocs\kp-edu\application\views/private/peminjaman_ruangan/index.blade.php ENDPATH**/ ?>