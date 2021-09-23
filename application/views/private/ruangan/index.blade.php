@extends('layouts.backend')
@section('css')

    <style>
        .input {
            width: 100%;
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
                            <div class="card-header">
                                <span class="h3">Data Ruangan</span>
                                <div class="card-header-actions">
                                    <button class="btn btn-primary" type="button" onclick="show_modal()"><i
                                            class="icon-plus"></i> Tambah Ruangan</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table-ruangan">
                                        <thead>
                                            <tr>

                                                <th>ID Ruangan</th>
                                                <th>Nama Ruangan</th>
                                                <th class="">Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach ($dataRuangan as $ruangan)
									<tr>
										<td>{{ $ruangan->id }}</td>
										<td>{{ $ruangan->nama }}</td>
										<td style="
                                                    width: 1%; white-space: nowrap">
                                                    <button class="btn btn-info"
                                                        onclick="show_detail({{ $ruangan->id }})">Detail</button>
                                                    <button class="btn btn-warning"
                                                        onclick="show_modal({{ $ruangan->id }})">Edit</button>
                                                    <button class="btn btn-danger"
                                                        onclick="delete_ruangan({{ $ruangan->id }})">Hapus</button>
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
    @include('private.ruangan.modal_ruangan')
@endsection
@section('js')
    <!-- JS Libraies -->

    <script>
        $("#table-ruangan").dataTable({
            "order": [],
            "columnDefs": [{
                "sortable": false,
                "targets": [2]
            }]
        });
    </script>


@endsection
