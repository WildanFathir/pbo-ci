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
                    <li class="active">Kelola Karyawan</li>
                </ul>

                <div class="nav-search" id="nav-search">
                    <form class="form-search" />
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="input-small nav-search-input" id="nav-search-input" autocomplete="off" />
                        <i class="icon-search nav-search-icon"></i>
                    </span>
                    </form>
                </div><!--#nav-search-->
            </div>

            <div class="page-content">
                <div class="button-group" style="margin-bottom: 8px;">
                    <a href="#modal-form" role="button" class="btn btn-info" data-toggle="modal">Tambah Data</a>
                    <a href="<?= base_url('dashboard') ?>" role="button" class="btn btn-default" data-toggle="modal">Kembali</a>
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
                            <th class="center">No </th>
                            <th class="center">No Karyawan </th>
                            <th class="center">Nama Karyawan </th>
                            <th class="center">Alamat </th>
                            <th class="center">Foto </th>
                            <th class="center">Aksi</th>
                        </thead>

                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            <?php if (!empty($data_karyawan)): ?>
                                <?php $no = 1;
                                foreach ($data_karyawan as $karyawan): ?>
                                    <tr class="odd">
                                        <td class="center"><?= $no++ ?></td>
                                        <td class="center"><?= esc($karyawan['no_karyawan']) ?></td>
                                        <td class="center"><?= esc($karyawan['nama_karyawan']) ?></td>
                                        <td class="center"><?= esc($karyawan['alamat']) ?></td>
                                        <td class="center">
                                            <img width="100px" src="<?= base_url('assets/avatars/' . esc($karyawan['foto'])) ?>" alt="Foto Karyawan">
                                        </td>

                                        <td class="td-actions">
                                            <div class="hidden-phone visible-desktop action-buttons">
                                                <a class="green btn_edit" title="Edit Data" href="#"
                                                    data-no_karyawan="<?= $karyawan['no_karyawan'] ?>"
                                                    data-nama_karyawan="<?= $karyawan['nama_karyawan'] ?>"
                                                    data-alamat="<?= $karyawan['alamat'] ?>"
                                                    data-password="<?= $karyawan['password'] ?>"
                                                    data-foto="<?= $karyawan['foto'] ?>">
                                                    <i class="icon-pencil bigger-130"></i>
                                                </a>

                                                <a class="red" href="#">
                                                    <i class="icon-trash bigger-130"></i>
                                                </a>
                                            </div>

                                            <div class="hidden-desktop visible-phone">
                                                <div class="inline position-relative">
                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                                        <i class="icon-caret-down icon-only bigger-120"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a class="green btn_edit" title="Edit Data" href="#"
                                                                data-no_karyawan="<?= $karyawan['no_karyawan'] ?>"
                                                                data-nama_karyawan="<?= $karyawan['nama_karyawan'] ?>"
                                                                data-alamat="<?= $karyawan['alamat'] ?>"
                                                                data-password="<?= $karyawan['password'] ?>"
                                                                data-foto="<?= $karyawan['foto'] ?>">
                                                                <i class="icon-pencil bigger-130"></i>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="" data-original-title="Delete">
                                                                <span class="red">
                                                                    <i class="icon-trash bigger-120"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="ace-settings-container" id="ace-settings-container">
                <div class="btn btn-app btn-mini btn-warning ace-settings-btn" id="ace-settings-btn">
                    <i class="icon-cog bigger-150"></i>
                </div>

                <div class="ace-settings-box" id="ace-settings-box">
                    <div>
                        <div class="pull-left">
                            <select id="skin-colorpicker" class="hide">
                                <option data-class="default" value="#438EB9" />#438EB9
                                <option data-class="skin-1" value="#222A2D" />#222A2D
                                <option data-class="skin-2" value="#C6487E" />#C6487E
                                <option data-class="skin-3" value="#D0D0D0" />#D0D0D0
                            </select>
                        </div>
                        <span>&nbsp; Choose Skin</span>
                    </div>

                    <div>
                        <input type="checkbox" class="ace-checkbox-2" id="ace-settings-header" />
                        <label class="lbl" for="ace-settings-header"> Fixed Header</label>
                    </div>

                    <div>
                        <input type="checkbox" class="ace-checkbox-2" id="ace-settings-sidebar" />
                        <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                    </div>

                    <div>
                        <input type="checkbox" class="ace-checkbox-2" id="ace-settings-breadcrumbs" />
                        <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                    </div>

                    <div>
                        <input type="checkbox" class="ace-checkbox-2" id="ace-settings-rtl" />
                        <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                    </div>
                </div>
            </div><!--/#ace-settings-container-->
        </div><!--/.main-content-->
    </div><!--/.main-container-->

    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
        <i class="icon-double-angle-up icon-only bigger-110"></i>
    </a>

    <!-- modal form -->
    <form name="modal_form1" method="post" enctype="multipart/form-data" action="<?= route_to('simpanKaryawan') ?>" onsubmit="return cek_inputan()">
        <div id="modal-form" class="modal hide" tabindex="-1">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Tambah Data</h4>
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
                            <label class="control-label" for="no_karyawan">No Karyawan</label>

                            <div class="controls">
                                <input class="input-small span12" type="text" id="no_karyawan" placeholder="Masukan no karyawan" name="no_karyawan" readonly value="<?= esc($nomor_otomatis) ?>" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="nama_karyawan">Nama Karyawan</label>

                            <div class="controls">
                                <input class="input-small span12" type="text" id="nama_karyawan" placeholder="Masukan nama karyawan" name="nama_karyawan" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="alamat">Alamat</label>

                            <div class="controls">
                                <textarea class="span12" id="alamat" placeholder="Masukan alamat" name="alamat"></textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="password">Password</label>

                            <div class="controls">
                                <input class="input-small span8" type="password" id="password" placeholder="Masukan password" name="password" />
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

    <form name="modal_form2" method="post" enctype="multipart/form-data" action="<?= route_to('editKaryawan') ?>" onsubmit="return cek_inputan_edit()">
        <div id="modal-form2" class="modal hide" tabindex="-1">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Edit Data</h4>
            </div>

            <div class="modal-body overflow-scroll">
                <div class="row-fluid">
                    <div class="span5">
                        <div class="space"></div>
                        <img width="200px" alt="foto" name="vfoto" />
                        <input type="file" name="foto" id="id-input-file-2" />
                    </div>

                    <div class="vspace"></div>

                    <div class="span7">
                        <div class="control-group">
                            <label class="control-label" for="no_karyawan">No Karyawan</label>

                            <div class="controls">
                                <input class="input-small span12 no_karyawan" type="text" id="no_karyawan" placeholder="Masukan no karyawan" name="no_karyawan_edit" readonly value="" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="nama_karyawan">Nama Karyawan</label>

                            <div class="controls">
                                <input class="input-small span12 nama_karyawan" type="text" id="nama_karyawan" placeholder="Masukan nama karyawan" name="nama_karyawan_edit" />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="alamat">Alamat</label>

                            <div class="controls">
                                <textarea class="span12 alamat" id="alamat" placeholder="Masukan alamat" name="alamat_edit"></textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="password">Password Baru</label>

                            <div class="controls">
                                <input class="input-small span8" type="password" id="password" placeholder="Masukan password" name="password_edit" />
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
            $('.btn_edit').on('click', function() {
                const no_karyawan = $(this).data('no_karyawan');
                const nama_karyawan = $(this).data('nama_karyawan');
                const alamat = $(this).data('alamat');
                const password = $(this).data('password');
                const foto = $(this).data('foto');
                $('.no_karyawan').val(no_karyawan);
                $('.nama_karyawan').val(nama_karyawan);
                $('.alamat').val(alamat);
                $('.password').val(password);
                $('.foto').val(foto);
                document.modal_form2.vfoto.src = "<?= base_url('assets/avatars/'); ?>" + $(this).data('foto');
                $('#modal-form2').modal('show');
            });
        });
    </script>

    <script>
        function cek_inputan() {
            if (document.modal_form1.nama_karyawan.value === "") {
                document.modal_form1.nama_karyawan.focus();
                alert("Maaf Nama Karyawan masing kosong");
                return (false);
            }
            if (document.modal_form1.password.value === "") {
                document.modal_form1.password.focus();
                alert("Maaf Password masing kosong");
                return (false);
            }
        }
    </script>

    <script>
        function cek_inputan_edit() {
            if (document.modal_form2.nama_karyawan_edit.value === "") {
                document.modal_form2.nama_karyawan_edit.focus();
                alert("Maaf Nama Karyawan masing kosong");
                return (false);
            }
        }
    </script>

    <script type="text/javascript">
        $(function() {
            var oTable1 = $('#sample-table-2').dataTable({
                "aoColumns": [{
                        "bSortable": false
                    },
                    null, null, null, null,
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