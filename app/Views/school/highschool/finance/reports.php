<?php require ROOT_DIR . '/app/Views/layouts/header.php'; ?>
<div class="page-header">
  <div class="page-header-title">Financial Reporting</div>
</div>

<div class="grid" style="grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px;">
  <div class="card report-card">
    <div class="card-body">
      <div class="fw-700" style="font-size:16px;">Income Statement (P&L)</div>
      <p class="text-muted" style="font-size:13px;margin:8px 0 16px;">Summary of revenues and expenses incurred over a period.</p>
      <a href="#" class="btn btn-sm btn-primary">Generate P&L</a>
    </div>
  </div>
  <div class="card report-card">
    <div class="card-body">
      <div class="fw-700" style="font-size:16px;">Balance Sheet</div>
      <p class="text-muted" style="font-size:13px;margin:8px 0 16px;">Assets, liabilities, and equity of the institution at a point in time.</p>
      <a href="#" class="btn btn-sm btn-primary">View Balance Sheet</a>
    </div>
  </div>
  <div class="card report-card">
    <div class="card-body">
      <div class="fw-700" style="font-size:16px;">Cash Flow Statement</div>
      <p class="text-muted" style="font-size:13px;margin:8px 0 16px;">Movement of cash in and out of the school accounts.</p>
      <a href="#" class="btn btn-sm btn-primary">Generate Statement</a>
    </div>
  </div>
  <div class="card report-card">
    <div class="card-body">
      <div class="fw-700" style="font-size:16px;">Fee Collection Report</div>
      <p class="text-muted" style="font-size:13px;margin:8px 0 16px;">Detailed breakdown of fee payments by class, term, or category.</p>
      <a href="#" class="btn btn-sm btn-primary">Detailed Report</a>
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
