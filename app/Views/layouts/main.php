<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'NEMESIS' ?> | Kab. Bandung</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@400;500&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --bg-primary: #0a0e1a;
            --bg-secondary: #0f1628;
            --bg-card: #131d35;
            --accent-red: #e63946;
            --accent-amber: #f4a261;
            --accent-blue: #4cc9f0;
            --accent-green: #52b788;
            --text-primary: #e8eaf6;
            --text-secondary: #8892a4;
            --text-muted: #4a5568;
            --border: rgba(255,255,255,0.07);
            --border-accent: rgba(230,57,70,0.3);
            --font-heading: 'Syne', sans-serif;
            --font-mono: 'DM Mono', monospace;
            --font-body: 'DM Sans', sans-serif;
            --sidebar-width: 260px;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-body); background: var(--bg-primary); color: var(--text-primary); min-height: 100vh; display: flex; }

        /* SIDEBAR */
        .sidebar { width: var(--sidebar-width); background: var(--bg-secondary); border-right: 1px solid var(--border); height: 100vh; position: fixed; top: 0; left: 0; display: flex; flex-direction: column; z-index: 100; overflow-y: auto; }
        .sidebar-brand { padding: 28px 24px 20px; border-bottom: 1px solid var(--border); }
        .brand-tag { font-family: var(--font-mono); font-size: 10px; color: var(--accent-red); letter-spacing: 3px; text-transform: uppercase; display: block; margin-bottom: 6px; }
        .brand-name { font-family: var(--font-heading); font-size: 26px; font-weight: 800; letter-spacing: -1px; line-height: 1; }
        .brand-name span { color: var(--accent-red); }
        .brand-sub { font-size: 11px; color: var(--text-secondary); margin-top: 6px; line-height: 1.4; font-weight: 300; }
        .sidebar-region { padding: 16px 24px; background: rgba(230,57,70,0.06); border-bottom: 1px solid var(--border-accent); }
        .region-label { font-size: 9px; color: var(--accent-red); font-family: var(--font-mono); letter-spacing: 2px; text-transform: uppercase; display: block; margin-bottom: 4px; }
        .region-name { font-size: 13px; font-weight: 600; font-family: var(--font-heading); }
        .sidebar-nav { padding: 20px 12px; flex: 1; }
        .nav-section-label { font-size: 9px; font-family: var(--font-mono); color: var(--text-muted); letter-spacing: 2px; text-transform: uppercase; padding: 0 12px; margin-bottom: 8px; margin-top: 20px; }
        .nav-section-label:first-child { margin-top: 0; }
        .nav-link { display: flex; align-items: center; gap: 12px; padding: 10px 12px; border-radius: 8px; text-decoration: none; color: var(--text-secondary); font-size: 13.5px; font-weight: 500; transition: all 0.2s; margin-bottom: 2px; }
        .nav-link i { width: 18px; text-align: center; font-size: 14px; }
        .nav-link:hover { background: rgba(255,255,255,0.05); color: var(--text-primary); }
        .nav-link.active { background: rgba(230,57,70,0.12); color: var(--accent-red); border-left: 2px solid var(--accent-red); }
        .nav-badge { margin-left: auto; background: var(--accent-red); color: white; font-size: 9px; font-family: var(--font-mono); padding: 2px 6px; border-radius: 4px; }
        .sidebar-footer { padding: 16px 24px; border-top: 1px solid var(--border); }
        .user-card { display: flex; align-items: center; gap: 10px; }
        .user-avatar { width: 34px; height: 34px; border-radius: 50%; background: linear-gradient(135deg, var(--accent-red), #ff6b9d); display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; color: white; flex-shrink: 0; }
        .user-info { flex: 1; min-width: 0; }
        .user-name { font-size: 13px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .user-role { font-size: 10px; color: var(--accent-amber); font-family: var(--font-mono); text-transform: uppercase; letter-spacing: 1px; }
        .logout-btn { color: var(--text-muted); text-decoration: none; font-size: 14px; transition: color 0.2s; }
        .logout-btn:hover { color: var(--accent-red); }

        /* MAIN */
        .main-content { margin-left: var(--sidebar-width); flex: 1; min-height: 100vh; display: flex; flex-direction: column; }
        .topbar { background: var(--bg-secondary); border-bottom: 1px solid var(--border); padding: 16px 32px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 50; }
        .page-title-area h1 { font-family: var(--font-heading); font-size: 20px; font-weight: 700; }
        .page-title-area .breadcrumb { font-size: 12px; color: var(--text-secondary); font-family: var(--font-mono); margin-top: 2px; }
        .status-indicator { display: flex; align-items: center; gap: 6px; font-size: 11px; color: var(--text-secondary); font-family: var(--font-mono); }
        .status-dot { width: 7px; height: 7px; border-radius: 50%; background: var(--accent-green); animation: pulse 2s infinite; }
        @keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(.8)} }
        .page-body { padding: 32px; flex: 1; }

        /* ALERTS */
        .alert { padding: 14px 18px; border-radius: 8px; margin-bottom: 24px; font-size: 14px; display: flex; align-items: center; gap: 10px; }
        .alert-success { background: rgba(82,183,136,.12); border: 1px solid rgba(82,183,136,.3); color: var(--accent-green); }
        .alert-danger  { background: rgba(230,57,70,.12);  border: 1px solid var(--border-accent); color: var(--accent-red); }

        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: var(--bg-primary); }
        ::-webkit-scrollbar-thumb { background: var(--text-muted); border-radius: 3px; }
    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-brand">
        <span class="brand-tag">// OPERATION DIPONEGORO</span>
        <div class="brand-name">NEM<span>E</span>SIS</div>
        <div class="brand-sub">Sistem Pengawasan Anggaran & Pengadaan Publik</div>
    </div>

    <div class="sidebar-region">
        <span class="region-label">Wilayah Administratif</span>
        <span class="region-name">Kabupaten Bandung</span>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Navigasi Utama</div>

        <a href="<?= base_url('dashboard') ?>" class="nav-link <?= (uri_string()=='dashboard')?'active':'' ?>">
            <i class="fas fa-chart-line"></i> Dashboard
        </a>
        <a href="<?= base_url('anggaran') ?>" class="nav-link <?= (str_contains(uri_string(),'anggaran'))?'active':'' ?>">
            <i class="fas fa-coins"></i> Anggaran Prioritas
        </a>

        <?php if (session()->get('role') === 'super_admin'): ?>
        <div class="nav-section-label">Manajemen (Super Admin)</div>

        <a href="<?= base_url('pengadaan') ?>" class="nav-link <?= (str_contains(uri_string(),'pengadaan'))?'active':'' ?>">
            <i class="fas fa-file-contract"></i> Data Pengadaan
            <span class="nav-badge">SIRUP</span>
        </a>
        <a href="<?= base_url('anomali') ?>" class="nav-link <?= (str_contains(uri_string(),'anomali'))?'active':'' ?>">
            <i class="fas fa-triangle-exclamation"></i> Deteksi Anomali
        </a>
        <a href="<?= base_url('opd') ?>" class="nav-link <?= (str_contains(uri_string(),'opd'))?'active':'' ?>">
            <i class="fas fa-building-columns"></i> Data OPD
        </a>
        <a href="<?= base_url('users') ?>" class="nav-link <?= (str_contains(uri_string(),'users'))?'active':'' ?>">
            <i class="fas fa-users-gear"></i> Manajemen User
        </a>
        <a href="<?= base_url('laporan') ?>" class="nav-link <?= (str_contains(uri_string(),'laporan'))?'active':'' ?>">
            <i class="fas fa-file-chart-column"></i> Laporan & Ekspor
        </a>
        <?php endif; ?>

        <div class="nav-section-label">Akun</div>
        <a href="<?= base_url('profil') ?>" class="nav-link">
            <i class="fas fa-user-circle"></i> Profil Saya
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="user-card">
            <div class="user-avatar"><?= strtoupper(substr(session()->get('nama') ?? 'U', 0, 1)) ?></div>
            <div class="user-info">
                <div class="user-name"><?= esc(session()->get('nama') ?? 'User') ?></div>
                <div class="user-role"><?= esc(session()->get('role') ?? 'guest') ?></div>
            </div>
            <a href="<?= base_url('logout') ?>" class="logout-btn" title="Logout">
                <i class="fas fa-arrow-right-from-bracket"></i>
            </a>
        </div>
    </div>
</aside>

<main class="main-content">
    <div class="topbar">
        <div class="page-title-area">
            <h1><?= $title ?? 'Dashboard' ?></h1>
            <div class="breadcrumb">NEMESIS / <?= $title ?? 'Dashboard' ?></div>
        </div>
        <div class="status-indicator">
            <span class="status-dot"></span>
            <span>SISTEM AKTIF — <?= date('d M Y H:i') ?></span>
        </div>
    </div>

    <div class="page-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><i class="fas fa-circle-xmark"></i> <?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>
</main>

<?= $this->renderSection('scripts') ?>
</body>
</html>