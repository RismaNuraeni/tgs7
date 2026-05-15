<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — NEMESIS | Kabupaten Bandung</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@400;500&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #090d1a; --panel: #0e1526;
            --red: #e63946; --amber: #f4a261; --blue: #4cc9f0; --green: #52b788;
            --text: #e8eaf6; --muted: #8892a4; --border: rgba(255,255,255,0.07);
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; display: flex; }

        /* LEFT */
        .left-panel { flex: 1; background: linear-gradient(160deg,#0a0e1a 0%,#0f1628 50%,#1a0a0e 100%); display: flex; flex-direction: column; justify-content: center; padding: 60px; position: relative; overflow: hidden; }
        .left-panel::before { content:''; position:absolute; top:-100px; right:-100px; width:500px; height:500px; background:radial-gradient(circle,rgba(230,57,70,.08) 0%,transparent 70%); pointer-events:none; }
        .op-tag { font-family:'DM Mono',monospace; font-size:11px; color:var(--red); letter-spacing:3px; text-transform:uppercase; margin-bottom:16px; }
        .brand-logo { font-family:'Syne',sans-serif; font-size:72px; font-weight:800; line-height:1; letter-spacing:-3px; margin-bottom:8px; }
        .brand-logo .hl { color:var(--red); }
        .brand-logo .dm { color:rgba(232,234,246,.2); }
        .brand-tagline { font-size:15px; color:var(--muted); font-weight:300; max-width:360px; line-height:1.6; margin-bottom:48px; }
        .stat-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; max-width:340px; }
        .stat-item { background:rgba(255,255,255,.03); border:1px solid var(--border); border-radius:10px; padding:16px; }
        .stat-value { font-family:'DM Mono',monospace; font-size:20px; font-weight:500; margin-bottom:4px; }
        .stat-value.red{color:var(--red)} .stat-value.amber{color:var(--amber)} .stat-value.blue{color:var(--blue)} .stat-value.green{color:var(--green)}
        .stat-label { font-size:11px; color:var(--muted); text-transform:uppercase; letter-spacing:1px; font-family:'DM Mono',monospace; }
        .region-badge { margin-top:48px; display:inline-flex; align-items:center; gap:10px; background:rgba(230,57,70,.08); border:1px solid rgba(230,57,70,.2); padding:10px 16px; border-radius:8px; font-size:13px; }
        .region-badge i { color:var(--red); }

        /* RIGHT */
        .right-panel { width:440px; background:var(--panel); border-left:1px solid var(--border); display:flex; flex-direction:column; justify-content:center; padding:60px 48px; }
        .form-header { margin-bottom:40px; }
        .form-header h2 { font-family:'Syne',sans-serif; font-size:28px; font-weight:700; margin-bottom:6px; }
        .form-header p { font-size:13px; color:var(--muted); }
        .form-group { margin-bottom:20px; }
        .form-label { display:block; font-size:11px; font-family:'DM Mono',monospace; color:var(--muted); text-transform:uppercase; letter-spacing:1.5px; margin-bottom:8px; }
        .form-input { width:100%; background:rgba(255,255,255,.04); border:1px solid var(--border); border-radius:8px; padding:12px 16px; color:var(--text); font-size:14px; font-family:'DM Sans',sans-serif; outline:none; transition:border-color .2s; }
        .form-input:focus { border-color:rgba(230,57,70,.5); background:rgba(230,57,70,.04); }
        .form-input::placeholder { color:rgba(136,146,164,.5); }
        .btn-login { width:100%; background:var(--red); color:white; border:none; padding:14px; border-radius:8px; font-size:14px; font-weight:600; font-family:'Syne',sans-serif; cursor:pointer; transition:all .2s; margin-top:8px; }
        .btn-login:hover { background:#c62a35; transform:translateY(-1px); box-shadow:0 8px 20px rgba(230,57,70,.3); }
        .alert-error { background:rgba(230,57,70,.1); border:1px solid rgba(230,57,70,.3); color:#ff8a8a; padding:12px 16px; border-radius:8px; font-size:13px; margin-bottom:20px; display:flex; align-items:center; gap:8px; }
        .demo-accounts { margin-top:32px; padding-top:24px; border-top:1px solid var(--border); }
        .demo-label { font-size:10px; font-family:'DM Mono',monospace; color:var(--muted); letter-spacing:2px; text-transform:uppercase; margin-bottom:12px; }
        .demo-item { display:flex; justify-content:space-between; align-items:center; padding:8px 12px; background:rgba(255,255,255,.03); border-radius:6px; margin-bottom:6px; font-size:12px; cursor:pointer; border:1px solid transparent; transition:border-color .2s; }
        .demo-item:hover { border-color:var(--border); }
        .demo-role { color:var(--amber); font-family:'DM Mono',monospace; font-size:10px; }
        .demo-creds { color:var(--muted); font-family:'DM Mono',monospace; font-size:11px; }

        @media(max-width:768px){ .left-panel{display:none} .right-panel{width:100%} }
    </style>
</head>
<body>

<div class="left-panel">
    <div class="op-tag">// OPERATION DIPONEGORO</div>
    <div class="brand-logo">NEM<span class="hl">E</span><span class="dm">SIS</span></div>
    <p class="brand-tagline">Sistem Pengawasan Anggaran & Investigasi Pengadaan Publik — Kabupaten Bandung</p>
    <div class="stat-grid">
        <div class="stat-item"><div class="stat-value red">4.4 GB</div><div class="stat-label">Dataset SIRUP</div></div>
        <div class="stat-item"><div class="stat-value amber">2,847</div><div class="stat-label">Paket Teranalisis</div></div>
        <div class="stat-item"><div class="stat-value blue">143</div><div class="stat-label">Anomali Terdeteksi</div></div>
        <div class="stat-item"><div class="stat-value green">38</div><div class="stat-label">OPD Terpantau</div></div>
    </div>
    <div class="region-badge">
        <i class="fas fa-map-pin"></i>
        <span>Pemerintah Kabupaten Bandung — Jawa Barat</span>
    </div>
</div>

<div class="right-panel">
    <div class="form-header">
        <h2>Masuk ke Sistem</h2>
        <p>Akses terbatas — personel terotorisasi saja</p>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert-error">
            <i class="fas fa-circle-xmark"></i> <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('login') ?>" method="POST">
        <?= csrf_field() ?>
        <div class="form-group">
            <label class="form-label" for="username">Username</label>
            <input class="form-input" type="text" id="username" name="username"
                   placeholder="masukkan username..." required value="<?= old('username') ?>">
        </div>
        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input class="form-input" type="password" id="password" name="password"
                   placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn-login">MASUK</button>
    </form>

    <div class="demo-accounts">
        <div class="demo-label">// Akun Demo</div>
        <div class="demo-item" onclick="fillCreds('superadmin','Admin@123')">
            <span><span class="demo-role">SUPER ADMIN</span> — Akses Penuh</span>
            <span class="demo-creds">superadmin / Admin@123</span>
        </div>
        <div class="demo-item" onclick="fillCreds('bupati','Bupati@123')">
            <span><span class="demo-role">BUPATI</span> — Monitor Anggaran</span>
            <span class="demo-creds">bupati / Bupati@123</span>
        </div>
    </div>
</div>

<script>
function fillCreds(u, p) {
    document.getElementById('username').value = u;
    document.getElementById('password').value = p;
}
</script>
</body>
</html>