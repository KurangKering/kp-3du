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

									@foreach($dataIsi as $isi)
									<tr>
										<td>{{ $isi->id }}</td>
										<td>{{ $isi->lembar_disposisi_id }}</td>
										<td>{{ $isi->lembar_disposisi->reference->id }}</td>
										<td>{{ hReferenceTable($isi->lembar_disposisi->reference_table) }}</td>
										<td>{{ $isi->isi }}</td>
										<td>{{ $isi->from }}</td>
										<td>{{ $isi->destination }}</td>
										<td>
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