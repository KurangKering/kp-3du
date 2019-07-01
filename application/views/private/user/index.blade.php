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
						<div class="card-header">Data Pengguna

							<button class="btn btn-primary" type="button" onclick="show_modal()">Tambah Pengguna</button>
						</div>
						<div class="card-body">
							<table class="table table-striped" id="table-user">
								<thead>                                 
									<tr>
										
										<th>Nama</th>
										<th>Email</th>
										<th>Username</th>
										<th>Akses</th>
										<th class="">Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($data_user as $user)
									<tr>
										<td>{{ $user->nama }}</td>
										<td>{{ $user->email }}</td>
										<td>{{ $user->username }}</td>
										<td>{{ $user->role->role_name }}</td>
										<td>
											<button class="btn btn-warning" onclick="show_modal({{ $user->id }})">Edit</button>
											<button class="btn btn-danger" onclick="delete_user({{ $user->id }})">Hapus</button>
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
@include('private.user.modal_user')
@endsection
@section('js')
<!-- JS Libraies -->

<script>

	
	$("#table-user").dataTable({
		"columnDefs": [
		{ "sortable": false, "targets": [2,3] }
		]
	});
</script>


@endsection