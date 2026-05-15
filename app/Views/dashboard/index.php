<?= $this->extend('layouts/main') ?>
<?= $this->section('styles') ?>
<style>
    .stats-row { display:grid; grid-template-columns:repeat(4,1fr); gap:20px; margin-bottom:32px; }
    .stat-card { background:var(--bg-card); border:1px solid var(--border); border-radius:12px; padding:24px; position:relative; overflow:hidden; transition:border-color .2s,transform .2s; }
    .stat-card:hover { border-color:rgba(255,255,255,.15); transform:translateY(-2px); }
    .stat-card .icon { width:40px; height:40px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:17px; margin-bottom:16px; }
    .stat-card.red .icon   { background:rgba(230,57,70,.12);  color:var(--accent-red); }
    .stat-card.amber .icon { background:rgba(244,162,97,.12); color:var(--accent-amber); }
    .stat-card.blue .icon  { background:rgba(76,201,240,.12); color:var(--accent-blue); }
    .stat-card.green .icon { background:rgba(82,183,136,.12); color:var(--accent-green); }
    .stat-card .value { font-family:var(--font-mono); font-size:28px; font-weight:500; line-height:1; margin-bottom:6px; }
    .stat-card .label { font-size:12px; color:var(--text-secondary); }
    .stat-card .change { display:inline-flex; align-items:center; gap:4px; font-size:11px; font-family:var(--font-mono); margin-top:10px; padding:3px 8px; border-radius:4px; }
    .change.up   { background:rgba(230,57,70,.1);   color:var(--accent-red); }
    .change.down { background:rgba(82,183,136,.1);  color:var(--accent-green); }

    .content-grid { display:grid; grid-template-columns:1fr 340px; gap:24px; margin-bottom:24px; }
    .card { background:var(--bg-card); border:1px solid var(--border); border-radius:12px; overflow:hidden; }
    .card-header { padding:20px 24px 16px; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; }
    .card-title { font-family:var(--font-heading); font-size:15px; font-weight:700; display:flex; align-items:center; gap:10px; }
    .card-title i { color:var(--accent-red); font-size:13px; }
    .card-body { padding:24px; }

    .data-table { width:100%; border-collapse:collapse; font-size:13px; }
    .data-table th { padding:10px 16px; text-align:left; font-family:var(--font-mono); font-size:10px; color:var(--text-muted); letter-spacing:1.5px; text-transform:uppercase; border-bottom:1px solid var(--border); }
    .data-table td { padding:12px 16px; border-bottom:1px solid rgba(255,255,255,.04); color:var(--text-secondary); vertical-align:middle; }
    .data-table tr:last-child td { border-bottom:none; }
    .data-table tr:hover td { background:rgba(255,255,255,.02); }

    .risk-badge { display:inline-flex; align-items:center; gap:4px; padding:3px 10px; border-radius:4px; font-size:10px; font-family:var(--font-mono); font-weight:500; text-transform:uppercase; letter-spacing:1px; }
    .risk-high  { background:rgba(230,57,70,.12);  color:var(--accent-red);   border:1px solid rgba(230,57,70,.2); }
    .risk-med   { background:rgba(244,162,97,.12); color:var(--accent-amber); border:1px solid rgba(244,162,97,.2); }
    .risk-low   { background:rgba(82,183,136,.12); color:var(--accent-green); border:1px solid rgba(82,183,136,.2); }

    .prog-item { margin-bottom:18px; }
    .prog-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; }
    .prog-name { font-size:13px; font-weight:500; }
    .prog-pct { font-family:var(--font-mono); font-size:12px; color:var(--text-secondary); }
    .prog-bar { height:6px; background:rgba(255,255,255,.05); border-radius:3px; overflow:hidden; }
    .prog-fill { height:100%; border-radius:3px; }

    .view-all { display:inline-flex; align-items:center; gap:6px; font-size:12px; color:var(--text-secondary); text-decoration:none; font-family:var(--font-mono); padding:6px 12px; border:1px solid var(--border); border-radius:6px; transition:all .2s; }
    .view-all:hover { border-color:var(--accent-red); color:var(--accent-red); }

    .bupati-banner { background:rgba(230,57,70,.06); border:1px solid rgba(230,57,70,.15); border-radius:10px; padding:16px 20px; margin-bottom:24px; display:flex; align-items:center; gap:14px; }
    .bupati-banner-icon { width:40px; height:40px; background:rgba(230,57,70,.12); border-radius:50%; display:flex; align-items:center; justify-content:center; color:var(--accent-red); font-size:18px; flex-shrink:0; }
    .bupati-banner .level { font-family:var(--font-mono); font-size:11px; color:var(--accent-red); letter-spacing:2px; }
    .bupati-banner .msg { font-size:14px; font-weight:500; margin-top:2px; }

    @media(max-width:1200px){ .stats-row{grid-template-columns:repeat(2,1fr)} .content-grid{grid-template-columns:1fr} }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if (session()->get('role') === 'bupati'): ?>
