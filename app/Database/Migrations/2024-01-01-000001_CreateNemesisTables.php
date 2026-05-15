<?php
namespace App\Database\Migrations;
use CodeIgniter\Database\Migration;

class CreateNemesisTables extends Migration
{
    public function up()
    {
        // USERS
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'username'   => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'nama'       => ['type' => 'VARCHAR', 'constraint' => 200],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true],
            'password'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'role'       => ['type' => 'ENUM', 'constraint' => ['super_admin','bupati'], 'default' => 'bupati'],
            'is_active'  => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');

        // OPD
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kode_opd'   => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'nama_opd'   => ['type' => 'VARCHAR', 'constraint' => 300],
            'singkatan'  => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'kepala_opd' => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true],
            'is_active'  => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('opd');

        // PENGADAAN
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'opd_id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'kode_rup'        => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'nama_paket'      => ['type' => 'TEXT'],
            'jenis_pengadaan' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'metode_pemilihan'=> ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'nilai_paket'     => ['type' => 'BIGINT', 'default' => 0],
            'sumber_dana'     => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'tahun_anggaran'  => ['type' => 'YEAR', 'null' => true],
            'status_paket'    => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('opd_id', 'opd', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('pengadaan');

        // ANGGARAN_PRIORITAS
        $this->forge->addField([
            'id'              => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'opd_id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'nama_program'    => ['type' => 'VARCHAR', 'constraint' => 300],
            'bidang'          => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'pagu'            => ['type' => 'BIGINT', 'default' => 0],
            'realisasi'       => ['type' => 'BIGINT', 'default' => 0],
            'tahun'           => ['type' => 'YEAR'],
            'is_prioritas'    => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'prioritas_level' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'keterangan'      => ['type' => 'TEXT', 'null' => true],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('opd_id', 'opd', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('anggaran_prioritas');

        // ANOMALY_DETECTIONS
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'pengadaan_id'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'jenis_anomali' => ['type' => 'VARCHAR', 'constraint' => 200, 'null' => true],
            'deskripsi'     => ['type' => 'TEXT', 'null' => true],
            'risk_score'    => ['type' => 'TINYINT', 'unsigned' => true, 'default' => 0],
            'status'        => ['type' => 'ENUM', 'constraint' => ['open','reviewed','closed'], 'default' => 'open'],
            'reviewed_by'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('pengadaan_id', 'pengadaan', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('anomaly_detections');

        // AKTIVITAS_LOG
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'aksi'       => ['type' => 'VARCHAR', 'constraint' => 300],
            'ip_address' => ['type' => 'VARCHAR', 'constraint' => 45, 'null' => true],
            'user_agent' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('aktivitas_log');
    }

    public function down()
    {
        $this->forge->dropTable('aktivitas_log', true);
        $this->forge->dropTable('anomaly_detections', true);
        $this->forge->dropTable('anggaran_prioritas', true);
        $this->forge->dropTable('pengadaan', true);
        $this->forge->dropTable('opd', true);
        $this->forge->dropTable('users', true);
    }
}