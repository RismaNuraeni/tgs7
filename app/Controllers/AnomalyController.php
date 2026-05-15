<?php
namespace App\Controllers;
use App\Models\AnomalyModel;

class AnomalyController extends BaseController
{
    public function index()
    {
        $model = new AnomalyModel();

        $page     = $this->request->getGet('page') ?? 1;
        $severity = $this->request->getGet('severity') ?? '';
        $search   = $this->request->getGet('search') ?? '';
        $perPage  = 25;

        $builder = $model
            ->select('anomaly_detections.*, pengadaan.nama_paket, pengadaan.nilai_paket,
                      pengadaan.metode_pemilihan, opd.nama_opd as opd')
            ->join('pengadaan', 'pengadaan.id = anomaly_detections.pengadaan_id', 'left')
            ->join('opd', 'opd.id = pengadaan.opd_id', 'left')
            ->orderBy('anomaly_detections.risk_score', 'DESC');

        if ($severity) $builder->where('anomaly_detections.jenis_anomali', $severity);
        if ($search)   $builder->like('pengadaan.nama_paket', $search);

        $total = $builder->countAllResults(false);
        $data  = $builder->paginate($perPage, 'default', $page);

        return view('anomali/index', [
            'title'    => 'Deteksi Anomali',
            'anomali'  => $data,
            'total'    => $total,
            'page'     => $page,
            'perPage'  => $perPage,
            'search'   => $search,
            'severity' => $severity,
            'pager'    => $model->pager,
        ]);
    }
}