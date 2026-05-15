<?php
namespace App\Models;
use CodeIgniter\Model;

class PengadaanModel extends Model {
    protected $table         = 'pengadaan';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['opd_id','kode_rup','nama_paket','jenis_pengadaan','metode_pemilihan',
                                 'nilai_paket','sumber_dana','tahun_anggaran','status_paket','tanggal_input',
                                 'created_at','updated_at'];
    protected $useTimestamps = true;
}