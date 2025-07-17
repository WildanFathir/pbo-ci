<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Toko Wildan</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?= $css_js ?>

<body>
    <div class="navbar">
        <?= $navbar ?>
    </div>

    <div class="main-container container-fluid">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>

        <div class="sidebar" id="sidebar">
            <?= $sidebar ?>
        </div>

        <div class="main-content">
            <div class="breadcrumbs" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home home-icon"></i>
                        <a href="<?= route_to('dashboard') ?>">Dashboard</a>
                        <span class="divider">
                            <i class="icon-angle-right arrow-icon"></i>
                        </span>
                    </li>
                    <li class="active">Produk</li>
                </ul>
            </div>

            <div class="page-content">
                <div class="button-group" style="margin-bottom: 8px;">
                    <a href="#modal-form" role="button" class="btn btn-info" data-toggle="modal">Tambah Data</a>
                    <a href="<?= route_to('cetakProduk') ?>" target="_blank" role="button" class="btn btn-yellow" data-toggle="modal">Cetak PDF</a>
                    <a href="<?= route_to('dashboard') ?>" role="button" class="btn btn-default" data-toggle="modal">Kembali</a>
                </div>
                <!-- Flashdata notification -->
                <?php if ($flash = session()->getFlashdata('flash')): ?>
                    <div class="alert alert-<?= esc($flash['type']) ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?= esc($flash['message']) ?>
                    </div>
                <?php endif; ?>

                <div class="row-fluid">
                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                        <thead>
                            <th class="center">No</th>
                            <th class="center">No Produk</th>
                            <th class="center">Nama Produk</th>
                            <th class="center">Merk</th>
                            <th class="center">Kategori</th>
                            <th class="center">Ukuran</th>
                            <th class="center">Harga Beli</th>
                            <th class="center">Harga Jual</th>
                            <th class="center">Stok</th>
                            <th class="center">Aksi</th>
                        </thead>
                        <tbody>
                            <?php if (!empty($data_produk)): ?>
                                <?php $no = 1;
                                foreach ($data_produk as $produk): ?>
                                    <tr>
                                        <td class="center"><?= $no++ ?></td>
                                        <td class="center"><?= esc($produk['no_produk']) ?></td>
                                        <td class="center"><?= esc($produk['nama_produk']) ?></td>
                                        <td class="center"><?= esc($produk['nama_merk_produk']) ?></td>
                                        <td class="center"><?= esc($produk['nama_kategori_produk']) ?></td>
                                        <td class="center"><?= esc($produk['nama_ukuran_produk']) ?></td>
                                        <td class="center"><?= number_format($produk['harga_beli']) ?></td>
                                        <td class="center"><?= number_format($produk['harga_jual']) ?></td>
                                        <td class="center"><?= esc($produk['stok']) ?></td>
                                        <td class="td-actions">
                                            <a class="green btn_edit" title="Edit Data" href="#"
                                                data-no_produk="<?= $produk['no_produk'] ?>"
                                                data-nama_produk="<?= $produk['nama_produk'] ?>"
                                                data-no_merk_produk="<?= $produk['no_merk_produk'] ?>"
                                                data-no_kategori_produk="<?= $produk['no_kategori_produk'] ?>"
                                                data-no_ukuran_produk="<?= $produk['no_ukuran_produk'] ?>"
                                                data-harga_beli="<?= $produk['harga_beli'] ?>"
                                                data-harga_jual="<?= $produk['harga_jual'] ?>"
                                                data-stok="<?= $produk['stok'] ?>">
                                                <i class="icon-pencil bigger-130"></i>
                                            </a>
                                            <a class="red btn_hapus" href="#"
                                                data-no_produk="<?= $produk['no_produk'] ?>"
                                                data-nama_produk="<?= $produk['nama_produk'] ?>">
                                                <i class="icon-trash bigger-130"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php else: ?>
                                <tr>
                                    <td class="center" colspan="10">Data produk belum tersedia</td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Tambah -->
            <form name="modal_form1" method="post" action="<?= route_to('simpanProduk') ?>" onsubmit="return cek_inputan()">
                <div id="modal-form" class="modal hide" tabindex="-1">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger">Tambah Data Produk</h4>
                    </div>
                    <div class="modal-body overflow-scroll">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="control-group">
                                    <label class="control-label" for="no_produk">No Produk</label>
                                    <div class="controls">
                                        <input class="input-small span12" type="text" id="no_produk" name="no_produk" readonly value="<?= esc($nomor_otomatis) ?>" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="nama_produk">Nama Produk</label>
                                    <div class="controls">
                                        <input class="input-small span12" type="text" id="nama_produk" name="nama_produk" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="no_merk_produk">Merk</label>
                                    <div class="controls">
                                        <select class="input-small span12" id="no_merk_produk" name="no_merk_produk">
                                            <option value="">-- Pilih Merk --</option>
                                            <?php foreach ($data_merk_produk as $merk): ?>
                                                <option value="<?= esc($merk['no_merk_produk']) ?>"><?= esc($merk['nama_merk_produk']) ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="no_kategori_produk">Kategori</label>
                                    <div class="controls">
                                        <select class="input-small span12" id="no_kategori_produk" name="no_kategori_produk">
                                            <option value="">-- Pilih Kategori --</option>
                                            <?php foreach ($data_kategori_produk as $kategori): ?>
                                                <option value="<?= esc($kategori['no_kategori_produk']) ?>"><?= esc($kategori['nama_kategori_produk']) ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="no_ukuran_produk">Ukuran</label>
                                    <div class="controls">
                                        <select class="input-small span12" id="no_ukuran_produk" name="no_ukuran_produk">
                                            <option value="">-- Pilih Ukuran --</option>
                                            <?php foreach ($data_ukuran_produk as $ukuran): ?>
                                                <option value="<?= esc($ukuran['no_ukuran_produk']) ?>"><?= esc($ukuran['nama_ukuran_produk']) ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="harga_beli">Harga Beli</label>
                                    <div class="controls">
                                        <input class="input-small span12" type="number" id="harga_beli" name="harga_beli" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="harga_jual">Harga Jual</label>
                                    <div class="controls">
                                        <input class="input-small span12" type="number" id="harga_jual" name="harga_jual" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="stok">Stok</label>
                                    <div class="controls">
                                        <input class="input-small span12" type="number" id="stok" name="stok" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-small" data-dismiss="modal">
                            <i class="icon-remove"></i>
                            Batal
                        </button>
                        <button type="submit" class="btn btn-small btn-primary">
                            <i class="icon-ok"></i>
                            Simpan
                        </button>
                    </div>
                </div>
            </form>

            <!-- Modal Edit -->
            <form name="modal_form2" method="post" action="<?= route_to('editProduk') ?>" onsubmit="return cek_inputan_edit()">
                <div id="modal-form2" class="modal hide" tabindex="-1">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger">Edit Data Produk</h4>
                    </div>
                    <div class="modal-body overflow-scroll">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="control-group">
                                    <label class="control-label" for="no_produk">No Produk</label>
                                    <div class="controls">
                                        <input class="input-small span12 no_produk" type="text" id="no_produk" name="no_produk_edit" readonly value="" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="nama_produk">Nama Produk</label>
                                    <div class="controls">
                                        <input class="input-small span12 nama_produk" type="text" id="nama_produk" name="nama_produk_edit" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="no_merk_produk">Merk</label>
                                    <div class="controls">
                                        <select class="input-small span12 no_merk_produk" id="no_merk_produk" name="no_merk_produk_edit">
                                            <option value="">-- Pilih Merk --</option>
                                            <?php foreach ($data_merk_produk as $merk): ?>
                                                <option value="<?= esc($merk['no_merk_produk']) ?>"><?= esc($merk['nama_merk_produk']) ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="no_kategori_produk">Kategori</label>
                                    <div class="controls">
                                        <select class="input-small span12 no_kategori_produk" id="no_kategori_produk" name="no_kategori_produk_edit">
                                            <option value="">-- Pilih Kategori --</option>
                                            <?php foreach ($data_kategori_produk as $kategori): ?>
                                                <option value="<?= esc($kategori['no_kategori_produk']) ?>"><?= esc($kategori['nama_kategori_produk']) ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="no_ukuran_produk">Ukuran</label>
                                    <div class="controls">
                                        <select class="input-small span12 no_ukuran_produk" id="no_ukuran_produk" name="no_ukuran_produk_edit">
                                            <option value="">-- Pilih Ukuran --</option>
                                            <?php foreach ($data_ukuran_produk as $ukuran): ?>
                                                <option value="<?= esc($ukuran['no_ukuran_produk']) ?>"><?= esc($ukuran['nama_ukuran_produk']) ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="harga_beli">Harga Beli</label>
                                    <div class="controls">
                                        <input class="input-small span12 harga_beli" type="number" id="harga_beli" name="harga_beli_edit" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="harga_jual">Harga Jual</label>
                                    <div class="controls">
                                        <input class="input-small span12 harga_jual" type="number" id="harga_jual" name="harga_jual_edit" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="stok">Stok</label>
                                    <div class="controls">
                                        <input class="input-small span12 stok" type="number" id="stok" name="stok_edit" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-small" data-dismiss="modal">
                            <i class="icon-remove"></i>
                            Batal
                        </button>
                        <button type="submit" class="btn btn-small btn-primary" name="btn_ubah">
                            <i class="icon-ok"></i>
                            Ubah
                        </button>
                    </div>
                </div>
            </form>

            <script>
                $(document).ready(function() {
                    $('.btn_hapus').on('click', function() {
                        const no_produk = $(this).data('no_produk');
                        const nama_produk = $(this).data('nama_produk');
                        bootbox.confirm(nama_produk + " akan dihapus?", function(result) {
                            if (result) {
                                window.location.href = "<?= base_url('dashboard/produk/hapus/') ?>" + no_produk;
                            }
                        });
                    });

                    $('.btn_edit').on('click', function() {
                        const no_produk = $(this).data('no_produk');
                        const nama_produk = $(this).data('nama_produk');
                        const no_merk_produk = $(this).data('no_merk_produk');
                        const no_kategori_produk = $(this).data('no_kategori_produk');
                        const no_ukuran_produk = $(this).data('no_ukuran_produk');
                        const harga_beli = $(this).data('harga_beli');
                        const harga_jual = $(this).data('harga_jual');
                        const stok = $(this).data('stok');
                        $('.no_produk').val(no_produk);
                        $('.nama_produk').val(nama_produk);
                        $('.no_merk_produk').val(no_merk_produk);
                        $('.no_kategori_produk').val(no_kategori_produk);
                        $('.no_ukuran_produk').val(no_ukuran_produk);
                        $('.harga_beli').val(harga_beli);
                        $('.harga_jual').val(harga_jual);
                        $('.stok').val(stok);
                        $('#modal-form2').modal('show');
                    });
                });

                function cek_inputan() {
                    if (document.modal_form1.nama_produk.value === "") {
                        document.modal_form1.nama_produk.focus();
                        alert("Nama Produk masih kosong");
                        return false;
                    }
                    if (document.modal_form1.no_merk_produk.value === "") {
                        document.modal_form1.no_merk_produk.focus();
                        alert("Merk belum dipilih");
                        return false;
                    }
                    if (document.modal_form1.no_kategori_produk.value === "") {
                        document.modal_form1.no_kategori_produk.focus();
                        alert("Kategori belum dipilih");
                        return false;
                    }
                    if (document.modal_form1.no_ukuran_produk.value === "") {
                        document.modal_form1.no_ukuran_produk.focus();
                        alert("Ukuran belum dipilih");
                        return false;
                    }
                    if (document.modal_form1.harga_beli.value === "") {
                        document.modal_form1.harga_beli.focus();
                        alert("Harga Beli masih kosong");
                        return false;
                    }
                    if (document.modal_form1.harga_jual.value === "") {
                        document.modal_form1.harga_jual.focus();
                        alert("Harga Jual masih kosong");
                        return false;
                    }
                    if (document.modal_form1.stok.value === "") {
                        document.modal_form1.stok.focus();
                        alert("Stok masih kosong");
                        return false;
                    }
                }

                function cek_inputan_edit() {
                    if (document.modal_form2.nama_produk_edit.value === "") {
                        document.modal_form2.nama_produk_edit.focus();
                        alert("Nama Produk masih kosong");
                        return false;
                    }
                    if (document.modal_form2.no_merk_produk_edit.value === "") {
                        document.modal_form2.no_merk_produk_edit.focus();
                        alert("Merk belum dipilih");
                        return false;
                    }
                    if (document.modal_form2.no_kategori_produk_edit.value === "") {
                        document.modal_form2.no_kategori_produk_edit.focus();
                        alert("Kategori belum dipilih");
                        return false;
                    }
                    if (document.modal_form2.no_ukuran_produk_edit.value === "") {
                        document.modal_form2.no_ukuran_produk_edit.focus();
                        alert("Ukuran belum dipilih");
                        return false;
                    }
                    if (document.modal_form2.harga_beli_edit.value === "") {
                        document.modal_form2.harga_beli_edit.focus();
                        alert("Harga Beli masih kosong");
                        return false;
                    }
                    if (document.modal_form2.harga_jual_edit.value === "") {
                        document.modal_form2.harga_jual_edit.focus();
                        alert("Harga Jual masih kosong");
                        return false;
                    }
                    if (document.modal_form2.stok_edit.value === "") {
                        document.modal_form2.stok_edit.focus();
                        alert("Stok masih kosong");
                        return false;
                    }
                }
            </script>

            <script type="text/javascript">
                $(function() {
                    var oTable1 = $('#sample-table-2').dataTable({
                        "aoColumns": [{
                                "bSortable": false
                            },
                            null,
                            null,
                            null,
                            null,
                            null,
                            null,
                            null,
                            null,
                            {
                                "bSortable": false
                            }
                        ]
                    });


                    $('table th input:checkbox').on('click', function() {
                        var that = this;
                        $(this).closest('table').find('tr > td:first-child input:checkbox')
                            .each(function() {
                                this.checked = that.checked;
                                $(this).closest('tr').toggleClass('selected');
                            });

                    });


                    $('[data-rel="tooltip"]').tooltip({
                        placement: tooltip_placement
                    });

                    function tooltip_placement(context, source) {
                        var $source = $(source);
                        var $parent = $source.closest('table')
                        var off1 = $parent.offset();
                        var w1 = $parent.width();

                        var off2 = $source.offset();
                        var w2 = $source.width();

                        if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
                        return 'left';
                    }
                })
            </script>

            <script type="text/javascript">
                $(function() {
                    $('#id-disable-check').on('click', function() {
                        var inp = $('#form-input-readonly').get(0);
                        if (inp.hasAttribute('disabled')) {
                            inp.setAttribute('readonly', 'true');
                            inp.removeAttribute('disabled');
                            inp.value = "This text field is readonly!";
                        } else {
                            inp.setAttribute('disabled', 'disabled');
                            inp.removeAttribute('readonly');
                            inp.value = "This text field is disabled!";
                        }
                    });


                    $(".chzn-select").chosen();

                    $('[data-rel=tooltip]').tooltip({
                        container: 'body'
                    });
                    $('[data-rel=popover]').popover({
                        container: 'body'
                    });

                    $('textarea[class*=autosize]').autosize({
                        append: "\n"
                    });
                    $('textarea[class*=limited]').each(function() {
                        var limit = parseInt($(this).attr('data-maxlength')) || 100;
                        $(this).inputlimiter({
                            "limit": limit,
                            remText: '%n character%s remaining...',
                            limitText: 'max allowed : %n.'
                        });
                    });

                    $.mask.definitions['~'] = '[+-]';
                    $('.input-mask-date').mask('99/99/9999');
                    $('.input-mask-phone').mask('(999) 999-9999');
                    $('.input-mask-eyescript').mask('~9.99 ~9.99 999');
                    $(".input-mask-product").mask("a*-999-a999", {
                        placeholder: " ",
                        completed: function() {
                            alert("You typed the following: " + this.val());
                        }
                    });



                    $("#input-size-slider").css('width', '200px').slider({
                        value: 1,
                        range: "min",
                        min: 1,
                        max: 6,
                        step: 1,
                        slide: function(event, ui) {
                            var sizing = ['', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
                            var val = parseInt(ui.value);
                            $('#form-field-4').attr('class', sizing[val]).val('.' + sizing[val]);
                        }
                    });

                    $("#input-span-slider").slider({
                        value: 1,
                        range: "min",
                        min: 1,
                        max: 11,
                        step: 1,
                        slide: function(event, ui) {
                            var val = parseInt(ui.value);
                            $('#form-field-5').attr('class', 'span' + val).val('.span' + val).next().attr('class', 'span' + (12 - val)).val('.span' + (12 - val));
                        }
                    });


                    $("#slider-range").css('height', '200px').slider({
                        orientation: "vertical",
                        range: true,
                        min: 0,
                        max: 100,
                        values: [17, 67],
                        slide: function(event, ui) {
                            var val = ui.values[$(ui.handle).index() - 1] + "";

                            if (!ui.handle.firstChild) {
                                $(ui.handle).append("<div class='tooltip right in' style='display:none;left:15px;top:-8px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>");
                            }
                            $(ui.handle.firstChild).show().children().eq(1).text(val);
                        }
                    }).find('a').on('blur', function() {
                        $(this.firstChild).hide();
                    });

                    $("#slider-range-max").slider({
                        range: "max",
                        min: 1,
                        max: 10,
                        value: 2
                    });

                    $("#eq > span").css({
                        width: '90%',
                        'float': 'left',
                        margin: '15px'
                    }).each(function() {
                        // read initial values from markup and remove that
                        var value = parseInt($(this).text(), 10);
                        $(this).empty().slider({
                            value: value,
                            range: "min",
                            animate: true

                        });
                    });


                    $('#id-input-file-1 , #id-input-file-2').ace_file_input({
                        no_file: 'No File ...',
                        btn_choose: 'Choose',
                        btn_change: 'Change',
                        droppable: false,
                        onchange: null,
                        thumbnail: false //| true | large
                        //whitelist:'gif|png|jpg|jpeg'
                        //blacklist:'exe|php'
                        //onchange:''
                        //
                    });

                    $('#id-input-file-3').ace_file_input({
                        style: 'well',
                        btn_choose: 'Drop files here or click to choose',
                        btn_change: null,
                        no_icon: 'icon-cloud-upload',
                        droppable: true,
                        thumbnail: 'small'
                            //,icon_remove:null//set null, to hide remove/reset button
                            /**,before_change:function(files, dropped) {
                            	//Check an example below
                            	//or examples/file-upload.html
                            	return true;
                            }*/
                            /**,before_remove : function() {
                            	return true;
                            }*/
                            ,
                        preview_error: function(filename, error_code) {
                            //name of the file that failed
                            //error_code values
                            //1 = 'FILE_LOAD_FAILED',
                            //2 = 'IMAGE_LOAD_FAILED',
                            //3 = 'THUMBNAIL_FAILED'
                            //alert(error_code);
                        }

                    }).on('change', function() {
                        //console.log($(this).data('ace_input_files'));
                        //console.log($(this).data('ace_input_method'));
                    });


                    //dynamically change allowed formats by changing before_change callback function
                    $('#id-file-format').removeAttr('checked').on('change', function() {
                        var before_change
                        var btn_choose
                        var no_icon
                        if (this.checked) {
                            btn_choose = "Drop images here or click to choose";
                            no_icon = "icon-picture";
                            before_change = function(files, dropped) {
                                var allowed_files = [];
                                for (var i = 0; i < files.length; i++) {
                                    var file = files[i];
                                    if (typeof file === "string") {
                                        //IE8 and browsers that don't support File Object
                                        if (!(/\.(jpe?g|png|gif|bmp)$/i).test(file)) return false;
                                    } else {
                                        var type = $.trim(file.type);
                                        if ((type.length > 0 && !(/^image\/(jpe?g|png|gif|bmp)$/i).test(type)) ||
                                            (type.length == 0 && !(/\.(jpe?g|png|gif|bmp)$/i).test(file.name)) //for android's default browser which gives an empty string for file.type
                                        ) continue; //not an image so don't keep this file
                                    }

                                    allowed_files.push(file);
                                }
                                if (allowed_files.length == 0) return false;

                                return allowed_files;
                            }
                        } else {
                            btn_choose = "Drop files here or click to choose";
                            no_icon = "icon-cloud-upload";
                            before_change = function(files, dropped) {
                                return files;
                            }
                        }
                        var file_input = $('#id-input-file-3');
                        file_input.ace_file_input('update_settings', {
                            'before_change': before_change,
                            'btn_choose': btn_choose,
                            'no_icon': no_icon
                        })
                        file_input.ace_file_input('reset_input');
                    });




                    $('#spinner1').ace_spinner({
                            value: 0,
                            min: 0,
                            max: 200,
                            step: 10,
                            btn_up_class: 'btn-info',
                            btn_down_class: 'btn-info'
                        })
                        .on('change', function() {
                            //alert(this.value)
                        });
                    $('#spinner2').ace_spinner({
                        value: 0,
                        min: 0,
                        max: 10000,
                        step: 100,
                        icon_up: 'icon-caret-up',
                        icon_down: 'icon-caret-down'
                    });
                    $('#spinner3').ace_spinner({
                        value: 0,
                        min: -100,
                        max: 100,
                        step: 10,
                        icon_up: 'icon-plus',
                        icon_down: 'icon-minus',
                        btn_up_class: 'btn-success',
                        btn_down_class: 'btn-danger'
                    });



                    $('.date-picker').datepicker().next().on(ace.click_event, function() {
                        $(this).prev().focus();
                    });
                    $('#id-date-range-picker-1').daterangepicker().prev().on(ace.click_event, function() {
                        $(this).next().focus();
                    });

                    $('#timepicker1').timepicker({
                        minuteStep: 1,
                        showSeconds: true,
                        showMeridian: false
                    })

                    $('#colorpicker1').colorpicker();
                    $('#simple-colorpicker-1').ace_colorpicker();


                    $(".knob").knob();


                    //we could just set the data-provide="tag" of the element inside HTML, but IE8 fails!
                    var tag_input = $('#form-field-tags');
                    if (!(/msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase())))
                        tag_input.tag({
                            placeholder: tag_input.attr('placeholder')
                        });
                    else {
                        //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
                        tag_input.after('<textarea id="' + tag_input.attr('id') + '" name="' + tag_input.attr('name') + '" rows="3">' + tag_input.val() + '</textarea>').remove();
                        //$('#form-field-tags').autosize({append: "\n"});
                    }


                    /////////
                    $('#modal-form input[type=file]').ace_file_input({
                        style: 'well',
                        btn_choose: 'Drop files here or click to choose',
                        btn_change: null,
                        no_icon: 'icon-cloud-upload',
                        droppable: true,
                        thumbnail: 'large'
                    })

                    //chosen plugin inside a modal will have a zero width because the select element is originally hidden
                    //and its width cannot be determined.
                    //so we set the width after modal is show
                    $('#modal-form').on('show', function() {
                        $(this).find('.chzn-container').each(function() {
                            $(this).find('a:first-child').css('width', '200px');
                            $(this).find('.chzn-drop').css('width', '210px');
                            $(this).find('.chzn-search input').css('width', '200px');
                        });
                    })
                    /**
                    //or you can activate the chosen plugin after modal is shown
                    //this way select element has a width now and chosen works as expected
                    $('#modal-form').on('shown', function () {
                    	$(this).find('.modal-chosen').chosen();
                    })
                    */

                });
            </script>
        </div>
    </div>
</body>

</html>