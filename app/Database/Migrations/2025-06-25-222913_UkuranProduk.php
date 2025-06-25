<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UkuranProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'no_ukuran_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'nama_ukuran_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
        ]);

        // Set primary key
        $this->forge->addKey('no_ukuran_produk', true);

        // Create table
        $this->forge->createTable('ukuran_produk');
    }

    public function down()
    {
        $this->forge->dropTable('ukuran_produk');
    }
}
