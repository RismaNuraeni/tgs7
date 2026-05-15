<?= $this->extend('layouts/main') ?>
<?= $this->section('styles') ?>
<style>
    .form-wrap {
        max-width: 600px;
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
    }

    .form-header {
        padding: 24px 28px;
        border-bottom: 1px solid var(--border);
    }

    .form-header h2 {
        font-family: var(--font-heading);
        font-size: 18px;
        font-weight: 700;
    }

    .form-header p {
        font-size: 13px;
        color: var(--text-secondary);
        margin-top: 4px;
    }

    .form-body {
        padding: 28px;
        display: grid;
        gap: 20px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-label {
        font-family: var(--font-mono);
        font-size: 10px;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .form-input,
    .form-select {
        background: rgba(255, 255, 255, .04);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 11px 14px;
        color: var(--text-primary);
        font-size: 13px;
        font-family: var(--font-body);
        outline: none;
        transition: border-color .2s;
    }

    .form-input:focus,
    .form-select:focus {
        border-color: rgba(230, 57, 70, .4);
    }

    .form-input::placeholder {
        color: rgba(136, 146, 164, .4);
    }

    .help-text {
        font-size: 11px;
        color: var(--text-muted);
    }

    .form-actions {
        display: flex;
        gap: 10px;
        padding: 0 28px 28px;
    }

    .btn-save {
        background: var(--accent-red);
        color: white;
        border: none;
        padding: 11px 24px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        font-family: var(--font-heading);
        cursor: pointer;
        transition: background .2s;
    }

    .btn-save:hover {
        background: #c62a35;
    }

    .btn-back {
        background: rgba(255, 255, 255, .05);
        color: var(--text-secondary);
        border: 1px solid var(--border);
        padding: 11px 20px;
        border-radius: 8px;
        font-size: 13px;
        font-family: var(--font-body);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="form-wrap">
    <div class="form-header">
        <h2><?= $user ? 'Edit User' : 'Tambah User Baru' ?></h2>
        <p><?= $user ? 'Perbarui informasi pengguna sistem.' : 'Tambahkan pengguna baru ke sistem NEMESIS.' ?></p>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
        <div style="margin:16px 28px;padding:12px 16px;background:rgba(230,57,70,.1);border:1px solid rgba(230,57,70,.3);border-radius:8px;color:var(--accent-red);font-size:13px;">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <form action="<?= $user ? base_url('users/update/' . $user['id']) : base_url('users/store') ?>" method="POST">
        <?= csrf_field() ?>
        <div class="form-body">
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap *</label>
                    <input class="form-input" type="text" name="nama" placeholder="Nama lengkap..." required
                        value="<?= old('nama', $user['nama'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Username *</label>
                    <input class="form-input" type="text" name="username" placeholder="username..." required
                        <?= $user ? 'readonly style="opacity:.6"' : '' ?>
                        value="<?= old('username', $user['username'] ?? '') ?>">
                    <?php if ($user): ?><span class="help-text">Username tidak dapat diubah.</span><?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input class="form-input" type="email" name="email" placeholder="email@kabbandung.go.id"
                    value="<?= old('email', $user['email'] ?? '') ?>">
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Password <?= $user ? '(kosongkan jika tidak diubah)' : '*' ?></label>
                    <input class="form-input" type="password" name="password"
                        placeholder="••••••••" <?= !$user ? 'required' : '' ?>>
                </div>
                <div class="form-group">
                    <label class="form-label">Role *</label>
                    <select class="form-select" name="role" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="super_admin" <?= old('role', $user['role'] ?? '') === 'super_admin' ? 'selected' : '' ?>>⚡ Super Admin</option>
                        <option value="bupati" <?= old('role', $user['role'] ?? '') === 'bupati'     ? 'selected' : '' ?>>🏛 Bupati</option>
                    </select>
                </div>
            </div>

            <?php if ($user): ?>
                <div class="form-group">
                    <label class="form-label">Status Akun</label>
                    <select class="form-select" name="is_active">
                        <option value="1" <?= ($user['is_active'] ?? 1) ? 'selected' : '' ?>>✅ Aktif</option>
                        <option value="0" <?= !($user['is_active'] ?? 1) ? 'selected' : '' ?>>❌ Nonaktif</option>
                    </select>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save">
                <i class="fas fa-floppy-disk"></i> <?= $user ? 'Simpan Perubahan' : 'Tambah User' ?>
            </button>
            <a href="<?= base_url('users') ?>" class="btn-back">
                <i class="fas fa-arrow-left"></i> Batal
            </a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>