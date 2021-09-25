<div id="modal-ruangan" style="display: none;">
    <form id="form-ruangan" class="form-horizontal">
        <input type="hidden" name="id" value="">
        <input type="hidden" name="type" value="get">
        <div class="card">
            <div class="card-body">
                <div id="error-message">

                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Nama Ruangan</label>
                    <div class="col-md-9">
                        <input type="text" name="nama" id="nama" class="form-control">

                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Inventaris</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th></th>
                        </tr>

                    </thead>

                    <tbody>
                        <tr>
                            <td></td>
                            <td><input type="text" class="input" id="addNamaInventaris"></td>
                            <td><input type="text" class="input" id="addJumlah"></td>
                            <td><input type="text" class="input" id="addSatuan"></td>
                            <td>
                                <button id="btnAddInventarisRuangan" type="button">+</button>
                            </td>
                        </tr>
                    </tbody>

                    <tbody id="tbody-daftar-inventaris"></tbody>
                </table>

            </div>
            <div class="card-footer text-right">
                <button class="btn btn-primary mr-1" type="submit" id="btn-submit">Submit</button>
                <button class="btn btn-secondary" type="reset">Reset</button>
            </div>
        </div>
    </form>

</div>

<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Ruangan</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm-detail" class="form-horizontal">

                    <div class="form-group row">
                        <label class="col-md-4 col-sm-12 col-form-label"><strong>Nama Ruangan</strong></label>
                        <div class="col-md-7 col-sm-12">
                            <p class="form-control-static" style="margin-top: 6px">: <span id="detail-nama"></span></p>
                        </div>
                    </div>
                </form>
                <hr>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Inventaris</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-detail">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content-->
    </div>
    <!-- /.modal-dialog-->
