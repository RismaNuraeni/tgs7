<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Filter Bar -->
<div class="filter-bar">
    <form method="GET" style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;width:100%;">
        <div class="sw" style="flex:1;min-width:200px;margin-bottom:0;">
            <i class="fas fa-magnifying-glass sw-icon"></i>
            <input type="text" name="search" placeholder="Cari nama paket..."
                   value="<?= esc($search) ?>">
        </div>
        <select name="metode" class="filter-select">
            <option value="">Semua Metode</option>
            <?php foreach ($metode_list as $m): ?>
            <?php if ($m['metode_pemilihan']): ?>
            <option value="<?= esc($m['metode_pemilihan']) ?>"
                <?= $metode==$m['metode_pemilihan']?'selected':'' ?>>
                <?= esc($m['metode_pemilihan']) ?>
            </option>
            <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <select name="jenis" class="filter-select">
            <option value="">Semua Jenis</option>
            <?php foreach ($jenis_list as $j): ?>
            <?php if ($j['jenis_pengadaan']): ?>
            <option value="<?= esc($j['jenis_pengadaan']) ?>"
                <?= $jenis==$j['jenis_pengadaan']?'selected':'' ?>>
                <?= esc($j['jenis_pengadaan']) ?>
            </option>
            <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="btn-primary" style="padding:7px 16px;">
            <i class="fas fa-filter"></i> Filter
        </button>
        <?php if ($search || $metode || $jenis): ?>
        <a href="<?= base_url('pengadaan') ?>" class="btn-back" style="padding:7px 14px;">
            <i class="fas fa-xmark"></i> Reset
        </a>
        <?php endif; ?>
    </form>
</div>

<!-- Table -->
<div class="card">
    <div class="card-header">
        <div class="card-title">
            <i class="fas fa-file-contract"></i>
            Data Pengadaan SIRUP — <?= number_format($total) ?> paket
        </div>
        <span style="font-family:'JetBrains Mono',monospace;font-size:10px;color:var(--t3);">
            Kota Tasikmalaya 2024
        </span>
    </div>
    <div style="overflow-x:auto;">
        <table class="rtbl">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Paket</th>
                    <th>OPD / Instansi</th>
                    <th>Jenis</th>
                    <th>Metode</th>
                    <th>Nilai (Rp)</th>
                    <th>Sumber Dana</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pengadaan)): ?>
                <tr><td colspan="8" class="table-empty">Tidak ada data pengadaan.</td></tr>
                <?php else: ?>
                <?php foreach ($pengadaan as $i => $item): ?>
                <tr>
                    <td style="font-family:'JetBrains Mono',monospace;color:var(--t3);font-size:10px;">
                        <?= (($page-1)*$perPage)+$i+1 ?>
                    </td>
                    <td class="pkg" style="max-width:280px;">
                        <?= esc($item['nama_paket']) ?>
                        <?php if ($item['kode_rup']): ?>
                        <div class="tbl-sub"><?= esc($item['kode_rup']) ?></div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="tbl-owner"><?= esc($item['opd'] ?? '-') ?></div>
                    </td>
                    <td>
                        <span class="cat-b" style="background:var(--sage-g);color:var(--sage);border:1px solid var(--bd);">
                            <?= esc($item['jenis_pengadaan'] ?? '-') ?>
                        </span>
                    </td>
                    <td>
                        <span class="mtd"><?= esc($item['metode_pemilihan'] ?? '-') ?></span>
                    </td>
                    <td class="mono" style="color:var(--sage);white-space:nowrap;">
                        <?= number_format($item['nilai_paket']) ?>
                    </td>
                    <td>
                        <span class="src-b" style="background:var(--olive-g);color:var(--t2);">
                            <?= esc(substr($item['sumber_dana'] ?? '-', 0, 20)) ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?= base_url('pengadaan/detail/'.$item['id']) ?>"
                           class="btn-edit" style="white-space:nowrap;">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pager -->
    <div style="padding:14px 16px;">
        <?php $totalPages = ceil($total / $perPage); ?>
        <div class="pager">
            <a href="?page=<?= max(1,$page-1) ?>&search=<?= esc($search) ?>&metode=<?= esc($metode) ?>&jenis=<?= esc($jenis) ?>"
               class="pager-btn" <?= $page<=1?'style="opacity:.4;pointer-events:none;"':'' ?>>
                ← Sebelumnya
            </a>
            <span class="pager-text">
                Halaman <?= $page ?> dari <?= $totalPages ?>
                &nbsp;·&nbsp;
                <?= number_format($total) ?> total paket
            </span>
            <a href="?page=<?= min($totalPages,$page+1) ?>&search=<?= esc($search) ?>&metode=<?= esc($metode) ?>&jenis=<?= esc($jenis) ?>"
               class="pager-btn" <?= $page>=$totalPages?'style="opacity:.4;pointer-events:none;"':'' ?>>
                Selanjutnya →
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>