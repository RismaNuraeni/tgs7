<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class NemesisSeeder extends Seeder
{
    public function run()
    {
        // USERS
        $this->db->table('users')->insertBatch([
            [
                'username'   => 'superadmin',
                'nama'       => 'Administrator Sistem',
                'email'      => 'admin@kabbandung.go.id',
                'password'   => password_hash('Admin@123', PASSWORD_DEFAULT),
                'role'       => 'super_admin',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'bupati',
                'nama'       => 'H. Dadang Supriatna, S.Ip',
                'email'      => 'bupati@kabbandung.go.id',
                'password'   => password_hash('Bupati@123', PASSWORD_DEFAULT),
                'role'       => 'bupati',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ]);

        // OPD
        $opd = [
            ['kode_opd' => '1.01', 'nama_opd' => 'Dinas Pendidikan Kabupaten Bandung',         'singkatan' => 'Disdik'],
            ['kode_opd' => '1.02', 'nama_opd' => 'Dinas Kesehatan Kabupaten Bandung',          'singkatan' => 'Dinkes'],
            ['kode_opd' => '1.03', 'nama_opd' => 'Dinas Pekerjaan Umum dan Penataan Ruang',    'singkatan' => 'DPUPR'],
            ['kode_opd' => '1.04', 'nama_opd' => 'Dinas Sosial Kabupaten Bandung',             'singkatan' => 'Dinsos'],
            ['kode_opd' => '1.05', 'nama_opd' => 'Badan Pengelolaan Keuangan dan Aset Daerah', 'singkatan' => 'BPKAD'],
            ['kode_opd' => '1.06', 'nama_opd' => 'Dinas Pertanian Kabupaten Bandung',          'singkatan' => 'Distani'],
            ['kode_opd' => '1.07', 'nama_opd' => 'Dinas Lingkungan Hidup Kabupaten Bandung',   'singkatan' => 'DLH'],
            ['kode_opd' => '1.08', 'nama_opd' => 'Dinas Komunikasi dan Informatika',           'singkatan' => 'Diskominfo'],
        ];
        foreach ($opd as &$o) { $o['is_active'] = 1; $o['created_at'] = date('Y-m-d H:i:s'); }
        $this->db->table('opd')->insertBatch($opd);

        // PENGADAAN
        $pengadaan = [
            ['opd_id'=>1,'kode_rup'=>'RUP-2024-001','nama_paket'=>'Pengadaan Buku Teks SD/SMP Kabupaten Bandung 2024',    'metode_pemilihan'=>'Tender',             'nilai_paket'=>4500000000, 'tahun_anggaran'=>2024],
            ['opd_id'=>2,'kode_rup'=>'RUP-2024-002','nama_paket'=>'Pengadaan Alat Kesehatan Puskesmas Cicalengka',        'metode_pemilihan'=>'Pengadaan Langsung', 'nilai_paket'=>850000000,  'tahun_anggaran'=>2024],
            ['opd_id'=>3,'kode_rup'=>'RUP-2024-003','nama_paket'=>'Rehabilitasi Jalan Ciwidey – Rancabali',               'metode_pemilihan'=>'Tender',             'nilai_paket'=>12300000000,'tahun_anggaran'=>2024],
            ['opd_id'=>3,'kode_rup'=>'RUP-2024-004','nama_paket'=>'Pembangunan Jembatan Desa Margaasih',                  'metode_pemilihan'=>'Tender',             'nilai_paket'=>3200000000, 'tahun_anggaran'=>2024],
            ['opd_id'=>5,'kode_rup'=>'RUP-2024-005','nama_paket'=>'Pengadaan Sistem Informasi Keuangan Daerah',           'metode_pemilihan'=>'Tender',             'nilai_paket'=>2100000000, 'tahun_anggaran'=>2024],
            ['opd_id'=>1,'kode_rup'=>'RUP-2024-006','nama_paket'=>'Pembangunan Ruang Kelas Baru SDN 1 Soreang',           'metode_pemilihan'=>'Pengadaan Langsung', 'nilai_paket'=>490000000,  'tahun_anggaran'=>2024],
            ['opd_id'=>2,'kode_rup'=>'RUP-2024-007','nama_paket'=>'Pengadaan Obat-obatan RSUD Majalaya',                  'metode_pemilihan'=>'E-Katalog',          'nilai_paket'=>1750000000, 'tahun_anggaran'=>2024],
            ['opd_id'=>4,'kode_rup'=>'RUP-2024-008','nama_paket'=>'Program Bantuan Sosial Keluarga Rentan',               'metode_pemilihan'=>'Swakelola',          'nilai_paket'=>5600000000, 'tahun_anggaran'=>2024],
        ];
        foreach ($pengadaan as &$p) { $p['jenis_pengadaan']='Barang/Jasa'; $p['status_paket']='Aktif'; $p['created_at']=date('Y-m-d H:i:s'); }
        $this->db->table('pengadaan')->insertBatch($pengadaan);

        // ANGGARAN PRIORITAS
        $anggaran = [
            ['opd_id'=>3,'nama_program'=>'Pembangunan & Rehabilitasi Infrastruktur Jalan',   'bidang'=>'infrastruktur','pagu'=>45000000000,'realisasi'=>32400000000,'prioritas_level'=>1],
            ['opd_id'=>1,'nama_program'=>'Peningkatan Kualitas Pendidikan Dasar',            'bidang'=>'pendidikan',   'pagu'=>38000000000,'realisasi'=>24700000000,'prioritas_level'=>1],
            ['opd_id'=>2,'nama_program'=>'Penguatan Pelayanan Kesehatan Primer',             'bidang'=>'kesehatan',    'pagu'=>28500000000,'realisasi'=>23085000000,'prioritas_level'=>1],
            ['opd_id'=>4,'nama_program'=>'Perlindungan Sosial Keluarga Miskin Ekstrem',      'bidang'=>'sosial',       'pagu'=>22000000000,'realisasi'=>9680000000, 'prioritas_level'=>2],
            ['opd_id'=>6,'nama_program'=>'Pengembangan Sentra Pertanian & Ketahanan Pangan', 'bidang'=>'ekonomi',      'pagu'=>18000000000,'realisasi'=>6660000000, 'prioritas_level'=>2],
            ['opd_id'=>3,'nama_program'=>'Pembangunan Sistem Drainase Perkotaan',            'bidang'=>'infrastruktur','pagu'=>15000000000,'realisasi'=>9000000000, 'prioritas_level'=>2],
            ['opd_id'=>8,'nama_program'=>'Transformasi Digital Pelayanan Publik',            'bidang'=>'ekonomi',      'pagu'=>12000000000,'realisasi'=>4560000000, 'prioritas_level'=>3],
            ['opd_id'=>7,'nama_program'=>'Pengelolaan Sampah & Kebersihan Lingkungan',       'bidang'=>'infrastruktur','pagu'=>9500000000, 'realisasi'=>5700000000, 'prioritas_level'=>3],
        ];
        foreach ($anggaran as &$a) { $a['tahun']=2024; $a['is_prioritas']=1; $a['created_at']=date('Y-m-d H:i:s'); }
        $this->db->table('anggaran_prioritas')->insertBatch($anggaran);

        // ANOMALI
        $anomali = [
            ['pengadaan_id'=>5,'jenis_anomali'=>'Potensi Mark-up Harga',   'deskripsi'=>'Harga satuan melebihi HPS 45% tanpa justifikasi memadai.',              'risk_score'=>87,'status'=>'open'],
            ['pengadaan_id'=>3,'jenis_anomali'=>'Pemenang Tunggal',         'deskripsi'=>'Tender hanya diikuti 1 peserta, berpotensi tidak kompetitif.',          'risk_score'=>72,'status'=>'open'],
            ['pengadaan_id'=>1,'jenis_anomali'=>'Spesifikasi Mengarah',     'deskripsi'=>'Spesifikasi teknis mengarah ke merek tertentu.',                        'risk_score'=>65,'status'=>'reviewed'],
            ['pengadaan_id'=>7,'jenis_anomali'=>'Jadwal Tidak Wajar',       'deskripsi'=>'Jangka waktu pelaksanaan terlalu singkat untuk lingkup pekerjaan.',     'risk_score'=>58,'status'=>'open'],
            ['pengadaan_id'=>4,'jenis_anomali'=>'Ketidaksesuaian Dokumen',  'deskripsi'=>'Dokumen kontrak tidak sesuai RUP yang terdaftar di SIRUP.',             'risk_score'=>91,'status'=>'open'],
        ];
        foreach ($anomali as &$a) { $a['created_at']=date('Y-m-d H:i:s'); }
        $this->db->table('anomaly_detections')->insertBatch($anomali);

        echo "Seeder selesai!\n";
        echo "Login: superadmin / Admin@123  atau  bupati / Bupati@123\n";
    }
}