<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div style="margin-bottom:16px;">
    <a href="<?= base_url('pengadaan') ?>" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<!-- Info Utama -->
<div class="card" style="margin-bottom:16px;">
    <div class="card-header">
        <div class="card-title">
            <i class="fas fa-file-contract"></i> Detail Paket Pengadaan
        </div>
        <span class="mono" style="font-size:11px;color:var(--t3);">
            RUP #<?= esc($item['kode_rup'] ?? '-') ?>
        </span>
    </div>
    <div class="card-body">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
            <div>
                <div style="margin-bottom:14px;">
                    <div class="kl">Nama Paket</div>
                    <div style="font-size:14px;font-weight:700;color:var(--t1);margin-top:4px;line-height:1.5;">
                        <?= esc($item['nama_paket']) ?>
                    </div>
                </div>
                <div style="margin-bottom:14px;">
                    <div class="kl">OPD / Instansi</div>
                    <div style="font-size:13px;color:var(--t1);margin-top:4px;"><?= esc($item['opd'] ?? '-') ?></div>
                </div>
                <div style="margin-bottom:14px;">
                    <div class="kl">Jenis Pengadaan</div>
                    <span class="cat-b" style="background:var(--sage-g);color:var(--sage);border:1px solid var(--bd);margin-top:4px;display:inline-block;">
                        <?= esc($item['jenis_pengadaan'] ?? '-') ?>
                    </span>
                </div>
                <div style="margin-bottom:14px;">
                    <div class="kl">Metode Pemilihan</div>
                    <div style="font-size:13px;color:var(--t2);margin-top:4px;"><?= esc($item['metode_pemilihan'] ?? '-') ?></div>
                </div>
            </div>
            <div>
                <div style="margin-bottom:14px;">
                    <div class="kl">Nilai Paket</div>
                    <div class="kv" style="color:var(--sage);margin-top:4px;">
                        Rp <?= number_format($item['nilai_paket']) ?>
                    </div>
                </div>
                <div style="margin-bottom:14px;">
                    <div class="kl">Sumber Dana</div>
                    <div style="font-size:13px;color:var(--t2);margin-top:4px;"><?= esc($item['sumber_dana'] ?? '-') ?></div>
                </div>
                <div style="margin-bottom:14px;">
                    <div class="kl">Tahun Anggaran</div>
                    <div class="mono" style="font-size:16px;color:var(--t1);margin-top:4px;"><?= $item['tahun_anggaran'] ?? '-' ?></div>
                </div>
                <div>
                    <div class="kl">Status</div>
                    <span class="st-b st-aman" style="margin-top:4px;display:inline-block;">
                        <?= esc($item['status_paket'] ?? 'Aktif') ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Anomali terkait -->
<div class="card">
    <div class="card-header">
        <div class="card-title">
            <i class="fas fa-triangle-exclamation"></i>
            Anomali Terkait — <?= count($anomali) ?> ditemukan
        </div>
    </div>
    <?php if (empty($anomali)): ?>
    <div class="card-body">
        <div class="panel-msg">
            <i class="fas fa-check-circle" style="color:var(--sage);margin-right:8px;"></i>
            Tidak ada anomali terdeteksi untuk paket ini.
        </div>
    </div>
    <?php else: ?>
    <table class="rtbl">
        <thead>
            <tr><th>Jenis Anomali</th><th>Deskripsi</th><th>Risk Score</th><th>Status</th></tr>
        </thead>
        <tbody>
            <?php foreach ($anomali as $a): ?>
            <?php $risk = $a['risk_score']; $sev = $risk>=75?'high':($risk>=50?'med':'low'); ?>
            <tr>
                <td><span class="sev-b sev-<?= $sev ?>"><?= esc($a['jenis_anomali']) ?></span></td>
                <td class="reason"><?= esc($a['deskripsi'] ?? '-') ?></td>
                <td class="mono" style="color:<?= $risk>=75?'var(--rose)':($risk>=50?'var(--brick)':'var(--steel)') ?>;">
                    <?= $risk ?>
                </td>
                <td><span class="st-b <?= $a['status']=='open'?'st-kritis':'st-aman' ?>"><?= strtoupper($a['status']) ?></span></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>