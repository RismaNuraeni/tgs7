<?php
namespace App\Models;
use CodeIgniter\Model;

class AnggaranModel extends Model {
    protected $table         = 'anggaran_prioritas';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['opd_id','nama_program','bidang','pagu','realisasi','tahun',
                                 'is_prioritas','prioritas_level','keterangan','created_at','updated_at'];
    protected $useTimestamps = true;
}