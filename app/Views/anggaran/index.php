<?= $this->extend('layouts/main') ?>
<?= $this->section('styles') ?>
<style>
    .anggaran-header {
        background: linear-gradient(135deg, rgba(230, 57, 70, .08) 0%, rgba(244, 162, 97, .05) 100%);
        border: 1px solid rgba(230, 57, 70, .15);
        border-radius: 12px;
        padding: 28px 32px;
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .anggaran-header-icon {
        width: 60px;
        height: 60px;
        background: rgba(230, 57, 70, .12);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: var(--accent-red);
        flex-shrink: 0;
    }

    .anggaran-header-text h2 {
        font-family: var(--font-heading);
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .anggaran-header-text p {
        color: var(--text-secondary);
        font-size: 13px;
    }

    .filter-bar {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 16px 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .filter-label {
        font-family: var(--font-mono);
        font-size: 10px;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 2px;
        white-space: nowrap;
    }

    .filter-select {
        background: rgba(255, 255, 255, .04);
        border: 1px solid var(--border);
        border-radius: 6px;
        color: var(--text-primary);
        font-size: 13px;
        padding: 8px 12px;
        font-family: var(--font-body);
        outline: none;
        cursor: pointer;
    }

    .filter-select:focus {
        border-color: rgba(230, 57, 70, .4);
    }

    .btn-filter {
        background: var(--accent-red);
        color: white;
        border: none;
        padding: 8px 18px;
        border-radius: 6px;
        font-size: 12px;
        font-family: var(--font-mono);
        letter-spacing: 1px;
        text-transform: uppercase;
        cursor: pointer;
        transition: background .2s;
    }

    .btn-filter:hover {
        background: #c62a35;
    }

    .summary-cards {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 28px;
    }

    .summary-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 22px;
    }

    .summary-card .s-label {
        font-family: var(--font-mono);
        font-size: 10px;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 10px;
    }

    .summary-card .s-value {
        font-family: var(--font-mono);
        font-size: 24px;
        font-weight: 500;
        margin-bottom: 4px;
    }

    .summary-card .s-sub {
        font-size: 12px;
        color: var(--text-secondary);
    }

    .table-wrap {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
    }

    .table-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .table-title {
        font-family: var(--font-heading);
        font-size: 15px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .table-title i {
        color: var(--accent-amber);
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .data-table th {
        padding: 12px 20px;
        text-align: left;
        font-family: var(--font-mono);
        font-size: 10px;
        color: var(--text-muted);
        letter-spacing: 1.5px;
        text-transform: uppercase;
        border-bottom: 1px solid var(--border);
        background: rgba(255, 255, 255, .02);
    }

    .data-table td {
        padding: 14px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, .04);
        color: var(--text-secondary);
        vertical-align: middle;
    }

    .data-table tr:last-child td {
        border-bottom: none;
    }

    .data-table tr:hover td {
        background: rgba(255, 255, 255, .02);
    }

    .prog-bar {
        height: 5px;
        background: rgba(255, 255, 255, .06);
        border-radius: 3px;
        margin-top: 6px;
        overflow: hidden;
    }

    .prog-fill {
        height: 100%;
        border-radius: 3px;
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-family: var(--font-mono);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .status-aman {
        background: rgba(82, 183, 136, .1);
        color: var(--accent-green);
    }

    .status-perhatian {
        background: rgba(244, 162, 97, .1);
        color: var(--accent-amber);
    }

    .status-kritis {
        background: rgba(230, 57, 70, .1);
        color: var(--accent-red);
    }

    .badge-p {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 9px;
        font-family: var(--font-mono);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .p1 {
        background: rgba(230, 57, 70, .12);
        color: var(--accent-red);
    }

    .p2 {
        background: rgba(244, 162, 97, .12);
        color: var(--accent-amber);
    }

    .p3 {
        background: rgba(76, 201, 240, .12);
        color: var(--accent-blue);
    }

    .export-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 7px;
        font-size: 12px;
        font-family: var(--font-mono);
        text-decoration: none;
        transition: all .2s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .export-pdf {
        background: rgba(230, 57, 70, .1);
        color: var(--accent-red);
        border: 1px solid rgba(230, 57, 70, .2);
    }

    .export-excel {
        background: rgba(82, 183, 136, .1);
        color: var(--accent-green);
        border: 1px solid rgba(82, 183, 136, .2);
    }

    .export-btn:hover {
        filter: brightness(1.2);
    }

    @media(max-width:900px) {
        .summary-cards {
            grid-template-columns: 1fr
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="anggaran-header">
    <div class="anggaran-header-icon"><i class="fas fa-coins"></i></div>
    <div class="anggaran-header-text">
        <h2>Anggaran Prioritas — Kota Tasikmalaya</h2>
        <p>Pemantauan realisasi & kepatuhan belanja prioritas APBD Tahun Anggaran <?= date('Y') ?></p>
    </div>
</div>

<form method="GET" class="filter-bar">
    <span class="filter-label">Filter :</span>
    <select name="tahun" class="filter-select">
        <option value="2024" <?= (request()->getGet('tahun') == '2024') ? 'selected' : '' ?>>TA 2024</option>
        <option value="2023" <?= (request()->getGet('tahun') == '2023') ? 'selected' : '' ?>>TA 2023</option>
    </select>
    <select name="bidang" class="filter-select">
        <option value="">Semua Bidang</option>
        <option value="infrastruktur">Infrastruktur</option>
        <option value="pendidikan">Pendidikan</option>
        <option value="kesehatan">Kesehatan</option>
        <option value="sosial">Sosial</option>
        <option value="ekonomi">Ekonomi</option>
    </select>
    <select name="status" class="filter-select">
        <option value="">Semua Status</option>
        <option value="aman">Aman</option>
        <option value="perhatian">Perlu Perhatian</option>
        <option value="kritis">Kritis</option>
    </select>
    <button type="submit" class="btn-filter"><i class="fas fa-magnifying-glass"></i> Terapkan</button>
</form>

<div class="summary-cards">
    <div class="summary-card">
        <div class="s-label">Total Pagu Prioritas</div>
        <div class="s-value" style="color:var(--accent-amber);">Rp 1.84T</div>
        <div class="s-sub">43.8% dari total APBD</div>
    </div>
    <div class="summary-card">
        <div class="s-label">Realisasi s.d. Sekarang</div>
        <div class="s-value" style="color:var(--accent-green);">Rp 1.12T</div>
        <div class="s-sub">60.9% dari pagu prioritas</div>
    </div>
    <div class="summary-card">
        <div class="s-label">Program Kritis (&lt; 40%)</div>
        <div class="s-value" style="color:var(--accent-red);">7 Program</div>
        <div class="s-sub">Butuh percepatan segera</div>
    </div>
</div>

<div class="table-wrap">
    <div class="table-header">
        <div class="table-title"><i class="fas fa-list-check"></i> Daftar Program Anggaran Prioritas</div>
        <div style="display:flex;gap:8px;">
            <a href="<?= base_url('anggaran/export/pdf') ?>" class="export-btn export-pdf"><i class="fas fa-file-pdf"></i> PDF</a>
            <a href="<?= base_url('anggaran/export/excel') ?>" class="export-btn export-excel"><i class="fas fa-file-excel"></i> Excel</a>
        </div>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Program Prioritas</th>
                <th>Bidang</th>
                <th>OPD</th>
                <th>Pagu (Rp)</th>
                <th>Realisasi</th>
                <th>Status</th>
                <th>Level</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($anggaran_list as $i => $item): ?>
                <tr>
                    <td style="font-family:var(--font-mono);color:var(--text-muted);"><?= $i + 1 ?></td>
                    <td style="color:var(--text-primary);font-weight:500;max-width:220px;">
                        <?= esc($item['nama_program']) ?>
                    </td>
                    <td style="font-size:12px;font-family:var(--font-mono);color:var(--accent-blue);">
                        <?= esc($item['bidang']) ?>
                    </td>
                    <td><?= esc($item['opd']) ?></td>
                    <td style="font-family:var(--font-mono);font-size:12px;color:var(--accent-amber);">
                        <?= number_format($item['pagu'] / 1e9, 2) ?>M
                    </td>
                    <td style="min-width:130px;">
                        <span style="font-family:'JetBrains Mono',monospace;font-size:11px;color:var(--t2);">
                            <?= $item['realisasi_pct'] ?>%
                        </span>
                        <div class="ppb">
                            <div class="ppbf" data-pct="<?= $item['realisasi_pct'] ?>"
                                style="background:<?= $item['color'] ?>;"></div>
                        </div>
                    </td>
                    <td>
                        <span class="bp<?= $item['prioritas_level'] ?>">P<?= $item['prioritas_level'] ?></span>
                    </td>
                    <td><span class="badge-p p<?= $item['prioritas_level'] ?>">P<?= $item['prioritas_level'] ?></span></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>