<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>TOKO v1</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php echo $css_js ?>

<body>
    <div class="navbar">
        <?php echo $navbar ?>
    </div>

    <div class="main-container container-fluid">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>

        <div class="sidebar" id="sidebar">
            <?php echo $sidebar ?>
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
                    <li class="active">Kelola Pelanggan</li>
                </ul>
                <div class="nav-search" id="nav-search">
                    <form class="form-search" />
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="input-small nav-search-input" id="nav-search-input" autocomplete="off" />
                        <i class="icon-search nav-search-icon"></i>
                    </span>
                    </form>
                </div>
            </div>

            <div class="page-content">
                <div class="button-group" style="margin-bottom: 8px;">
                    <a href="#modal-form" role="button" class="btn btn-info" data-toggle="modal">Tambah Data</a>
                    <a href="<?= route_to('cetakPelanggan') ?>" target="_blank" role="button" class="btn btn-yellow" data-toggle="modal">Cetak PDF</a>
                    <a href="<?= route_to('dashboard') ?>" role="button" class="btn btn-default" data-toggle="modal">Kembali</a>
                </div>
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
                            <th class="center">No Pelanggan</th>
                            <th class="center">Nama Pelanggan</th>
                            <th class="center">No Telp</th>
                            <th class="center">Alamat</th>
                            <th class="center">Foto</th>
                            <th class="center">Aksi</th>
                        </thead>
                        <tbody>
                            <?php if (!empty($data_pelanggan)): ?>
                                <?php $no = 1;
                                foreach ($data_pelanggan as $pelanggan): ?>
                                    <tr>
                                        <td class="center"><?= $no++ ?></td>
                                        <td class="center"><?= esc($pelanggan['no_pelanggan']) ?></td>
                                        <td class="center"><?= esc($pelanggan['nama_pelanggan']) ?></td>
                                        <td class="center"><?= esc($pelanggan['no_telp']) ?></td>
                                        <td class="center"><?= esc($pelanggan['alamat']) ?></td>
                                        <td class="center">
                                            <img width="100px" src="<?= base_url('assets/pelanggan/' . esc($pelanggan['foto'])) ?>" alt="Foto Pelanggan">
                                        </td>
                                        <td class="td-actions">
                                            <a class="green btn_edit" title="Edit Data" href="#"
                                                data-no_pelanggan="<?= $pelanggan['no_pelanggan'] ?>"
                                                data-nama_pelanggan="<?= $pelanggan['nama_pelanggan'] ?>"
                                                data-no_telp="<?= $pelanggan['no_telp'] ?>"
                                                data-alamat="<?= $pelanggan['alamat'] ?>"
                                                data-foto="<?= $pelanggan['foto'] ?>">
                                                <i class="icon-pencil bigger-130"></i>
                                            </a>
                                            <a class="red btn_hapus" href="#"
                                                data-no_pelanggan="<?= $pelanggan['no_pelanggan'] ?>"
                                                data-nama_pelanggan="<?= $pelanggan['nama_pelanggan'] ?>">
                                                <i class="icon-trash bigger-130"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php else: ?>
                                <tr>
                                    <td class="center" colspan="7">Data pelanggan belum tersedia</td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Tambah -->
            <form name="modal_form1" method="post" enctype="multipart/form-data" action="<?= route_to('simpanPelanggan') ?>" onsubmit="return cek_inputan()">
                <div id="modal-form" class="modal hide" tabindex="-1">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger">Tambah Data Pelanggan</h4>
                    </div>
                    <div class="modal-body overflow-scroll">
                        <div class="row-fluid">
                            <div class="span5">
                                <div class="space"></div>

                                <input type="file" name="foto" />
                            </div>

                            <div class="vspace"></div>

                            <div class="span7">
                                <div class="control-group">
                                    <label class="control-label" for="no_pelanggan">No Pelanggan</label>
                                    <div class="controls">
                                        <input class="input-small span12" type="text" id="no_pelanggan" name="no_pelanggan" readonly value="<?= esc($nomor_otomatis) ?>" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="nama_pelanggan">Nama Pelanggan</label>
                                    <div class="controls">
                                        <input class="input-small span12" type="text" id="nama_pelanggan" name="nama_pelanggan" placeholder="Masukan nama pelanggan" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="no_telp">No Telp</label>
                                    <div class="controls">
                                        <input class="input-small span12" type="text" id="no_telp" name="no_telp" placeholder="Masukan nomor telepon" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="alamat">Alamat</label>
                                    <div class="controls">
                                        <textarea class="span12" id="alamat" name="alamat" placeholder="Masukan alamat"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-small" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-small btn-primary">Simpan</button>
                    </div>
                </div>
            </form>

            <!-- Modal Edit -->
            <form name="modal_form2" method="post" enctype="multipart/form-data" action="<?= route_to('editPelanggan') ?>" onsubmit="return cek_inputan_edit()">
                <div id="modal-form2" class="modal hide" tabindex="-1">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger">Edit Data Pelanggan</h4>
                    </div>
                    <div class="modal-body overflow-scroll">
                        <div class="row-fluid">
                            <div class="span5">
                                <img width="200px" alt="foto" name="vfoto" />
                                <input type="file" name="foto" id="id-input-file-2" />
                            </div>
                            <div class="span7">
                                <div class="control-group">
                                    <label class="control-label" for="no_pelanggan">No Pelanggan</label>
                                    <div class="controls">
                                        <input class="input-small span12 no_pelanggan" type="text" id="no_pelanggan" name="no_pelanggan_edit" readonly value="" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="nama_pelanggan">Nama Pelanggan</label>
                                    <div class="controls">
                                        <input class="input-small span12 nama_pelanggan" type="text" id="nama_pelanggan" name="nama_pelanggan_edit" placeholder="Masukan nama pelanggan" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="no_telp">No Telp</label>
                                    <div class="controls">
                                        <input class="input-small span12 no_telp" type="text" id="no_telp" name="no_telp_edit" placeholder="Masukan nomor telepon" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="alamat">Alamat</label>
                                    <div class="controls">
                                        <textarea class="span12 alamat" id="alamat" name="alamat_edit" placeholder="Masukan alamat"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-small" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-small btn-primary" name="btn_ubah">Ubah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.btn_hapus').on('click', function() {
                const no_pelanggan = $(this).data('no_pelanggan');
                const nama_pelanggan = $(this).data('nama_pelanggan');
                bootbox.confirm(nama_pelanggan + " akan dihapus?", function(result) {
                    if (result) {
                        window.location.href = "<?= base_url('dashboard/pelanggan/hapus/'); ?>" + no_pelanggan;
                    }
                });
            });

            $('.btn_edit').on('click', function() {
                const no_pelanggan = $(this).data('no_pelanggan');
                const nama_pelanggan = $(this).data('nama_pelanggan');
                const no_telp = $(this).data('no_telp');
                const alamat = $(this).data('alamat');
                const foto = $(this).data('foto');
                $('.no_pelanggan').val(no_pelanggan);
                $('.nama_pelanggan').val(nama_pelanggan);
                $('.no_telp').val(no_telp);
                $('.alamat').val(alamat);
                document.modal_form2.vfoto.src = "<?= base_url('assets/pelanggan/'); ?>" + foto;
                $('#modal-form2').modal('show');
            });
        });

        function cek_inputan() {
            if (document.modal_form1.nama_pelanggan.value === "") {
                document.modal_form1.nama_pelanggan.focus();
                alert("Nama Pelanggan masih kosong");
                return false;
            }
            if (document.modal_form1.no_telp.value === "") {
                document.modal_form1.no_telp.focus();
                alert("No Telp masih kosong");
                return false;
            }
            if (document.modal_form1.alamat.value === "") {
                document.modal_form1.alamat.focus();
                alert("Alamat masih kosong");
                return false;
            }
        }

        function cek_inputan_edit() {
            if (document.modal_form2.nama_pelanggan_edit.value === "") {
                document.modal_form2.nama_pelanggan_edit.focus();
                alert("Nama Pelanggan masih kosong");
                return false;
            }
            if (document.modal_form2.no_telp_edit.value === "") {
                document.modal_form2.no_telp_edit.focus();
                alert("No Telp masih kosong");
                return false;
            }
            if (document.modal_form2.alamat_edit.value === "") {
                document.modal_form2.alamat_edit.focus();
                alert("Alamat masih kosong");
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
                    null, null, null, null, null,
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
</body>

</html>