<?php require ROOT_DIR . '/app/Views/layouts/header.php'; ?>
<div class="page-header">
  <div class="page-header-title">Budgeting & Financial Planning</div>
  <button class="btn btn-primary">+ New Budget Plan</button>
</div>

<div class="card">
  <div class="card-header"><div class="card-title">Active Budgets (<?= date('Y') ?>)</div></div>
  <div class="table-wrapper">
    <table>
      <thead><tr><th>Budget Name</th><th>Academic Year</th><th>Total Allocated</th><th>Actual Spend</th><th>Variance</th><th>Status</th></tr></thead>
      <tbody>
        <tr><td colspan="6" class="text-center text-muted" style="padding:64px">No budgets created yet. Start planning your academic year financial goals.</td></tr>
      </tbody>
    </table>
  </div>
</div>

<div class="grid" style="grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 24px;">
  <div class="card">
    <div class="card-header"><div class="card-title">Department Allocations</div></div>
    <div class="card-body">
      <div style="height:200px;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,0.05);border-radius:var(--radius-sm);">
        <span class="text-muted">Allocation chart will appear here.</span>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header"><div class="card-title">Financial Forecasting</div></div>
    <div class="card-body">
      <p class="text-muted">Projected collection vs expected expenses based on enrollment data.</p>
      <button class="btn btn-sm btn-secondary" style="margin-top:12px;">Run Forecast Model</button>
    </div>
  </div>
</div>

<?php require ROOT_DIR . '/app/Views/layouts/footer.php'; ?>
