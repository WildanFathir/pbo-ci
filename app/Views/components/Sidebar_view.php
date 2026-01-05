<ul class="nav nav-list">
    <li>
        <a href="<?= base_url('dashboard') ?>">
            <i class="icon-home"></i>
            <span class="menu-text"> Dashboard </span>
        </a>
    </li>

    <li>
        <a href="<?= base_url('dashboard/karyawan') ?>">
            <i class="icon-group"></i>
            <span class="menu-text"> Karyawan </span>
        </a>
    </li>

    <li class="">
        <a href="#" class="dropdown-toggle">
            <i class="icon-archive"></i>

            <span class="menu-text">
                Data Produk
            </span>

            <b class="arrow icon-angle-down"></b>
        </a>

        <ul class="submenu">
            <li>
                <a href="<?= base_url('dashboard/kategori_produk') ?>">
                    <i class="icon-double-angle-right"></i>
                    Kategori Produk
                </a>
            </li>

            <li>
                <a href="<?= base_url('dashboard/merk_produk') ?>">
                    <i class="icon-double-angle-right"></i>
                    Merk Produk
                </a>
            </li>

            <li>
                <a href="<?= base_url('dashboard/ukuran_produk') ?>">
                    <i class="icon-double-angle-right"></i>
                    Ukuran
                </a>
            </li>

            <li class="">
                <a href="<?= base_url('dashboard/produk') ?>">
                    <i class="icon-double-angle-right"></i>
                    Produk
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="<?= base_url('dashboard/pelanggan') ?>">
            <i class="icon-user"></i>
            <span class="menu-text"> Pelanggan </span>
        </a>
    </li>

    <li>
        <a href="<?= base_url('dashboard/pemasok') ?>">
            <i class="icon-truck"></i>
            <span class="menu-text"> Pemasok </span>
        </a>
    </li>
</ul>

<div class="sidebar-collapse" id="sidebar-collapse">
    <i class="icon-double-angle-left"></i>
</div>