<?= $this->extend('layouts/main') ?>
<?= $this->section('styles') ?>
<style>
    .page-actions {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 24px;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--accent-red);
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: background .2s;
        font-family: var(--font-heading);
    }

    .btn-add:hover {
        background: #c62a35;
    }

    .table-wrap {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .data-table th {
        padding: 14px 20px;
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
        vertical-align: middle;
        color: var(--text-secondary);
    }

    .data-table tr:last-child td {
        border-bottom: none;
    }

    .data-table tr:hover td {
        background: rgba(255, 255, 255, .02);
    }

    .user-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-av {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent-red), #ff6b9d);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
        color: white;
        flex-shrink: 0;
    }

    .user-av.blue {
        background: linear-gradient(135deg, var(--accent-blue), #7e57c2);
    }

    .user-name-val {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-primary);
    }

    .user-email {
        font-size: 11px;
        color: var(--text-muted);
        font-family: var(--font-mono);
    }

    .role-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        border-radius: 5px;
        font-size: 10px;
        font-family: var(--font-mono);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .role-super_admin {
        background: rgba(230, 57, 70, .1);
        color: var(--accent-red);
    }

    .role-bupati {
        background: rgba(244, 162, 97, .1);
        color: var(--accent-amber);
    }

    .toggle-wrap {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .toggle-switch {
        position: relative;
        width: 36px;
        height: 20px;
        cursor: pointer;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, .1);
        border-radius: 20px;
        transition: .3s;
    }

    .slider:before {
        content: '';
        position: absolute;
        height: 14px;
        width: 14px;
        left: 3px;
        bottom: 3px;
        background: white;
        border-radius: 50%;
        transition: .3s;
    }

    input:checked+.slider {
        background: var(--accent-green);
    }

    input:checked+.slider:before {
        transform: translateX(16px);
    }

    .action-btns {
        display: flex;
        gap: 6px;
    }

    .btn-edit,
    .btn-del {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 11px;
        font-family: var(--font-mono);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all .2s;
    }

    .btn-edit {
        background: rgba(76, 201, 240, .1);
        color: var(--accent-blue);
        border: 1px solid rgba(76, 201, 240, .2);
    }

    .btn-del {
        background: rgba(230, 57, 70, .1);
        color: var(--accent-red);
        border: 1px solid rgba(230, 57, 70, .2);
        cursor: pointer;
        border-width: 1px;
        border-style: solid;
    }

    .btn-edit:hover,
    .btn-del:hover {
        filter: brightness(1.2);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-actions">
    <a href="<?= base_url('users/create') ?>" class="btn-add">
        <i class="fas fa-user-plus"></i> Tambah User
    </a>
</div>

<div class="table-wrap">
    <table class="data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Pengguna</th>
                <th>Username</th>
                <th>Role</th>
                <th>Status</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $i => $user): ?>
                <tr>
                    <td style="font-family:var(--font-mono);color:var(--text-muted);"><?= $i + 1 ?></td>
                    <td>
                        <div class="user-cell">
                            <div class="user-av <?= $user['role'] === 'bupati' ? 'blue' : '' ?>">
                                <?= strtoupper(substr($user['nama'], 0, 1)) ?>
                            </div>
                            <div>
                                <div class="user-name-val"><?= esc($user['nama']) ?></div>
                                <div class="user-email"><?= esc($user['email'] ?? '-') ?></div>
                            </div>
                        </div>
                    </td>
                    <td style="font-family:var(--font-mono);font-size:12px;color:var(--accent-blue);"><?= esc($user['username']) ?></td>
                    <td>
                        <div class="toggle-wrap">
                            <label class="toggle-switch">
                                <input type="checkbox" <?= $user['is_active'] ? 'checked' : '' ?>
                                    onchange="toggleUser(<?= $user['id'] ?>, this)">
                                <span class="slider"></span>
                            </label>
                            <span class="toggle-label" style="font-family:'JetBrains Mono',monospace;font-size:10px;
          color:<?= $user['is_active'] ? 'var(--sage)' : 'var(--t3)' ?>;">
                                <?= $user['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="toggle-wrap">
                            <label class="toggle-switch">
                                <input type="checkbox" <?= $user['is_active'] ? 'checked' : '' ?> onchange="toggleUser(<?= $user['id'] ?>,this)">
                                <span class="slider"></span>
                            </label>
                            <span style="font-family:var(--font-mono);font-size:11px;color:<?= $user['is_active'] ? 'var(--accent-green)' : 'var(--text-muted)' ?>">
                                <?= $user['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                            </span>
                        </div>
                    </td>
                    <td style="font-family:var(--font-mono);font-size:11px;"><?= date('d M Y', strtotime($user['created_at'])) ?></td>
                    <td>
                        <div class="action-btns">
                            <a href="<?= base_url('users/edit/' . $user['id']) ?>" class="btn-edit"><i class="fas fa-pen-to-square"></i> Edit</a>
                            <?php if (session()->get('user_id') != $user['id']): ?>
                                <button class="btn-del" onclick="deleteUser(<?= $user['id'] ?>,'<?= esc($user['nama']) ?>')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    async function toggleUser(id, cb) {
        const res = await fetch(`<?= base_url('users/toggle') ?>/${id}`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        });
        if (!res.ok) cb.checked = !cb.checked;
    }

    function deleteUser(id, nama) {
        if (!confirm(`Hapus user "${nama}"?`)) return;
        fetch(`<?= base_url('users/delete') ?>/${id}`, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        }).then(() => location.reload());
    }
</script>
<?= $this->endSection() ?>