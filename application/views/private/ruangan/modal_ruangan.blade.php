<div id="modal-ruangan" style="display: none;">
    <form id="form-ruangan">
        <input type="hidden" name="id" value="">
        <input type="hidden" name="type" value="get">
        <div class="card">
            <div class="card-body">
                <div id="error-message">

                </div>
                <div class="form-group">
                    <label>Nama Ruangan</label>
                    <input type="text" name="nama" id="nama" class="form-control">
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
                            <td><input type="text" class="input" id="addNamaInventaris"
                                    name="addNamaInventaris"></td>
                            <td><input type="text" class="input" id="addJumlah" name="addJumlah"></td>
                            <td><input type="text" class="input" id="addSatuan" name="addSatuan"></td>
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


<div id="modal-detail" style="display: none;">
    <div class="box">
        <div class="box-header"></div>
        <div class="box-body">
            <form id="frm-detail" class="form-horizontal">
                <div class="form-group ">
                    <label for="" class="control-label col-lg-3">Nama</label>
                    <div class="col-lg-9">
                        <input type="text" readonly class="form-control" id="det-nama">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="" class="control-label col-lg-3">Username</label>
                    <div class="col-lg-9">
                        <input type="text" readonly class="form-control" id="det-username">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="" class="control-label col-lg-3">Email</label>
                    <div class="col-lg-9">
                        <input type="text" readonly class="form-control" id="det-email">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="" class="control-label col-lg-3">Sub Bidang</label>
                    <div class="col-lg-9">
                        <input type="text" readonly class="form-control" id="det-subbidang">
                    </div>
                </div>
                <div class="form-group ">
                    <label for="" class="control-label col-lg-3">Hak Akses</label>
                    <div class="col-lg-9">
                        <input type="text" readonly class="form-control" id="det-hak-akses">
                    </div>
                </div>
                <div class="box-footer">
                    <div class="text-center">
                        <button data-iziModal-close data-iziModal-transitionOut="bounceOutDown"
                            class="btn bg-olive">Tutup</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@section('js')
    @parent
    <script>
        $(document).ready(function() {
            const a = generateInventarisRuangan({
                submitData: function(e) {
                    e.preventDefault();
                    a.dom.$btnSubmit.attr('disabled', true);
                    var formData = a.dom.$form.serializeArray();
                    var URL = SITE_URL + 'private/ruangan/store';
                    $.ajax({
                            url: URL,
                            type: 'POST',
                            dataType: 'json',
                            data: formData,
                        })
                        .done(function(res) {
                            console.log(res);
                            if (res.success) {
                                swalInfo('Berhasil', 'success', 'Berhasil Menambah Data', 2000)
                                    .then(r => {
                                        location.href = SITE_URL + 'private/ruangan';
                                    })
                            } else {

                                swalInfo('Gagal', 'warning', 'Periksa Input Data', 2000)

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
        $("#modal-detail").iziModal({
            title: 'Detail Ruangan',
            subtitle: '',
            headerColor: '#88A0B9',
            onOpening: function(modal) {
                modal.startLoading();
            },
            onOpened: function(modal) {
                modal.stopLoading();
            },

        });
        $("#form-ruangan").submit(function(e) {
            e.preventDefault();
            submit_ruangan();

        })
        var show_detail = function(id) {
            axios.get(SITE_URL + id)
                .then(response => {
                    res = response.data;
                    res.subbid = res.subbidang ? res.subbidang.nama : '-';
                    $("#det-nama").val(res.name);
                    $("#det-username").val(res.username);
                    $("#det-email").val(res.email);
                    $("#det-subbidang").val(res.subbid);
                    $("#det-hak-akses").val(res.hak_akses);
                    $("#modal-detail").iziModal("open");
                })
                .catch(err => {

                })
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
                            url: SITE_URL + 'private/ruangan/delete/ruangan/' + id,
                            type: 'GET',
                            dataType: 'json',

                        })
                        .done(function(data) {

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
