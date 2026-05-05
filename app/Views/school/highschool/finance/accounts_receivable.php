<?php require ROOT_DIR . '/app/Views/layouts/header.php'; ?>
<div class="page-header">
  <div class="page-header-title">Accounts Receivable (AR)</div>
</div>

<div class="stat-grid">
  <div class="stat-card" style="--card-color:var(--danger)">
    <div class="stat-value"><?= htmlspecialchars($tenant['currency']??'Ksh') ?> 0</div>
    <div class="stat-label">Total Outstanding</div>
  </div>
  <div class="stat-card" style="--card-color:var(--warning)">
    <div class="stat-value">0</div>
    <div class="stat-label">Overdue Invoices</div>
  </div>
  <div class="stat-card" style="--card-color:var(--primary)">
    <div class="stat-value">0%</div>
    <div class="stat-label">Collection Rate</div>
  </div>
</div>

<div class="grid" style="grid-template-columns: 2fr 1fr; gap: 24px; margin-top: 24px;">
  <div class="card">
    <div class="card-header"><div class="card-title">Aging Report (Overdue Days)</div></div>
    <div class="table-wrapper">
      <table>
        <thead><tr><th>Student</th><th>30 Days</th><th>60 Days</th><th>90+ Days</th><th>Total</th></tr></thead>
        <tbody>
          <tr><td colspan="5" class="text-center text-muted" style="padding:48px">No overdue records found.</td></tr>
        </tbody>
      </table>
    </div>
  </div>

  <div class="card">
    <div class="card-header"><div class="card-title">Penalty Rules</div></div>
    <div class="card-body">
      <p class="text-muted" style="font-size:13px;margin-bottom:12px;">Automated late fee/penalty calculation rules.</p>
      <button class="btn btn-sm btn-outline btn-block">Configure Penalties</button>
    </div>
  </div>
</div>

<?php require ROOT_DIR . '/app/Views/layouts/footer.php'; ?>
