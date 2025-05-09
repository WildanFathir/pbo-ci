<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KaryawabTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'no_karyawan' => [
                'type'       => 'VARCHAR',
                'constraint' => 10,
            ],
            'nama_karyawan' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => 200,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'foto' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);

        // Set primary key
        $this->forge->addKey('no_karyawan', true);
        
        // Buat tabel
        $this->forge->createTable('karyawan');
    }

    public function down()
    {
        $this->forge->dropTable('karyawan');
    }
}
