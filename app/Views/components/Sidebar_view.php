<ul class="nav nav-list">
    <li>
        <a href="<?= route_to('dashboard') ?>">
            <i class="icon-dashboard"></i>
            <span class="menu-text"> Dashboard </span>
        </a>
    </li>

    <li>
        <a href="<?= route_to('karyawan') ?>">
            <i class="icon-text-width"></i>
            <span class="menu-text"> Karyawan </span>
        </a>
    </li>

    <li class="">
        <a href="#" class="dropdown-toggle">
            <i class="icon-file-alt"></i>

            <span class="menu-text">
                Data Produk
                <span class="badge badge-primary ">4</span>
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
                <a href="error-500.html">
                    <i class="icon-double-angle-right"></i>
                    Merk Produk
                </a>
            </li>

            <li>
                <a href="grid.html">
                    <i class="icon-double-angle-right"></i>
                    Ukuran
                </a>
            </li>

            <li class="">
                <a href="blank.html">
                    <i class="icon-double-angle-right"></i>
                    Produk
                </a>
            </li>
        </ul>
    </li>
</ul>

<div class="sidebar-collapse" id="sidebar-collapse">
    <i class="icon-double-angle-left"></i>
</div>