@extends('layouts.backend')
@section('css')

    <style>
        th {
            text-align: center;
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
                                <span class="h3">Data Lembar Disposisi</span>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table-ruangan">
                                        <thead>
                                            <tr>

                                                <th>ID</th>
                                                <th>Posisi</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                                <th class="">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($dataLembar as $lembar)
									<tr>
										<td>{{ $lembar->id }}</td>
										<td>{{ $lembar->position_role->role_name }}</td>
										<td>{{ indoDate($lembar->tanggal, 'd-m-Y') }}</td>

										<td style="
                                                    width: 1%; white-space: nowrap">

                                                    {{ hStatusDisposisi($lembar->status) }}

                                                    </td>

                                                <td style="width: 1%; white-space: nowrap;">
                                                    <div class="input-group-btn">
                                                        <button
                                                            onclick="show_peminjaman({{ $lembar->peminjaman_ruangan_id }})"
                                                            class="btn btn-sm btn-info">Lihat Peminjaman</button>
                                                        @if ($lembar->availableDisposisi)
                                                            <button class="btn btn-primary btn-sm btn-dark"
                                                                onclick="show_modal({{ $lembar->id }})">Isi
                                                                Disposisi</button>
                                                        @endif
                                                    </div>

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
    @include('private.lembar_disposisi.modal_isi_disposisi')

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
