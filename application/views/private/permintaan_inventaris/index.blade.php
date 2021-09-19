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
						<div class="card-header">
							<span class="h3">Daftar Permintaan Inventaris</span>
							<div class="card-header-actions">
								<button class="btn btn-primary" type="button" onclick="location.href='{{ site_url('private/permintaan_inventaris/create') }}'"><i class="icon-plus"></i> Tambah Permintaan</button>
							</div>
						</div>
						<div class="card-body">
							<table class="table table-striped table-bordered" id="table-inventaris">
								<thead>
									<tr>

										<th>ID Permintaan</th>
										<th>Tanggal</th>
										<th class="">Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($daftarPermintaan as $permintaan)
									<tr>
										<td>{{ $permintaan->id }}</td>
										<td>{{ indoDate($permintaan->tanggal, 'd-m-Y H:i') }}</td>
										<td style="width: 1%; white-space: nowrap">
											<button class="btn btn-success" onclick="show_cetak({{ $permintaan->id }})">
												<i class="cui-print"></i> Cetak</button>
											<button class="btn btn-success" onclick="show_modal({{ $permintaan->id }})">Detail</button>
											<button class="btn btn-warning" onclick="location.href='{{ site_url('private/permintaan_inventaris/edit/'.$permintaan->id) }}'">Edit</button>
											<button class="btn btn-danger" onclick="show_delete({{ $permintaan->id }})">Hapus</button>
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
@include('private.permintaan_inventaris.modal_permintaan')
@endsection
@section('js')
<!-- JS Libraies -->

<script>
	$("#table-inventaris").dataTable({
		"order": [],
		"columnDefs": [{
			"sortable": false,
			"targets": [2]
		}]
	});

	var show_cetak = function(id) {
		window.open(
			'{{ site_url("private/permintaan_inventaris/cetak?id=") }}'+id,
			'_blank' // <- This is what makes it open in a new window.
		);
	}
</script>


@endsection