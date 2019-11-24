<style>
    ::-webkit-scrollbar {
        width: 0px;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background: white;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
<section id="produk">
    <h4>Barang</h4>
    <hr>
    <div class="col-12 text-right">
        <button class="btn btn-info " data-toggle="modal" data-target="#add" style="position: fixed; bottom: 36px;   right: 20px; padding: 18.5px;
    z-index: 10;" onclick="create()">
            <i class="fa fa-plus"></i>
        </button>
    </div>
    <div class="col-12 card shadow mt-5 mb-5">
        <h4 class="my-3">Data Barang</h4>
        <table id="table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cabang</th>
                    <th>Produk</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Detail</th>
                    <th>Foto</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tbodyid">

            </tbody>
        </table>
    </div>
</section> <!-- Modal -->
<!-- Modal -->
<div class="modal fade col-sm-6 offset-md-3" id="edit" style="overflow: auto;">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>

            <div class="modal-body row">
                <div class="col-sm-12">
                    <form method="POST" id="form" class="form-horizontal need-validate" novalidate>
                        <div class="box-body">
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <label for="cabang_id" class="control-label">Cabang</label>
                                    <div class="form-group">
                                        <select type="text" name="cabang_id" value="" class="form-control" id="cabang_id" required />
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="produk_id" class="control-label">Produk</label>
                                    <div class="form-group">
                                        <select name="produk_id" value="" class="form-control" id="produk_id" required />
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="nama" class="control-label">Nama</label>
                                    <div class="form-group">
                                        <input type="text" name="nama" value="" class="form-control" id="nama" required />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="harga" class="control-label">Harga</label>
                                    <div class="form-group">
                                        <input type="number" name="harga" value="" class="form-control" id="harga" required />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="harga_beli" class="control-label">Harga Produksi</label>
                                    <div class="form-group">
                                        <input type="number" name="harga_beli" value="" class="form-control" id="harga_beli"
                                               required/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="kimochi_wallet" class="control-label">Kimochi Wallet</label>
                                    <div class="form-group">
                                        <input type="number" name="kimochi_wallet" value="" class="form-control" id="kimochi_wallet"
                                               required/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="detail" class="control-label">Detail</label>
                                    <div class="form-group">
                                        <textarea name="detail" class="form-control" id="detail" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="foto" class="control-label">Foto</label>
                                    <div id="image_preview">

                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="foto" class="form-control" id="foto">
                                    </div>
                                </div>
                                <div id="createupdate" class="row col-md-12">
                                    <div class="col-md-6">
                                        <label for="create_at" class="control-label">Create At</label>
                                        <div class="form-group">
                                            <input type="text" name="create_at" value="" class="form-control" id="create_at" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="update_at" class="control-label">Update At</label>
                                        <div class="form-group">
                                            <input type="text" name="update_at" value="" class="form-control" id="update_at" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer" style="float: right;" id="conf">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="button" class="btn btn-primary" id="submit" style="color:white">Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script> -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
<script>
    let m_view = 'view';
    let bash_api = "<?php echo base_url('sapi/barang/') ?>";
    console.log(bash_api);
    var number, is_update;
    let label = " Barang ";
    $(document).ready(function() {
        table.ajax.reload();
        number = 0;
        is_update = false;
        get_nama_jenis_byID(0);
        get_nama_kategori_byID(0);
    })

    function get_index() {
        if (is_update) {
            number = 1;
            is_update = false;
        } else {
            number++;
        }
        return number;
    }
    var table = $('#table').DataTable({
        "ajax": {
            url: bash_api + 'get_all',
            dataSrc: 'data'
        },
        "columns": [{
            "render": function() {
                return get_index();
            }
        }, {
            "render": function(data, type, JsonResultRow, meta) {
                return get_nama_jenis_byID(JsonResultRow.cabang_id);
            }
        }, {
            "render": function(data, type, JsonResultRow, meta) {
                return get_nama_kategori_byID(JsonResultRow.produk_id);
            }
        }, {
            "data": "nama"
        }, {
            "data": "harga"
        }, {
            "data": "detail"
        }, {
            "render": function(data, type, JsonResultRow, meta) {
                return '<img src="' + "<?php echo base_url('') ?>" + "/uploads/" + JsonResultRow.foto + '" alt="..." class="img-thumbnail style="width:200px;">'
            }
        }, {
            "render": function(data, type, JsonResultRow, meta) {
                return '<button class="btn btn-info edit_jenis"  style="width: 40px; margin-right : 5px;" onclick ="read(' + "'" + JsonResultRow.id + "'" + ')"><i class="fa fa-eye"></i></button>' +
                    '<button class="btn btn-info edit_jenis" style="width: 40px;margin-right : 5px;" onclick ="update(' + "'" + JsonResultRow.id + "'" + ')"><i class="fa fa-pencil-square-o"></i></a>' +
                    '<button class="btn btn-danger delete_jenis" style="width: 40px;" onclick ="del(' + "'" + JsonResultRow.id + "'" + ')"><i class="fa fa-trash-o"></i></a>';
            }
        }]
    });
    $('#edit').on('hidden.bs.modal', function(e) {
        if (e.handled !== true) {
            e.handled = true;
            jenis_sub = null;
        }
        console.log('modal hidden');
        $("#form input").val('');
        $('#submit').off('click');
        $('#image_preview,#cabang_id,#produk_id').empty();
        $("#foto").prop("required", false);
        $("#form").removeClass("was-validated").addClass("needs-validation");
    })

    let tmp_cabang_id = '';
    let tmp_produk_id = '';
    $('#produk_id').on('change', function() {
        render_value_produk(this.value);
    });
    $('#cabang_id').on('change', function() {
        tmp_cabang_id = this.value;
    });

    function render_value_produk(id) {
        $('#image_preview').empty();
        $('#image_preview,#cabang_id,#produk_id').empty();
        read(id, "update", "<?php echo base_url('sapi/admin_produk/') ?>" + 'read', true)
    }

    function conf_state(state) {
        if (state == "read") {
            $('.modal-title').text(state + label);
            $("#form :input,select").prop("readonly", true); //change
            $('#conf,#foto').hide(); //change
            $("#form input").css("color", "black");
            $("#createupdate").show();
            $("#form select").prop("disabled", 'disabled');
        } else if (state == "update" || state == "create") {
            $('.modal-title').text(state + label);
            $("#form :input,select").prop("readonly", false)
            $("#form input").css("color", "#464a4c");
            $('#conf,#foto').show();
            $("#createupdate").hide();
            $("#form select").prop("disabled", false);
        }
    }


    let tmp_kategori_id = '';

    function read(ID, state = "read", url_tmp = bash_api + 'read', produk = false) {
        console.log("edit" + edit);
        $.ajax({
            url: url_tmp,
            type: 'POST',
            data: "id=" + ID,
            success: function(r) {
                // console.log(r);
                if (r.error == false) {
                    render_dropdown('#cabang_id', arr_jenis_all.data);
                    render_dropdown('#produk_id', arr_kategori_all.data);
                    conf_state(state);
                    if (!produk) {
                        tmp_cabang_id = r.data.cabang_id;
                        tmp_produk_id = r.data.produk_id;
                    }
                    if (produk) {
                        if (tmp_cabang_id == '') {
                            tmp_cabang_id = $("#cabang_id option:first").val();
                            tmp_kategori_id = r.data.kategori_id;
                        }
                        tmp_produk_id = ID;
                        console.log("TCL: read -> tmp_produk_id", tmp_produk_id)
                    }
                    $("select[id='cabang_id'] option[value=" + tmp_cabang_id + "]").attr("selected", "selected");
                    $("select[id='produk_id'] option[value=" + tmp_produk_id + "]").attr("selected", "selected");

                    // $('#cabang_id').val(r.data.cabang_id);
                    // $('#produk_id').val(r.data.produk_id);
                    $('#nama').val(r.data.nama);
                    $('#detail').val(r.data.detail);
                    $('#harga').val(r.data.harga);
                    $('#harga_beli').val(r.data.harga_beli);
                    $('#kimochi_wallet').val(r.data.kimochi_wallet);
                    // $('#foto').val(r.data.foto);
                    $("#image_preview").append('<div class="show-image"><img src="' + "<?php echo base_url('') ?>" + "/uploads/" + r.data.foto + '" class="rounded image_view p-1" alt="..." style="width:100%;" id="img_preview_src">');
                    $('#create_at').val(r.data.create_at);
                    $('#update_at').val(r.data.update_at);
                    $('#edit').modal('show');
                } else {
                    swal('Gagal !', r.msg, 'error');
                }
            }
        })
    }

    function update(ID) {
        read(ID, "update");
        // $('.modal-title').text("update jenis pariwisata");
        $('.form-group').removeClass('has-error'); // clear error class
        $(function() {
            $('#submit').click(function(event) {
                event.preventDefault();
                if ($('#form')[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    swal("Update Gagal!", "form tidak valid", "error");
                } else {
                    var mydata = new FormData(document.getElementById("form"));
                    mydata.append('id', ID);
                    $.ajax({
                        url: bash_api + 'update',
                        type: "POST",
                        dataType: "json",
                        data: mydata,
                        async: false,
                        processData: false,
                        contentType: false,
                        beforeSend: function() {},
                        success: function(r) {
                            if (r.error == false) {
                                is_update = true;
                                swal("Update Berhasil!", '', "success");
                                table.ajax.reload();
                            } else {
                                swal("Update Gagal!", r.msg, "error");
                            }
                        },
                        complete: function() {
                            $('#edit').modal('toggle');
                        }
                    });
                }
                $('#form').addClass('was-validated');
            });
        });
    }

    function create() {
        // $("#foto").prop("required", true);
        $("#image_preview").append('<div class="show-image"><img src="" class="rounded image_view p-1" alt="..." style="width:100%;" id="img_preview_src">');
        render_dropdown('#cabang_id', arr_jenis_all.data);
        render_dropdown('#produk_id', arr_kategori_all.data);
        conf_state("create");
        $("#form input").val('');
        $('#edit').modal('show');
        // $('.modal-title').text("tambah jenis pariwisata");
        $('.form-group').removeClass('has-error'); // clear error class
        $(function() {
            $('#submit').click(function(event) {
                event.preventDefault();
                if ($('#form')[0].checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    swal("Insert Gagal!", "form tidak valid", "error");
                } else {
                    var mydata = new FormData(document.getElementById("form"));
                    mydata.append('kategori_id', tmp_kategori_id);
                    $.ajax({
                        url: bash_api + 'create',
                        type: "POST",
                        dataType: "json",
                        data: mydata,
                        async: false,
                        processData: false,
                        contentType: false,
                        beforeSend: function() {},
                        success: function(r) {
                            if (r.error == false) {
                                is_update = true;
                                swal("Insert Berhasil!", '', "success");
                                table.ajax.reload();
                            } else {
                                swal("Insert Gagal!", r.msg, "error");
                            }
                        },
                        complete: function() {
                            $('#edit').modal('toggle');
                        }
                    });
                }
                $('#form').addClass('was-validated');
            });
        });
    }

    function del(ID) {
        swal("Apakah kamu yakin menghapus data ?", {
            icon: "info",
            buttons: {
                cancel: "Batal",
                Yakin: true
            },
        }).then((value) => {
            if (value == 'Yakin') {
                $.ajax({
                    url: bash_api + 'delete',
                    type: 'POST',
                    dataType: 'json',
                    data: "id=" + ID,
                    success: function(r) {
                        if (r.error === true) {
                            swal('Hapus Gagal', r.msg, 'error');
                            table.ajax.reload();
                        } else {
                            is_update = true;
                            swal('Hapus berhasil', '', 'success');
                            $('#table').dataTable().api().ajax.reload();
                        }
                    }
                });
            }
        });
    }
    $("#foto").change(function() {
        console.log('cahne');
        readURL(this);
    });
    //change
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img_preview_src').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    // var arr_jenis_all; sebelumnya gini error
</script>

<script>
    //change
    var arr_jenis_all = "";

    function get_jenis_all() {
        $.ajax({
            url: "<?php echo base_url('sapi/cabang/') ?>" + "get_all",
            async: false,
            type: 'GET',
            success: function(r) {
                if (r.error == false) {
                    arr_jenis_all = r;
                } else {
                    swal('Gagal !', r.data, 'error');
                }
            }
        })
        return arr_jenis_all;
    }

    function get_nama_jenis_byID(id) {
        if (arr_jenis_all == "") {
            arr_jenis_all = get_jenis_all();
        }
        console.log(arr_jenis_all.data)
        var result = arr_jenis_all.data.filter(function(element) {
            return element.id == id;
        })
        // console.log(result[0].nama)  POIN kesalahana
        if (result == "") {
            return '<p class="text-danger">DELETED</p>';
        } else {
            return result[0].nama;
        }
    }
</script>

<script>
    var arr_kategori_all = "";

    function get_kategori_all() {
        $.ajax({
            url: "<?php echo base_url('sapi/admin_produk/') ?>" + "get_all",
            async: false,
            type: 'GET',
            success: function(r) {
                if (r.error == false) {
                    arr_kategori_all = r;
                } else {
                    swal('Gagal !', r.data, 'error');
                }
            }
        })
        return arr_kategori_all;
    }

    function get_nama_kategori_byID(id) {
        if (arr_kategori_all == "") {
            arr_kategori_all = get_kategori_all();
        }
        console.log(arr_kategori_all.data)
        var result = arr_kategori_all.data.filter(function(element) {
            return element.id == id;
        })
        // console.log(result[0].nama)  POIN kesalahana
        if (result == "") {
            return '<p class="text-danger">DELETED</p>';
        } else {
            return result[0].nama;
        }
    }
</script>

<script>
    function render_dropdown(id, data) {
        console.log(data);
        $.each(data, function(key, value) {
            $(id).append("<option value=" + value.id + ">" + value.nama + "</option>");
        });
    }
</script>