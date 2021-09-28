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
                                <span class="h3">Daftar Permintaan Inventaris</span>
                                <div class="card-header-actions">
                                    <button style="margin-right: 2px;" class="btn btn-outline-primary" type="button"
                                        onclick="show_rekap()"><i
                                            class="cui-print"></i> Cetak Laporan</button>

                                <div class="card-header-actions">
                                    <button class="btn btn-primary" type="button"
                                        onclick="location.href='{{ site_url('private/permintaan_inventaris/create') }}'"><i
                                            class="icon-plus"></i> Tambah Permintaan</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table-inventaris">
                                        <thead>
                                            <tr>

                                                <th>ID Permintaan</th>
                                                <th>Tanggal</th>
                                                <th class="">Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach ($daftarPermintaan as $permintaan)
									<tr>
										<td>{{ $permintaan->id }}</td>
										<td>{{ indoDate($permintaan->tanggal, 'd-m-Y H:i') }}</td>
										<td style="
                                                    width: 1%; white-space: nowrap">
                                                    <button class="btn btn-success"
                                                        onclick="show_cetak({{ $permintaan->id }})">
                                                        <i class="cui-print"></i> Cetak</button>
                                                    <button class="btn btn-success"
                                                        onclick="show_modal({{ $permintaan->id }})">Detail</button>
                                                    <button class="btn btn-warning"
                                                        onclick="location.href='{{ site_url('private/permintaan_inventaris/edit/' . $permintaan->id) }}'">Edit</button>
                                                    <button class="btn btn-danger"
                                                        onclick="show_delete({{ $permintaan->id }})">Hapus</button>
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


    @include('private.permintaan_inventaris.modal_permintaan')

    
  <div class="modal fade" id="modal-rekap-umum" tabindex="-1" role="dialog" aria-labelledby="rekap-umumLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <form id="form-rekap-umum">
              <div class="modal-header">
                  <h4 class="modal-title">Rekap Data Permintaan Inventaris</h4>
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
                                      <option value="{{ $angka }}"
                                      @if ($angka == date('n'))
                                          selected
                                      @endif
                                      
                                      >{{ $nama }}</option>
                                  @endforeach
                              </select>
                          </div>

                          <div class="form-group">
                              <label>Tahun</label>
                              <input type="text" name="inputTahun"  id="inputTahun"
                                  class="form-control" required value="{{ date('Y') }}">
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
    <!-- JS Libraies -->

    <script>
        $("#table-inventaris").dataTable({
            "order": [],
            "columnDefs": [{
                "sortable": false,
                "targets": [2]
            }]
        });
        var show_rekap = function(e) {
              $("#modal-rekap-umum").modal('show');
              
          }

        var show_cetak = function(id) {
            window.open(
                '{{ site_url('private/permintaan_inventaris/cetak?id=') }}' + id,
                '_blank' // <- This is what makes it open in a new window.
            );
        }

        $("#form-rekap-umum").submit(function(e) {
              e.preventDefault();
              query = $(this).serialize();
              window.open(
                  '{{ site_url("private/permintaan_inventaris/rekap") }}'+"?"+query,
                  '_blank' 
              );

              $("#modal-rekap-umum").modal('hide');
          });
    </script>


@endsection
