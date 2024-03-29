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
                                <span class="h3">Data Pengguna</span>
                                <div class="card-header-actions">
                                    <button class="btn btn-primary" type="button" onclick="show_modal()"><i
                                            class="icon-plus"></i> Tambah Pengguna</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table-user">
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

									@foreach ($data_user as $user)
									<tr>
										<td>{{ $user->nama }}</td>
										<td>{{ $user->email }}</td>
										<td>{{ $user->username }}</td>
										<td>{{ $user->role->role_name }}</td>
										<td style="
                                                    width: 1%; white-space: nowrap">
                                                    <button class="btn btn-warning"
                                                        onclick="show_modal({{ $user->id }})">Edit</button>
                                                    <button class="btn btn-danger"
                                                        onclick="delete_user({{ $user->id }})">Hapus</button>
                                                    </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                    </table>
                                </div>
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
            "order": [],
            "columnDefs": [{
                "sortable": false,
                "targets": [2, 3]
            }]
        });
    </script>


@endsection
