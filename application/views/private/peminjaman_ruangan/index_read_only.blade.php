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
                                <span class="h3">Data Peminjaman Ruangan</span>

                                <div class="card-header-actions">
                                    <button type="button" class="btn btn-primary" id="btn-create"
                                        onclick="location.href='{{ site_url('private/peminjaman_ruangan/create') }}'">Pinjam
                                        Ruangan</button>
                                </div>

                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table-ruangan">
                                        <thead>
                                            <tr>

                                                <th>Nama</th>
                                                <th>Kegiatan</th>
                                                <th>Ruangan</th>
                                                <th>Waktu </th>
                                                <th style="width: 1%; white-space: nowrap;">Status Peminjaman</th>
                                                <th style="width: 1%; white-space: nowrap">Status Disposisi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($dataPeminjaman as $peminjaman)
                                                @php
                                                    $tanggal = indoDate($peminjaman->waktu_mulai, 'd-m-Y');
                                                    $waktuMulai = indoDate($peminjaman->waktu_mulai, 'H:i');
                                                    $waktuSelesai = indoDate($peminjaman->waktu_selesai, 'H:i');
                                                @endphp
                                                <tr>
                                                    <td>{{ $peminjaman->nama }}</td>
                                                    <td>{{ $peminjaman->kegiatan }}</td>
                                                    <td>{{ $peminjaman->ruangan->nama }}</td>
                                                    <td style="white-space: nowrap; width: 1%;">{{ $peminjaman->tanggal }}
                                                    </td>
                                                    <td style="text-align: center; width: 1%; white-space: nowrap">
                                                        {{ hStatusPeminjaman($peminjaman->status) }}
                                                    </td>
                                                    <td style="width: 1%; white-space: nowrap">
                                                        @if ($peminjaman->lembar_disposisi)
                                                            @php
                                                                $statDis = '';
                                                                if ($peminjaman->lembar_disposisi->status == '1') {
                                                                    $statDis =
                                                                        '
                                                                                                                                                                                                <button onclick="show_disposisi(' .
                                                                        $peminjaman->lembar_disposisi->id .
                                                                        ')" class="btn btn-md btn-block btn-warning" type="button">
                                                                                                                                                                                                <span>
                                                                                                                                                                                                <i class="icon-reload icons font-2xl d-block"></i>
                                                                                                                                                                                                </span>
                                                                                                                                                                                                </button>
                                                                                                                                                                                                ';
                                                                } elseif ($peminjaman->lembar_disposisi->status == '2') {
                                                                    $statDis =
                                                                        '
                                                                                                                                                                                                <button onclick="show_disposisi(' .
                                                                        $peminjaman->lembar_disposisi->id .
                                                                        ')" class="btn btn-md btn-block btn-success" type="button">
                                                                                                                                                                                                <span>
                                                                                                                                                                                                <i class="icon-check icons font-2xl d-block"></i>
                                                                                                                                                                                                </span>
                                                                                                                                                                                                </button>
                                                                                                                                                                                                ';
                                                                }
                                                            @endphp
                                                            {!! $statDis !!}
                                                        @else
                                                            <button type="button"
                                                                class="btn active btn-block btn-light">Belum ada</button>
                                                        @endif
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
    @include('private.peminjaman_ruangan.modal_create_lembar_disposisi')

    <div class="modal fade" id="modal-rekap" tabindex="-1" role="dialog" aria-labelledby="modalRekapLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form-rekap">
                    <div class="modal-header">
                        <h4 class="modal-title">Rekap Data Peminjaman Barang</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <div id="error-message">

                                </div>
                                <div class="form-group">
                                    <label>Bulan</label>
                                    <select name="inputBulan" id="inputBulan" class="form-control" required>
                                        @foreach (hBulanHuman() as $angka => $nama)
                                            <option value="{{ $angka }}" @if ($angka == date('n'))
                                                selected
                                        @endif

                                        >{{ $nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Tahun</label>
                                    <input type="text" name="inputTahun" id="inputTahun" class="form-control" required
                                        value="{{ date('Y') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script>
        $("#table-ruangan").dataTable({
            "order": [],
            "columnDefs": [{
                "sortable": false,
                "targets": [2]
            }]
        });


        $("#form-rekap").submit(function(e) {
            e.preventDefault();
            query = $(this).serialize();
            window.open(
                '{{ site_url('private/peminjaman_ruangan/rekap') }}' + "?" + query,
                '_blank'
            );

            $("#modal-rekap").modal('hide');
        });
    </script>


@endsection
