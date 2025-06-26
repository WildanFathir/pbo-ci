<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelanggan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'no_pelanggan' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
            ],
            'nama_pelanggan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'no_telp' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);

        // Set primary key
        $this->forge->addKey('no_pelanggan', true);

        // Buat tabel
        $this->forge->createTable('pelanggan');
    }

    public function down()
    {
        $this->forge->dropTable('pelanggan');
    }
}
