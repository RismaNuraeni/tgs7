<?php
namespace App\Controllers;
use App\Models\PengadaanModel;

class PengadaanController extends BaseController
{
    public function index()
    {
        $model    = new PengadaanModel();
        $page     = $this->request->getGet('page') ?? 1;
        $search   = $this->request->getGet('search') ?? '';
        $metode   = $this->request->getGet('metode') ?? '';
        $jenis    = $this->request->getGet('jenis') ?? '';
        $perPage  = 25;

        $builder = $model
            ->select('pengadaan.*, opd.nama_opd as opd')
            ->join('opd', 'opd.id = pengadaan.opd_id', 'left')
            ->orderBy('pengadaan.nilai_paket', 'DESC');

        if ($search) $builder->like('pengadaan.nama_paket', $search);
        if ($metode) $builder->where('pengadaan.metode_pemilihan', $metode);
        if ($jenis)  $builder->where('pengadaan.jenis_pengadaan', $jenis);

        $total = $builder->countAllResults(false);
        $data  = $builder->paginate($perPage, 'default', $page);

        // Ambil opsi filter unik
        $metode_list = $model->select('metode_pemilihan')
                             ->distinct()->findAll();
        $jenis_list  = $model->select('jenis_pengadaan')
                             ->distinct()->findAll();

        return view('pengadaan/index', [
            'title'       => 'Data Pengadaan SIRUP',
            'pengadaan'   => $data,
            'total'       => $total,
            'page'        => (int)$page,
            'perPage'     => $perPage,
            'search'      => $search,
            'metode'      => $metode,
            'jenis'       => $jenis,
            'metode_list' => $metode_list,
            'jenis_list'  => $jenis_list,
            'pager'       => $model->pager,
        ]);
    }

    public function detail(int $id)
    {
        $model = new PengadaanModel();
        $item  = $model->select('pengadaan.*, opd.nama_opd as opd')
                       ->join('opd', 'opd.id = pengadaan.opd_id', 'left')
                       ->find($id);

        if (!$item) {
            return redirect()->to(base_url('pengadaan'))
                ->with('error', 'Data tidak ditemukan.');
        }

        // Cek apakah ada anomali untuk paket ini
        $anomalyModel = new \App\Models\AnomalyModel();
        $anomali = $anomalyModel->where('pengadaan_id', $id)->findAll();

        return view('pengadaan/detail', [
            'title'   => 'Detail Pengadaan',
            'item'    => $item,
            'anomali' => $anomali,
        ]);
    }
}