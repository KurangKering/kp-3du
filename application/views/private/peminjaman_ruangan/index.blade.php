@extends('layouts.backend')
@section('css')
<style>
	th {
		text-align: center;

	}
</style>

@endsection
@section('content')
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
								<button type="button" class="btn btn-primary" id="btn-create" onclick="location.href='{{ site_url('private/peminjaman_ruangan/create') }}'">Pinjam Ruangan</button>
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

									@foreach($dataPeminjaman as $peminjaman)
									@php
									$tanggal = indoDate($peminjaman->waktu_mulai, 'd-m-Y');
									$waktuMulai = indoDate($peminjaman->waktu_mulai, 'H:i');
									$waktuSelesai = indoDate($peminjaman->waktu_selesai, 'H:i');
									@endphp
									<tr>
										<td>{{ $peminjaman->nama }}</td>
										<td>{{ $peminjaman->kegiatan }}</td>
										<td>{{ $peminjaman->ruangan->nama }}</td>
										<td style="white-space: nowrap; width: 1%;">{{$peminjaman->tanggal}}</td>
										<td style="text-align: center; width: 1%; white-space: nowrap">
											{{ hStatusPeminjaman($peminjaman->status) }}
										</td>
										<td style="width: 1%; white-space: nowrap">
											@if ($peminjaman->lembar_disposisi)
											@php
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
											@endphp
											{!! $statDis !!}
											@else
											<button  type="button" class="btn active btn-block btn-light" >Belum ada</button>
											@endif
										</td>
										
									</tr>
									@endforeach
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
@include('private.peminjaman_ruangan.modal_create_lembar_disposisi')
@endsection
@section('js')
<!-- JS Libraies -->

<script>


	$("#table-ruangan").dataTable({
		"order" : [],
		"columnDefs": [
		{ "sortable": false, "targets": [2] }
		]
	});
</script>


@endsection