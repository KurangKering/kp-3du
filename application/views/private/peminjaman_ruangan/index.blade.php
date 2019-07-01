@extends('layouts.backend')
@section('css')


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

									@foreach($dataPeminjaman as $peminjaman)
									<tr>
										<td>{{ $peminjaman->nama }}</td>
										<td>{{ $peminjaman->number_id }}</td>
										<td>{{ $peminjaman->pekerjaan }}</td>
										<td>{{ $peminjaman->keperluan->keperluan }}</td>
										<td>{{ $peminjaman->ruangan->nama }}</td>
										<td>{{ $peminjaman->waktu->mulai . ' - '. $peminjaman->waktu->selesai }}</td>
										<td>{{ $peminjaman->tgl_peminjaman }}</td>
										<td>{{ $peminjaman->status }}</td>
										<td class="colAction">
											<button class="btn btn-warning" onclick="show_modal({{ $peminjaman->id }})">Lembar Disposisi</button>
											<button class="btn btn-danger" onclick="delete_ruangan({{ $peminjaman->id }})">Hapus</button>
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
		"columnDefs": [
		{ "sortable": false, "targets": [2] }
		]
	});
</script>


@endsection