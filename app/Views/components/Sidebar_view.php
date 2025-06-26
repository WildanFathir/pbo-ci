<ul class="nav nav-list">
    <li>
        <a href="<?= route_to('dashboard') ?>">
            <i class="icon-home"></i>
            <span class="menu-text"> Dashboard </span>
        </a>
    </li>

    <li>
        <a href="<?= route_to('karyawan') ?>">
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
                <a href="<?= route_to('kategoriProduk') ?>">
                    <i class="icon-double-angle-right"></i>
                    Kategori Produk
                </a>
            </li>

            <li>
                <a href="<?= route_to('merkProduk') ?>">
                    <i class="icon-double-angle-right"></i>
                    Merk Produk
                </a>
            </li>

            <li>
                <a href="<?= route_to('ukuranProduk') ?>">
                    <i class="icon-double-angle-right"></i>
                    Ukuran
                </a>
            </li>

            <li class="">
                <a href="<?= route_to('produk') ?>">
                    <i class="icon-double-angle-right"></i>
                    Produk
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="<?= route_to('pelanggan') ?>">
            <i class="icon-user"></i>
            <span class="menu-text"> Pelanggan </span>
        </a>
    </li>

    <li>
        <a href="<?= route_to('pemasok') ?>">
            <i class="icon-truck"></i>
            <span class="menu-text"> Pemasok </span>
        </a>
    </li>
</ul>

<div class="sidebar-collapse" id="sidebar-collapse">
    <i class="icon-double-angle-left"></i>
</div>