<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="filter-bar">
    <form method="GET" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;width:100%;">
        <div class="sw" style="flex:1;min-width:200px;margin-bottom:0;">
            <i class="fas fa-magnifying-glass sw-icon"></i>
            <input type="text" name="search" placeholder="Cari nama paket..."
                   value="<?= esc($search) ?>">
        </div>
        <select name="severity" class="filter-select">
            <option value="">Semua Jenis</option>
            <option value="Indikasi Pemborosan"  <?= $severity=='Indikasi Pemborosan' ?'selected':'' ?>>Indikasi Pemborosan</option>
            <option value="Potensi Korupsi"      <?= $severity=='Potensi Korupsi'     ?'selected':'' ?>>Potensi Korupsi</option>
            <option value="Anomali Ekstrem"      <?= $severity=='Anomali Ekstrem'     ?'selected':'' ?>>Anomali Ekstrem</option>
        </select>
        <button type="submit" class="btn-primary" style="padding:7px 16px;">
            <i class="fas fa-filter"></i> Filter
        </button>
    </form>
</div>

<div class="card">
    <div class="card-header">
        <div class="card-title">
            <i class="fas fa-triangle-exclamation"></i>
            Daftar Anomali — <?= number_format($total) ?> ditemukan
        </div>
    </div>
    <div style="overflow-x:auto;">
        <table class="rtbl">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Paket</th>
                    <th>OPD</th>
                    <th>Nilai</th>
                    <th>Jenis Anomali</th>
                    <th>Risk Score</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($anomali)): ?>
                <tr><td colspan="7" class="table-empty">Tidak ada data anomali.</td></tr>
                <?php else: ?>
                <?php foreach ($anomali as $i => $item): ?>
                <?php
                    $risk  = $item['risk_score'];
                    $sev   = $risk >= 75 ? 'high' : ($risk >= 50 ? 'med' : 'low');
                    $color = $risk >= 75 ? 'var(--rose)' : ($risk >= 50 ? 'var(--brick)' : 'var(--steel)');
                ?>
                <tr>
                    <td style="font-family:'JetBrains Mono',monospace;color:var(--t3);font-size:10px;">
                        <?= (($page-1)*$perPage)+$i+1 ?>
                    </td>
                    <td class="pkg"><?= esc($item['nama_paket'] ?? '-') ?></td>
                    <td style="font-size:11px;"><?= esc($item['opd'] ?? '-') ?></td>
                    <td class="mono" style="color:var(--sage);">
                        Rp <?= number_format(($item['nilai_paket'] ?? 0)/1e6, 1) ?>M
                    </td>
                    <td>
                        <span class="sev-b sev-<?= $sev ?>"><?= esc($item['jenis_anomali']) ?></span>
                    </td>
                    <td>
                        <span class="mono" style="color:<?= $color ?>;"><?= $risk ?></span>
                        <div class="ppb" style="width:80px;">
                            <div class="ppbf" style="width:<?= $risk ?>%;background:<?= $color ?>;"></div>
                        </div>
                    </td>
                    <td>
                        <span class="st-b <?= $item['status']=='open'?'st-kritis':($item['status']=='reviewed'?'st-perhatian':'st-aman') ?>">
                            <?= strtoupper($item['status']) ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($pager): ?>
    <div style="padding:14px 16px;">
        <div class="pager">
            <?php
            $currentPage = $page;
            $totalPages  = ceil($total / $perPage);
            ?>
            <a href="?page=<?= max(1,$currentPage-1) ?>&search=<?= esc($search) ?>&severity=<?= esc($severity) ?>"
               class="pager-btn" <?= $currentPage<=1?'style="opacity:.4;pointer-events:none;"':'' ?>>
                ← Sebelumnya
            </a>
            <span class="pager-text">Halaman <?= $currentPage ?> dari <?= $totalPages ?></span>
            <a href="?page=<?= min($totalPages,$currentPage+1) ?>&search=<?= esc($search) ?>&severity=<?= esc($severity) ?>"
               class="pager-btn" <?= $currentPage>=$totalPages?'style="opacity:.4;pointer-events:none;"':'' ?>>
                Selanjutnya →
            </a>
        </div>
    </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>