<div class="bupati-banner">
    <div class="bupati-banner-icon"><i class="fas fa-shield-halved"></i></div>
    <div>
        <div class="level">// LEVEL AKSES: BUPATI</div>
        <div class="msg">Selamat datang, <?= esc(session()->get('nama')) ?>. Anda memantau ringkasan anggaran prioritas Kabupaten Bandung.</div>
    </div>
</div>
<?php endif; ?>

<!-- Stats -->
<div class="stats-row">
    <div class="stat-card red">
        <div class="icon"><i class="fas fa-triangle-exclamation"></i></div>
        <div class="value"><?= number_format($stats['anomali']) ?></div>
        <div class="label">Anomali Terdeteksi</div>
        <span class="change up"><i class="fas fa-arrow-up"></i> +12 bulan ini</span>
    </div>
    <div class="stat-card amber">
        <div class="icon"><i class="fas fa-coins"></i></div>
        <div class="value">Rp <?= $stats['anggaran_triliun'] ?>T</div>
        <div class="label">Total Anggaran Terpantau</div>
        <span class="change down"><i class="fas fa-arrow-down"></i> -2.1% efisiensi</span>
    </div>
    <div class="stat-card blue">
        <div class="icon"><i class="fas fa-file-contract"></i></div>
        <div class="value"><?= number_format($stats['paket']) ?></div>
        <div class="label">Paket Pengadaan</div>
        <span class="change up"><i class="fas fa-arrow-up"></i> +148 baru</span>
    </div>
    <div class="stat-card green">
        <div class="icon"><i class="fas fa-building-columns"></i></div>
        <div class="value"><?= $stats['opd'] ?></div>
        <div class="label">OPD Terpantau</div>
        <span class="change down"><i class="fas fa-check"></i> Semua aktif</span>
    </div>
</div>

<!-- Content Grid -->
<div class="content-grid">
    <div class="card">
        <div class="card-header">
            <div class="card-title"><i class="fas fa-radar"></i> Anomali Terkini</div>
            <a href="<?= base_url('anomali') ?>" class="view-all">Lihat Semua <i class="fas fa-arrow-right"></i></a>
        </div>
        <table class="data-table">
            <thead>
                <tr><th>Paket Pengadaan</th><th>OPD</th><th>Nilai</th><th>Risiko</th></tr>
            </thead>
            <tbody>
                <?php foreach ($anomali_terkini as $item): ?>
                <tr>
                    <td style="color:var(--text-primary);font-weight:500;max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                        <?= esc($item['nama_paket']) ?>
                    </td>
                    <td><?= esc($item['opd']) ?></td>
                    <td style="font-family:var(--font-mono);font-size:12px;color:var(--accent-amber);">
                        Rp <?= number_format($item['nilai'] / 1e6, 1) ?>M
                    </td>
                    <td><span class="risk-badge risk-<?= $item['risiko_class'] ?>"><?= $item['risiko'] ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="card-title"><i class="fas fa-chart-pie"></i> Realisasi per OPD</div>
        </div>
        <div class="card-body">
            <?php foreach ($realisasi_opd as $opd): ?>
            <div class="prog-item">
                <div class="prog-header">
                    <span class="prog-name"><?= esc($opd['nama']) ?></span>
                    <span class="prog-pct"><?= $opd['pct'] ?>%</span>
                </div>
                <div class="prog-bar">
                    <div class="prog-fill" style="width:<?= $opd['pct'] ?>%;background:<?= $opd['color'] ?>;"></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Aktivitas -->
<div class="card">
    <div class="card-header">
        <div class="card-title"><i class="fas fa-clock-rotate-left"></i> Aktivitas Sistem Terbaru</div>
    </div>
    <table class="data-table">
        <thead>
            <tr><th>Waktu</th><th>Aksi</th><th>User</th><th>Status</th></tr>
        </thead>
        <tbody>
            <?php foreach ($aktivitas as $a): ?>
            <tr>
                <td style="font-family:var(--font-mono);font-size:11px;"><?= esc($a['waktu']) ?></td>
                <td><?= esc($a['aksi']) ?></td>
                <td style="color:var(--accent-blue);"><?= esc($a['user']) ?></td>
                <td><span class="risk-badge risk-<?= $a['status_class'] ?>"><?= $a['status'] ?></span></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>