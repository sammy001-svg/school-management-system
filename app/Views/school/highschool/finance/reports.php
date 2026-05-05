<?php require ROOT_DIR . '/app/Views/layouts/header.php'; ?>
<div class="page-header">
  <div class="page-header-title">Financial Reporting</div>
</div>

<div class="stat-grid">
  <div class="stat-card" style="--card-color:var(--success)">
    <div class="stat-value"><?= htmlspecialchars($tenant['currency']??'Ksh') ?> <?= number_format($stats['total_income'], 2) ?></div>
    <div class="stat-label">Total Revenue (Payments)</div>
  </div>
  <div class="stat-card" style="--card-color:var(--danger)">
    <div class="stat-value"><?= htmlspecialchars($tenant['currency']??'Ksh') ?> <?= number_format($stats['total_expense'], 2) ?></div>
    <div class="stat-label">Total Expenses (Payroll)</div>
  </div>
  <div class="stat-card" style="--card-color:var(--primary)">
    <div class="stat-value"><?= htmlspecialchars($tenant['currency']??'Ksh') ?> <?= number_format($stats['net_profit'], 2) ?></div>
    <div class="stat-label">Net Surplus/Deficit</div>
  </div>
</div>

<div class="grid" style="grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px; margin-top: 24px;">
  <div class="card report-card">
    <div class="card-body">
      <div class="fw-700" style="font-size:16px;">Income Statement (P&L)</div>
      <p class="text-muted" style="font-size:13px;margin:8px 0 16px;">Summary of revenues and expenses incurred over a period.</p>
      <button class="btn btn-sm btn-primary" onclick="alert('Generating P&L Report...')">Generate P&L</button>
    </div>
  </div>
  <div class="card report-card">
    <div class="card-body">
      <div class="fw-700" style="font-size:16px;">Balance Sheet</div>
      <p class="text-muted" style="font-size:13px;margin:8px 0 16px;">Assets, liabilities, and equity of the institution at a point in time.</p>
      <button class="btn btn-sm btn-primary" onclick="alert('Opening Balance Sheet...')">View Balance Sheet</button>
    </div>
  </div>
  <div class="card report-card">
    <div class="card-body">
      <div class="fw-700" style="font-size:16px;">Cash Flow Statement</div>
      <p class="text-muted" style="font-size:13px;margin:8px 0 16px;">Movement of cash in and out of the school accounts.</p>
      <button class="btn btn-sm btn-primary" onclick="alert('Generating Cash Flow...')">Generate Statement</button>
    </div>
  </div>
  <div class="card report-card">
    <div class="card-body">
      <div class="fw-700" style="font-size:16px;">Fee Collection Report</div>
      <p class="text-muted" style="font-size:13px;margin:8px 0 16px;">Detailed breakdown of fee payments by class, term, or category.</p>
      <button class="btn btn-sm btn-primary" onclick="alert('Opening Collection Report...')">Detailed Report</button>
    </div>
  </div>
</div>

<div class="card mt-24">
  <div class="card-header"><div class="card-title">Custom Report Builder</div></div>
  <div class="card-body">
    <p class="text-muted">Select fields and filters to build your own custom financial export.</p>
    <button class="btn btn-secondary btn-sm" style="margin-top:12px;">Launch Builder</button>
  </div>
</div>

<?php require ROOT_DIR . '/app/Views/layouts/footer.php'; ?>
