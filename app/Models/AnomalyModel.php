<?php
namespace App\Models;
use CodeIgniter\Model;

class AnomalyModel extends Model {
    protected $table         = 'anomaly_detections';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['pengadaan_id','jenis_anomali','deskripsi','risk_score',
                                 'status','reviewed_by','created_at','updated_at'];
    protected $useTimestamps = true;
}