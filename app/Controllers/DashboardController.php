<?php
namespace App\Controllers;
use App\Models\PengadaanModel;
use App\Models\AnomalyModel;
use App\Models\OpdModel;
use App\Models\AktivitasModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $stats = [
            'anomali'          => (new AnomalyModel())->countAll(),
            'paket'            => (new PengadaanModel())->countAll(),
            'opd'              => (new OpdModel())->countAll(),
            'anggaran_triliun' => '4.2',
        ];

        $anomali_raw = (new AnomalyModel())
            ->select('anomaly_detections.*, pengadaan.nama_paket, opd.nama_opd as opd, pengadaan.nilai_paket')
            ->join('pengadaan', 'pengadaan.id = anomaly_detections.pengadaan_id', 'left')
            ->join('opd', 'opd.id = pengadaan.opd_id', 'left')
            ->orderBy('anomaly_detections.created_at', 'DESC')
            ->limit(5)->findAll();

        $anomali_terkini = array_map(function($a) {
            $s = $a['risk_score'] ?? 50;
            return [
                'nama_paket'   => $a['nama_paket'] ?? '-',
                'opd'          => $a['opd'] ?? '-',
                'nilai'        => $a['nilai_paket'] ?? 0,
                'risiko'       => $s >= 75 ? 'TINGGI' : ($s >= 50 ? 'SEDANG' : 'RENDAH'),
                'risiko_class' => $s >= 75 ? 'high'   : ($s >= 50 ? 'med'    : 'low'),
            ];
        }, $anomali_raw);

        $realisasi_opd = [
            ['nama' => 'Dinas PUPR',       'pct' => 72, 'color' => '#4cc9f0'],
            ['nama' => 'Dinas Pendidikan', 'pct' => 65, 'color' => '#52b788'],
            ['nama' => 'Dinas Kesehatan',  'pct' => 81, 'color' => '#52b788'],
            ['nama' => 'Dinas Sosial',     'pct' => 44, 'color' => '#f4a261'],
            ['nama' => 'BPKAD',            'pct' => 58, 'color' => '#4cc9f0'],
            ['nama' => 'Dinas Pertanian',  'pct' => 37, 'color' => '#e63946'],
        ];

        $log_raw = (new AktivitasModel())
            ->select('aktivitas_log.*, users.nama as user_nama')
            ->join('users', 'users.id = aktivitas_log.user_id', 'left')
            ->orderBy('aktivitas_log.created_at', 'DESC')
            ->limit(6)->findAll();

        $aktivitas = array_map(fn($l) => [
            'waktu'        => date('d/m H:i', strtotime($l['created_at'])),
            'aksi'         => $l['aksi'],
            'user'         => $l['user_nama'] ?? 'System',
            'status'       => 'OK',
            'status_class' => 'low',
        ], $log_raw);

        if (empty($aktivitas)) {
            $aktivitas = [['waktu' => date('d/m H:i'), 'aksi' => 'Sistem aktif', 'user' => 'System', 'status' => 'OK', 'status_class' => 'low']];
        }

        return view('dashboard/index', compact('stats', 'anomali_terkini', 'realisasi_opd', 'aktivitas') + ['title' => 'Dashboard Pengawasan']);
    }
}