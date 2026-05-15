<?php
namespace App\Models;
use CodeIgniter\Model;

class OpdModel extends Model {
    protected $table         = 'opd';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['kode_opd','nama_opd','singkatan','kepala_opd','is_active','created_at','updated_at'];
    protected $useTimestamps = true;
}