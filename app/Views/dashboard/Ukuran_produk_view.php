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
                    <li class="active">Ukuran Produk</li>
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
                    <a href="<?= route_to('cetakUkuranProduk') ?>" target="_blank" role="button" class="btn btn-yellow" data-toggle="modal">Cetak PDF</a>
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
                            <th class="center">No Ukuran Produk</th>
                            <th class="center">Nama Ukuran Produk</th>
                            <th class="center">Aksi</th>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            <?php if (!empty($data_ukuran_produk)): ?>
                                <?php $no = 1;
                                foreach ($data_ukuran_produk as $ukuranProduk): ?>
                                    <tr class="odd">
                                        <td class="center"><?= $no++ ?></td>
                                        <td class="center"><?= esc($ukuranProduk['no_ukuran_produk']) ?></td>
                                        <td class="center"><?= esc($ukuranProduk['nama_ukuran_produk']) ?></td>
                                        <td class="td-actions">
                                            <div class="hidden-phone visible-desktop action-buttons">
                                                <a class="green btn_edit" title="Edit Data" href="#"
                                                    data-no_ukuran_produk="<?= $ukuranProduk['no_ukuran_produk'] ?>"
                                                    data-nama_ukuran_produk="<?= $ukuranProduk['nama_ukuran_produk'] ?>">
                                                    <i class="icon-pencil bigger-130"></i>
                                                </a>
                                                <a class="red btn_hapus" href="#"
                                                    data-no_ukuran_produk="<?= $ukuranProduk['no_ukuran_produk'] ?>"
                                                    data-nama_ukuran_produk="<?= $ukuranProduk['nama_ukuran_produk'] ?>">
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
                                                                data-no_ukuran_produk="<?= $ukuranProduk['no_ukuran_produk'] ?>"
                                                                data-nama_ukuran_produk="<?= $ukuranProduk['nama_ukuran_produk'] ?>">
                                                                <i class="icon-pencil bigger-130"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="red btn_hapus" href="#"
                                                                data-no_ukuran_produk="<?= $ukuranProduk['no_ukuran_produk'] ?>"
                                                                data-nama_ukuran_produk="<?= $ukuranProduk['nama_ukuran_produk'] ?>">
                                                                <i class="icon-trash bigger-130"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php else: ?>
                                <tr>
                                    <td class="center" colspan="4">Data ukuran produk belum tersedia</td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Tambah -->
            <form name="modal_form1" method="post" enctype="multipart/form-data" action="<?= route_to('simpanUkuranProduk') ?>" onsubmit="return cek_inputan()">
                <div id="modal-form" class="modal hide" tabindex="-1">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger">Tambah Data</h4>
                    </div>
                    <div class="modal-body overflow-scroll">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="control-group">
                                    <label class="control-label" for="no_ukuran_produk">No Ukuran Produk</label>
                                    <div class="controls">
                                        <input class="input-small span12" type="text" id="no_ukuran_produk" placeholder="Masukan no ukuran produk" name="no_ukuran_produk" readonly value="<?= esc($nomor_otomatis) ?>" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="nama_ukuran_produk">Nama Ukuran Produk</label>
                                    <div class="controls">
                                        <input class="input-small span12" type="text" id="nama_ukuran_produk" placeholder="Masukan nama ukuran produk" name="nama_ukuran_produk" />
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
            <form name="modal_form2" method="post" enctype="multipart/form-data" action="<?= route_to('editUkuranProduk') ?>" onsubmit="return cek_inputan_edit()">
                <div id="modal-form2" class="modal hide" tabindex="-1">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger">Edit Data</h4>
                    </div>
                    <div class="modal-body overflow-scroll">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="control-group">
                                    <label class="control-label" for="no_ukuran_produk">No Ukuran Produk</label>
                                    <div class="controls">
                                        <input class="input-small span12 no_ukuran_produk" type="text" id="no_ukuran_produk" placeholder="Masukan no ukuran produk" name="no_ukuran_produk_edit" readonly value="" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="nama_ukuran_produk">Nama Ukuran Produk</label>
                                    <div class="controls">
                                        <input class="input-small span12 nama_ukuran_produk" type="text" id="nama_ukuran_produk" placeholder="Masukan nama ukuran produk" name="nama_ukuran_produk_edit" />
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
                        const no_ukuran_produk = $(this).data('no_ukuran_produk');
                        const nama_ukuran_produk = $(this).data('nama_ukuran_produk');
                        bootbox.confirm(nama_ukuran_produk + " akan dihapus?", function(result) {
                            if (result) {
                                window.location.href = "<?= base_url('dashboard/ukuran_produk/hapus/') ?>" + no_ukuran_produk;
                            }
                        });
                    });

                    $('.btn_edit').on('click', function() {
                        const no_ukuran_produk = $(this).data('no_ukuran_produk');
                        const nama_ukuran_produk = $(this).data('nama_ukuran_produk');
                        $('.no_ukuran_produk').val(no_ukuran_produk);
                        $('.nama_ukuran_produk').val(nama_ukuran_produk);
                        $('#modal-form2').modal('show');
                    });
                });

                function cek_inputan() {
                    if (document.modal_form1.nama_ukuran_produk.value === "") {
                        document.modal_form1.nama_ukuran_produk.focus();
                        alert("Maaf Nama Ukuran Produk masih kosong");
                        return false;
                    }
                }

                function cek_inputan_edit() {
                    if (document.modal_form2.nama_ukuran_produk_edit.value === "") {
                        document.modal_form2.nama_ukuran_produk_edit.focus();
                        alert("Maaf Nama Ukuran Produk masih kosong");
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
                            {
                                "bSortable": false
                            }
                        ]
                    });
                });
            </script>
        </div>
    </div>
</body>

</html>