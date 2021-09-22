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
                                <span class="h3">Daftar Pengajuan Inventaris</span>
                                <div class="card-header-actions">
                                    <button class="btn btn-primary" type="button"
                                        onclick="location.href='{{ site_url('private/pengajuan_inventaris/create') }}'"><i
                                            class="icon-plus"></i> Tambah Pengajuan</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table-inventaris">
                                        <thead>
                                            <tr>

                                                <th>ID Pengajuan</th>
                                                <th>Tanggal</th>
                                                <th class="">Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach ($daftarPengajuan as $pengajuan)
									<tr>
										<td>{{ $pengajuan->id }}</td>
										<td>{{ indoDate($pengajuan->tanggal, 'd-m-Y H:i') }}</td>
										<td style="
                                                    width: 1%; white-space: nowrap">
                                                    <button class="btn btn-success"
                                                        onclick="show_modal({{ $pengajuan->id }})">Detail</button>
                                                    <button class="btn btn-warning"
                                                        onclick="location.href='{{ site_url('private/pengajuan_inventaris/edit/' . $pengajuan->id) }}'">Edit</button>
                                                    <button class="btn btn-danger"
                                                        onclick="show_delete({{ $pengajuan->id }})">Hapus</button>
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
    @include('private.pengajuan_inventaris.modal_pengajuan')
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
    </script>


@endsection
