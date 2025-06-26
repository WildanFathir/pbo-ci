<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pemasok extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'no_pemasok' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
            ],
            'nama_pemasok' => [
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
        $this->forge->addKey('no_pemasok', true);

        // Buat tabel
        $this->forge->createTable('pemasok');
    }

    public function down()
    {
        $this->forge->dropTable('pemasok');
    }
}
