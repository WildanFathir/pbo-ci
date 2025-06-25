<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KategoriProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'no_kategori_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nama_kategori_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);

        // Set primary key
        $this->forge->addKey('no_kategori_produk', true);

        // Create table
        $this->forge->createTable('kategori_produk');
    }

    public function down()
    {
        $this->forge->dropTable('kategori_produk');
    }
}
