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
						<div class="card-header">Daftar Barang
							<div class="card-header-actions">
								<button class="btn btn-primary" type="button" onclick="show_modal()">Tambah Barang</button>
							</div>
						</div>
						<div class="card-body">
							<table class="table table-striped table-bordered" id="table-barang">
								<thead>                                 
									<tr>
										
										<th>ID Barang</th>
										<th>Nama Barang</th>
										<th>Satuan</th>
										<th class="">Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($dataBarang as $barang)
									<tr>
										<td>{{ $barang->id }}</td>
										<td>{{ $barang->nama_barang }}</td>
										<td>{{ $barang->satuan }}</td>
										<td style="width: 1%; white-space: nowrap">
											<button class="btn btn-warning" onclick="show_modal({{ $barang->id }})">Edit</button>
											<button class="btn btn-danger" onclick="delete_barang({{ $barang->id }})">Hapus</button>
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
@include('private.daftar_barang.modal_barang')
@endsection
@section('js')
<!-- JS Libraies -->

<script>

	
	$("#table-barang").dataTable({
		"order" : [],
		"columnDefs": [
		{ "sortable": false, "targets": [2] }
		]
	});
</script>


@endsection