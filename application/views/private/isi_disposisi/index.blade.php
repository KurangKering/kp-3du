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
							<span class="h3">Data Isi Disposisi</span>

						</div>
						<div class="card-body">
							<table class="table table-striped table-bordered" id="table-ruangan">
								<thead>                                 
									<tr>
										
										<th>ID</th>
										<th>ID Lembar Disposisi</th>
										<th>Dari</th>
										<th>Kepada</th>
										<th>Isi</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($dataIsi as $isi)
									<tr>
										<td>{{ $isi->id }}</td>
										<td>{{ $isi->lembar_disposisi_id }}</td>
										<td>{{ $isi->from_role->role_name }}</td>
										<td>{{ $isi->destination_role->role_name }}</td>
										<td style="width: 1%; white-space: nowrap">
											@php
											$statDis = '';
											if ($isi->status == '1') {
												$statDis = 
												'
												<button class="btn btn-md btn-block btn-success" type="button">
												<span>
												<i class="icon-check icons font-2xl d-block"></i>
												</span>
												</button>
												';
											}
											else if ($isi->status == '-1') {
												$statDis = 
												'
												<button class="btn btn-md btn-block btn-danger" type="button">
												<span>
												<i class="icon-ban icons font-2xl d-block"></i>
												</span>
												</button>
												';
											}
											@endphp
											{!! $statDis !!}
											
										</td>
										<td style="width: 1%; white-space: nowrap" >
											
											<button onclick="show_disposisi({{ $isi->lembar_disposisi->id }})" class="btn btn-md btn-block btn-info" type="button">
												Data Disposisi
											</button>
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