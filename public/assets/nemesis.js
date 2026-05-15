/* nemesis.js — Utility & UI dari app.js asli nemesis
 * Diadaptasi untuk CI4 (tanpa MapLibre / API fetch)
 */
(() => {

  /* ── FORMAT HELPERS — langsung dari app.js nemesis ── */
  function escapeHtml(value) {
    return String(value)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#39;');
  }

  function formatCompactCurrency(value) {
    const amount = Number(value) || 0;
    const abs = Math.abs(amount);
    if (abs >= 1e12) return `${(amount / 1e12).toFixed(amount % 1e12 === 0 ? 0 : 1)} T`;
    if (abs >= 1e9)  return `${(amount / 1e9).toFixed(amount % 1e9 === 0 ? 0 : 1)} B`;
    if (abs >= 1e6)  return `${(amount / 1e6).toFixed(amount % 1e6 === 0 ? 0 : 1)} M`;
    if (abs >= 1e3)  return `${(amount / 1e3).toFixed(amount % 1e3 === 0 ? 0 : 1)} K`;
    return `${amount.toFixed(0)}`;
  }

  function formatCurrencyLong(value) {
    const number = Math.round(Number(value) || 0);
    return `Rp ${number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')}`;
  }

  function formatNumber(value) {
    const number = Math.round(Number(value) || 0);
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
  }

  function severityColor(severity) {
    if (severity === 'absurd') return 'var(--rose)';
    if (severity === 'high')   return 'var(--brick)';
    if (severity === 'med')    return 'var(--olive)';
    return 'var(--steel)';
  }

  function severityLabel(severity) {
    if (severity === 'absurd') return 'Absurd';
    if (severity === 'high')   return 'High';
    if (severity === 'med')    return 'Medium';
    return 'Low';
  }

  /* Ekspor ke window supaya bisa dipakai di view mana saja */
  window.NemesisUtil = {
    escapeHtml,
    formatCompactCurrency,
    formatCurrencyLong,
    formatNumber,
    severityColor,
    severityLabel,
  };

  /* ── TOGGLE USER AKTIF/NONAKTIF ── */
  window.toggleUser = async function(id, cb) {
    try {
      const res = await fetch(`/users/toggle/${id}`, {
        method: 'POST',
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      });
      if (!res.ok) throw new Error('Gagal');
      const label = cb.closest('.toggle-wrap')?.querySelector('.toggle-label');
      if (label) label.textContent = cb.checked ? 'Aktif' : 'Nonaktif';
    } catch {
      cb.checked = !cb.checked;
    }
  };

  /* ── DELETE USER ── */
  window.deleteUser = function(id, nama) {
    if (!confirm(`Hapus user "${escapeHtml(nama)}"?\nTindakan ini tidak dapat dibatalkan.`)) return;
    fetch(`/users/delete/${id}`, {
      method: 'DELETE',
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    }).then(res => {
      if (res.ok) location.reload();
      else alert('Gagal menghapus user.');
    });
  };

  /* ── FILTER CHIPS — mirip .fc.a dari nemesis asli ── */
  document.querySelectorAll('.fc[data-filter]').forEach(btn => {
    btn.addEventListener('click', () => {
      const group = btn.dataset.group;
      document.querySelectorAll(`.fc[data-group="${group}"]`).forEach(b => b.classList.remove('a'));
      btn.classList.add('a');
    });
  });

  /* ── SEARCH SIDEBAR (debounce dari app.js nemesis) ── */
  let searchTimeout = null;
  const searchInput = document.getElementById('sidebarSearch');
  if (searchInput) {
    searchInput.addEventListener('input', () => {
      clearTimeout(searchTimeout);
      searchTimeout = setTimeout(() => {
        const q = searchInput.value.toLowerCase().trim();
        document.querySelectorAll('[data-searchable]').forEach(row => {
          const text = row.dataset.searchable.toLowerCase();
          row.style.display = text.includes(q) ? '' : 'none';
        });
      }, 300);
    });
  }

  /* ── MODAL CLOSE (Escape key) — dari app.js nemesis ── */
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
      document.querySelectorAll('.modal-overlay.open').forEach(m => {
        m.classList.remove('open');
        document.body.style.overflow = '';
      });
    }
  });

  document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', e => {
      if (e.target === overlay) {
        overlay.classList.remove('open');
        document.body.style.overflow = '';
      }
    });
  });

  /* ── TOGGLE MAP VISIBILITY (dari app.js nemesis toggleMap) ── */
  const toggleMapBtn = document.getElementById('toggleMapBtn');
  if (toggleMapBtn) {
    toggleMapBtn.addEventListener('click', () => {
      const mc = document.querySelector('.mc');
      if (!mc) return;
      const hidden = mc.style.display === 'none';
      mc.style.display = hidden ? '' : 'none';
      toggleMapBtn.textContent = hidden ? '🗺 Sembunyikan Peta' : '🗺 Tampilkan Peta';
      toggleMapBtn.classList.toggle('a', !hidden);
      if (hidden) setTimeout(() => window.dispatchEvent(new Event('resize')), 50);
    });
  }

  /* ── LIVE TIMESTAMP ── */
  const tsEl = document.getElementById('live-ts');
  if (tsEl) {
    const pad = n => String(n).padStart(2, '0');
    setInterval(() => {
      const now = new Date();
      tsEl.textContent = `${pad(now.getDate())} ${now.toLocaleString('id-ID',{month:'short'})} ${now.getFullYear()} ${pad(now.getHours())}:${pad(now.getMinutes())}`;
    }, 1000);
  }

  /* ── PROGRESS BAR ANIMATE ON LOAD ── */
  document.querySelectorAll('.ppbf[data-pct]').forEach(bar => {
    const pct = Math.min(100, Math.max(0, Number(bar.dataset.pct) || 0));
    bar.style.width = '0%';
    setTimeout(() => {
      bar.style.transition = 'width 0.8s ease';
      bar.style.width = `${pct}%`;
    }, 100);
  });

})();