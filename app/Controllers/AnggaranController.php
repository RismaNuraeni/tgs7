<?php
namespace App\Controllers;
use App\Models\AnggaranModel;

class AnggaranController extends BaseController
{
    public function index()
    {
        $tahun  = $this->request->getGet('tahun')  ?? '2024';
        $bidang = $this->request->getGet('bidang')  ?? '';
        $status = $this->request->getGet('status')  ?? '';

        $builder = (new AnggaranModel())
            ->select('anggaran_prioritas.*, opd.nama_opd as opd')
            ->join('opd', 'opd.id = anggaran_prioritas.opd_id', 'left')
            ->where('anggaran_prioritas.tahun', $tahun)
            ->where('anggaran_prioritas.is_prioritas', 1);

        if ($bidang) $builder->where('anggaran_prioritas.bidang', $bidang);

        $raw = $builder->orderBy('prioritas_level', 'ASC')->findAll();

        $anggaran_list = array_map(function($item) {
            $pct   = $item['pagu'] > 0 ? round(($item['realisasi'] / $item['pagu']) * 100) : 0;
            $class = $pct >= 60 ? 'aman' : ($pct >= 40 ? 'perhatian' : 'kritis');
            $label = $pct >= 60 ? 'Aman' : ($pct >= 40 ? 'Perhatian' : 'Kritis');
            $color = $pct >= 60 ? '#52b788' : ($pct >= 40 ? '#f4a261' : '#e63946');
            return [
                'nama_program'   => $item['nama_program'],
                'bidang'         => $item['bidang'],
                'opd'            => $item['opd'] ?? '-',
                'pagu'           => $item['pagu'],
                'realisasi_pct'  => $pct,
                'status'         => $label,
                'status_class'   => $class,
                'color'          => $color,
                'prioritas_level'=> $item['prioritas_level'] ?? 1,
            ];
        }, $raw);

        if ($status) {
            $anggaran_list = array_values(array_filter($anggaran_list, fn($a) => $a['status_class'] === $status));
        }

        return view('anggaran/index', ['title' => 'Anggaran Prioritas', 'anggaran_list' => $anggaran_list]);
    }

    public function export(string $format = 'pdf')
    {
        return redirect()->back()->with('error', 'Fitur ekspor akan segera tersedia.');
    }
}