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
            'merk_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'kategori_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'ukuran_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
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

        // Set primary key
        $this->forge->addKey('no_produk', true);

        // Create table
        $this->forge->createTable('produk');
    }

    public function down()
    {
        $this->forge->dropTable('produk');
    }
}
