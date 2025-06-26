<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'no_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nama_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'no_merk_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'no_kategori_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'no_ukuran_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'harga_beli' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'harga_jual' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'stok' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
        ]);

        $this->forge->addKey('no_produk', true);

        $this->forge->addForeignKey('no_merk_produk', 'merk_produk', 'no_merk_produk', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('no_kategori_produk', 'kategori_produk', 'no_kategori_produk', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('no_ukuran_produk', 'ukuran_produk', 'no_ukuran_produk', 'CASCADE', 'CASCADE');

        $this->forge->createTable('produk');
    }

    public function down()
    {
        $this->forge->dropTable('produk');
    }
}
