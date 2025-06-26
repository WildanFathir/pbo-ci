<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth_controller::login');

$routes->group('auth', function ($routes) {
    $routes->get('login', 'auth\Auth_controller::login', ['as' => 'login']);
    $routes->get('logout', 'auth\Auth_controller::logout', ['as' => 'logout']);
    $routes->post('proses', 'auth\Auth_controller::proses', ['as' => 'prosesLogin']);
});

$routes->group('dashboard', function ($routes) {
    // main dashboard route
    $routes->get('/', 'dashboard\Dashboard_controller::index', ['as' => 'dashboard']);

    // karyawan routes
    $routes->get('karyawan', 'dashboard\Karyawan_controller::index', ['as' => 'karyawan']);
    $routes->post('karyawan/simpan', 'dashboard\Karyawan_controller::simpan', ['as' => 'simpanKaryawan']);
    $routes->post('karyawan/edit', 'dashboard\Karyawan_controller::ubah', ['as' => 'editKaryawan']);
    $routes->get('karyawan/hapus/(:any)', 'dashboard\Karyawan_controller::hapus/$1');
    $routes->get('karyawan/cetak', 'dashboard\Karyawan_controller::cetak', ['as' => 'cetakKaryawan']);

    // kategori produk routes
    $routes->get('kategori_produk', 'dashboard\Kategori_produk_controller::index', ['as' => 'kategoriProduk']);
    $routes->post('kategori_produk/simpan', 'dashboard\Kategori_produk_controller::simpan', ['as' => 'simpanKategoriProduk']);
    $routes->post('kategori_produk/edit', 'dashboard\Kategori_produk_controller::ubah', ['as' => 'editKategoriProduk']);
    $routes->get('kategori_produk/hapus/(:any)', 'dashboard\Kategori_produk_controller::hapus/$1', ['as' => 'hapusKategoriProduk']);
    $routes->get('kategori_produk/cetak', 'dashboard\Kategori_produk_controller::cetak', ['as' => 'cetakKategoriProduk']);

    // merk produk routes
    $routes->get('merk_produk', 'dashboard\Merk_produk_controller::index', ['as' => 'merkProduk']);
    $routes->post('merk_produk/simpan', 'dashboard\Merk_produk_controller::simpan', ['as' => 'simpanMerkProduk']);
    $routes->post('merk_produk/edit', 'dashboard\Merk_produk_controller::ubah', ['as' => 'editMerkProduk']);
    $routes->get('merk_produk/hapus/(:any)', 'dashboard\Merk_produk_controller::hapus/$1', ['as' => 'hapusMerkProduk']);
    $routes->get('merk_produk/cetak', 'dashboard\Merk_produk_controller::cetak', ['as' => 'cetakMerkProduk']);

    // ukuran produk routes
    $routes->get('ukuran_produk', 'dashboard\Ukuran_produk_controller::index', ['as' => 'ukuranProduk']);
    $routes->post('ukuran_produk/simpan', 'dashboard\Ukuran_produk_controller::simpan', ['as' => 'simpanUkuranProduk']);
    $routes->post('ukuran_produk/edit', 'dashboard\Ukuran_produk_controller::ubah', ['as' => 'editUkuranProduk']);
    $routes->get('ukuran_produk/hapus/(:any)', 'dashboard\Ukuran_produk_controller::hapus/$1', ['as' => 'hapusUkuranProduk']);
    $routes->get('ukuran_produk/cetak', 'dashboard\Ukuran_produk_controller::cetak', ['as' => 'cetakUkuranProduk']);

    // produk routes
    $routes->get('produk', 'dashboard\Produk_controller::index', ['as' => 'produk']);
    $routes->post('produk/simpan', 'dashboard\Produk_controller::simpan', ['as' => 'simpanProduk']);
    $routes->post('produk/edit', 'dashboard\Produk_controller::ubah', ['as' => 'editProduk']);
    $routes->get('produk/hapus/(:any)', 'dashboard\Produk_controller::hapus/$1', ['as' => 'hapusProduk']);
    $routes->get('produk/cetak', 'dashboard\Produk_controller::cetak', ['as' => 'cetakProduk']);
});
