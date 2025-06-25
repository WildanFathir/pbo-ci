<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MerkProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'no_merk_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nama_merk_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);

        // Set primary key
        $this->forge->addKey('no_merk_produk', true);

        // Create table
        $this->forge->createTable('merk_produk');
    }

    public function down()
    {
        $this->forge->dropTable('merk_produk');
    }
}
