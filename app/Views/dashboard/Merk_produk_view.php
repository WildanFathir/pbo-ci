<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>TOKO v1</title>
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
                    <li class="active">Merk Produk</li>
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
                    <a href="<?= route_to('cetakMerkProduk') ?>" target="_blank" role="button" class="btn btn-yellow" data-toggle="modal">Cetak PDF</a>
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
                            <th class="center">No Merk Produk</th>
                            <th class="center">Nama Merk Produk</th>
                            <th class="center">Aksi</th>
                        </thead>
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            <?php if (!empty($data_merk_produk)): ?>
                                <?php $no = 1;
                                foreach ($data_merk_produk as $merkProduk): ?>
                                    <tr class="odd">
                                        <td class="center"><?= $no++ ?></td>
                                        <td class="center"><?= esc($merkProduk['no_merk_produk']) ?></td>
                                        <td class="center"><?= esc($merkProduk['nama_merk_produk']) ?></td>
                                        <td class="td-actions">
                                            <div class="hidden-phone visible-desktop action-buttons">
                                                <a class="green btn_edit" title="Edit Data" href="#"
                                                    data-no_merk_produk="<?= $merkProduk['no_merk_produk'] ?>"
                                                    data-nama_merk_produk="<?= $merkProduk['nama_merk_produk'] ?>">
                                                    <i class="icon-pencil bigger-130"></i>
                                                </a>
                                                <a class="red btn_hapus" href="#"
                                                    data-no_merk_produk="<?= $merkProduk['no_merk_produk'] ?>"
                                                    data-nama_merk_produk="<?= $merkProduk['nama_merk_produk'] ?>">
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
                                                                data-no_merk_produk="<?= $merkProduk['no_merk_produk'] ?>"
                                                                data-nama_merk_produk="<?= $merkProduk['nama_merk_produk'] ?>">
                                                                <i class="icon-pencil bigger-130"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="red btn_hapus" href="#"
                                                                data-no_merk_produk="<?= $merkProduk['no_merk_produk'] ?>"
                                                                data-nama_merk_produk="<?= $merkProduk['nama_merk_produk'] ?>">
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
                                    <td class="center" colspan="4">Data merk produk belum tersedia</td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal Tambah -->
            <form name="modal_form1" method="post" enctype="multipart/form-data" action="<?= route_to('simpanMerkProduk') ?>" onsubmit="return cek_inputan()">
                <div id="modal-form" class="modal hide" tabindex="-1">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger">Tambah Data</h4>
                    </div>
                    <div class="modal-body overflow-scroll">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="control-group">
                                    <label class="control-label" for="no_merk_produk">No Merk Produk</label>
                                    <div class="controls">
                                        <input class="input-small span12" type="text" id="no_merk_produk" placeholder="Masukan no merk produk" name="no_merk_produk" readonly value="<?= esc($nomor_otomatis) ?>" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="nama_merk_produk">Nama Merk Produk</label>
                                    <div class="controls">
                                        <input class="input-small span12" type="text" id="nama_merk_produk" placeholder="Masukan nama merk produk" name="nama_merk_produk" />
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
            <form name="modal_form2" method="post" enctype="multipart/form-data" action="<?= route_to('editMerkProduk') ?>" onsubmit="return cek_inputan_edit()">
                <div id="modal-form2" class="modal hide" tabindex="-1">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="blue bigger">Edit Data</h4>
                    </div>
                    <div class="modal-body overflow-scroll">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="control-group">
                                    <label class="control-label" for="no_merk_produk">No Merk Produk</label>
                                    <div class="controls">
                                        <input class="input-small span12 no_merk_produk" type="text" id="no_merk_produk" placeholder="Masukan no merk produk" name="no_merk_produk_edit" readonly value="" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="nama_merk_produk">Nama Merk Produk</label>
                                    <div class="controls">
                                        <input class="input-small span12 nama_merk_produk" type="text" id="nama_merk_produk" placeholder="Masukan nama merk produk" name="nama_merk_produk_edit" />
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
                        const no_merk_produk = $(this).data('no_merk_produk');
                        const nama_merk_produk = $(this).data('nama_merk_produk');
                        bootbox.confirm(nama_merk_produk + " akan dihapus?", function(result) {
                            if (result) {
                                window.location.href = "<?= base_url('dashboard/merk_produk/hapus/') ?>" + no_merk_produk;
                            }
                        });
                    });

                    $('.btn_edit').on('click', function() {
                        const no_merk_produk = $(this).data('no_merk_produk');
                        const nama_merk_produk = $(this).data('nama_merk_produk');
                        $('.no_merk_produk').val(no_merk_produk);
                        $('.nama_merk_produk').val(nama_merk_produk);
                        $('#modal-form2').modal('show');
                    });
                });

                function cek_inputan() {
                    if (document.modal_form1.nama_merk_produk.value === "") {
                        document.modal_form1.nama_merk_produk.focus();
                        alert("Maaf Nama Merk Produk masih kosong");
                        return false;
                    }
                }

                function cek_inputan_edit() {
                    if (document.modal_form2.nama_merk_produk_edit.value === "") {
                        document.modal_form2.nama_merk_produk_edit.focus();
                        alert("Maaf Nama Merk Produk masih kosong");
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