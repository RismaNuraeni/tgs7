<?php
namespace App\Models;
use CodeIgniter\Model;

class AktivitasModel extends Model {
    protected $table         = 'aktivitas_log';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['user_id','aksi','ip_address','user_agent','created_at'];
    protected $useTimestamps = false;
}