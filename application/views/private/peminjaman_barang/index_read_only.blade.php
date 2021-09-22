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
                                <span class="h3">Data Peminjaman Barang</span>
                                <div class="card-header-actions">
                                    <button type="button" class="btn btn-primary"
                                        onclick="show_rekap()">Cetak</button>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table-ruangan">
                                        <thead>
                                            <tr>

                                                <th>Nama</th>
                                                <th>Kegiatan</th>
                                                <th style="white-space: nowrap; width: 1%;">Waktu Mulai</th>
                                                <th style="white-space: nowrap; width: 1%;">Waktu Pengembalian</th>
                                                <th>Status</th>
                                                <th class="">Action</th>
										</tr>
									</thead>
									<tbody>

										@foreach ($dataPeminjaman as $peminjaman)
										<tr>
										<td>{{ $peminjaman->nama }}</td>
										<td>{{ $peminjaman->kegiatan }}</td>
										<td style="
                                                    white-space: nowrap; width: 1%;">
                                                    {{ indoDate($peminjaman->waktu_mulai, 'd-m-Y H:i') }}</td>
                                                <td style="white-space: nowrap; width: 1%;">
                                                    {{ $peminjaman->waktu_pengembalian ? indoDate($peminjaman->waktu_pengembalian, 'd-m-Y H:i') : '-' }}
                                                </td>
                                                <td style="white-space: nowrap; width: 1%;">
                                                    {{ hStatusPeminjamanBarang($peminjaman->status) }}</td>
                                                <td style="width: 1%; white-space: nowrap">
                                                    <button class="btn btn-success"
                                                        onclick="show_cetak({{ $peminjaman->id }})">
                                                        Cetak
                                                    </button>
                                                    <button class="btn btn-primary"
                                                        onclick="show_modal({{ $peminjaman->id }})">Detail</button>
                                                    <button class="btn btn-warning"
                                                        onclick="location.href='{{ site_url('private/peminjaman_barang/edit/' . $peminjaman->id) }}'">Edit</button>
                                                    <button class="btn btn-danger"
                                                        onclick="show_delete({{ $peminjaman->id }})" />Delete</button>
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
    @include('private.peminjaman_barang.modal_detail')
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
        var show_cetak = function(id) {
            window.open(
                '{{ site_url('private/peminjaman_barang/cetak?id=') }}' + id,
                '_blank' // <- This is what makes it open in a new window.
            );
        }

    </script>


@endsection
