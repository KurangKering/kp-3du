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
						<div class="card-header">Data Lembar Disposisi

						</div>
						<div class="card-body">
							<table class="table table-striped" id="table-ruangan">
								<thead>                                 
									<tr>
										
										<th>ID</th>
										<th>ID Surat</th>
										<th>Jenis</th>
										<th>Posisi</th>
										<th>Status</th>
										<th class="">Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($dataLembar as $lembar)
									<tr>
										<td>{{ $lembar->id }}</td>
										<td>{{ $lembar->reference->id }}</td>
										<td>{{ hReferenceTable($lembar->reference_table) }}</td>
										<td>{{ $lembar->position }}</td>
										<td>{{ $lembar->status }}</td>
										<td>
											<button class="btn btn-danger" onclick="delete_ruangan({{ $lembar->id }})">Hapus</button>
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
@include('private.ruangan.modal_ruangan')
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