</div>
@section('js')
    @parent
    <script>
        $(document).ready(function() {
            a = generateInventarisRuangan({
                submitData: function(e) {

                    var type = $("input[name='type']").val();
                    var uri = type == 'new' ? 'store' : type == 'edit' ? 'update' : 'delete';
                    var URL = SITE_URL + 'private/ruangan/' + uri;

                    a.dom.$btnSubmit.attr('disabled', true);
                    e.preventDefault();
                    var formData = a.dom.$form.serializeArray();
                    $.ajax({
                            url: URL,
                            type: 'POST',
                            dataType: 'json',
                            data: formData,
                        })
                        .done(function(resp) {



                            $('#error-message').html("");
                            if (resp.status == 'error') {
                                $("#error-message").html(
                                    `<div class=\"alert alert-danger\">
       <strong>Ooops!</strong> Terdapat Error.<br><br>
       ` +
                                    resp.messages +
                                    `
       </div>
       `);
                                $("#modal-ruangan .iziModal-wrap").scrollTop(0);
                            } else if (resp.status == 'success') {
                                swalInfo('Berhasil', 'success', '', '2000')
                                    .then((result) => {

                                        location.reload();

                                    })
                            } else {
                                alert('gagal');
                            }
                        })
                        .fail(function() {
                            console.log("error");
                        })
                        .always(function() {
                            a.dom.$btnSubmit.attr('disabled', false);

                        });

                }

            });



        });


        $("#modal-ruangan").iziModal({
            subtitle: '',
            zindex: 5000,

            headerColor: '#6777ef',
            onOpening: function(modal) {
                // modal.startLoading();
            },
            onOpened: function(modal) {
                // modal.stopLoading();
            },

        });

        var show_detail = function(id) {
            $tbodyDetail = $("#tbody-detail");

            $.ajax({
                type: "POST",
                url: "{{ site_url('private/ruangan/detail') }}",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    var ruangan = response.ruangan;

                    $tbodyDetail.empty();
                    var noPage = 1;
                    $.each(ruangan.det_ruangan, function(indexInArray, valueOfElement) {
                        var tr = $("<tr/>");
                        tr.append($("<td/>", {
                                text: noPage++,
                                class: 'text-center',
                                style: "vertical-align:middle; font-weight:bold"
                            }))
                            .append($("<td/>", {
                                text: valueOfElement.nama_inventaris,
                                class: 'text-left',
                                style: "vertical-align:middle;"
                            }))
                            .append($("<td/>", {
                                text: valueOfElement.jumlah + " " + valueOfElement.satuan,
                                class: 'text-center',
                                style: "vertical-align:middle;"
                            }))
                        $tbodyDetail.append(tr);
                    });

                    $("#detail-nama").text(ruangan.nama);
                    $("#modal-detail").modal('show');
                }
            });


        }
        var show_modal = function(id) {
            clear_modal();

            if (id) {
                $.ajax({
                        url: SITE_URL + 'private/ruangan/info/' + id,
                        type: 'GET',
                        dataType: 'json',

                    })
                    .done(function(data) {


                        $("input[name='type']").val("edit");
                        $("button[type='submit']").text('Simpan');

                        $("#modal-ruangan").iziModal('setTitle', 'Form Ubah Ruangan');

                        set_modal_data(data);


                    })
                    .fail(function() {
                        console.log("error retrieve");
                    })
                    .always(function() {
                        console.log("complete retrieve");
                    });


            } else {
                $("input[name='type']").val("new");
                $("button[type='submit']").text('Tambah');

                $("#modal-ruangan").iziModal('setTitle', 'Form Input Ruangan');
                $("#modal-ruangan").iziModal("open");
            }
        }
        var set_modal_data = function(data) {

            $("#error-message").html("");
            $("input[name='id']").val(data.id);
            $("input[name='nama']").val(data.nama);

            a.options.data = data.det_ruangan;
            a.populateTable();
            $("#modal-ruangan").iziModal('open');
            $("#modal-ruangan .iziModal-wrap").scrollTop(0);
        }
        var submit_ruangan = function() {
            var type = $("input[name='type']").val();
            var uri = type == 'new' ? 'store' : type == 'edit' ? 'update' : 'delete';
            var url = SITE_URL + 'private/ruangan/' + uri;

            $("button[type='submit']").attr('disabled', true);
            var formData = $('#form-ruangan').serializeArray();

            $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                })
                .done(function(resp) {


                    $('#error-message').html("");
                    if (resp.status == 'error') {
                        $("#error-message").html(
                            `<div class=\"alert alert-danger\">
       <strong>Ooops!</strong> Terdapat Error.<br><br>
       ` +
                            resp.messages +
                            `
       </div>
       `);
                        $("#modal-ruangan .iziModal-wrap").scrollTop(0);
                    } else if (resp.status == 'success') {
                        swalInfo('Berhasil', 'success', '', '2000')
                            .then((result) => {

                                location.reload();

                            })
                    } else {
                        alert('gagal');
                    }
                })
                .fail(function() {
                    console.log("error post");
                })
                .always(function() {
                    $("button[type='submit']").attr('disabled', false);
                    console.log("complete post");
                });


        }
        var delete_ruangan = function(id) {
            Swal.fire({
                title: 'Hapus ?',
                text: "Yakin ingin menghapus ruangan ini ?",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#3085d6',
                confirmButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                            url: SITE_URL + 'private/ruangan/delete',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                id: id
                            },

                        })
                        .done(function(data) {
                            console.log('welcome');
                            swalInfo('Berhasil', 'success', '', '2000')
                                .then((res) => {

                                    location.reload();
                                })

                        })
                        .fail(function() {
                            console.log("error retrieve");
                        })
                        .always(function() {
                            console.log("complete retrieve");
                        });
                }


            })





        }
        var clear_modal = function() {
            $("#error-message").html("");
            $("input[name='id']").val("");
            $("input[name='nama']").val("");
            $('.input-data').attr('disabled', false);

        }
    </script>
@endsection
