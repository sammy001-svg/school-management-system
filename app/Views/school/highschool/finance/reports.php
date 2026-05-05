<?php require ROOT_DIR . '/app/Views/layouts/header.php'; ?>
<div class="page-header">
  <div>
    <div class="page-header-title">Financial Reporting</div>
    <div class="page-header-sub">Comprehensive overview of school revenue, expenses, and fiscal health.</div>
  </div>
</div>

<div class="stat-grid">
  <div class="stat-card" style="--card-color:var(--success)">
    <div class="stat-icon">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" /></svg>
    </div>
    <div class="stat-value"><?= htmlspecialchars($tenant['currency']??'Ksh') ?> <?= number_format($stats['total_income'], 2) ?></div>
    <div class="stat-label">Total Revenue</div>
  </div>
  <div class="stat-card" style="--card-color:var(--danger)">
    <div class="stat-icon">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
    </div>
    <div class="stat-value"><?= htmlspecialchars($tenant['currency']??'Ksh') ?> <?= number_format($stats['total_expense'], 2) ?></div>
    <div class="stat-label">Total Expenses</div>
  </div>
  <div class="stat-card" style="--card-color:var(--primary)">
    <div class="stat-icon">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" /><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" /></svg>
    </div>
    <div class="stat-value"><?= htmlspecialchars($tenant['currency']??'Ksh') ?> <?= number_format($stats['net_profit'], 2) ?></div>
    <div class="stat-label">Net Surplus</div>
  </div>
</div>

<div class="grid" style="grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">
  <div class="card report-card">
    <div class="card-body">
      <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
        <div style="width:40px;height:40px;border-radius:10px;background:rgba(16,185,129,0.1);display:flex;align-items:center;justify-content:center;color:var(--primary);">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:20px;"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" /></svg>
        </div>
        <div class="fw-700" style="font-size:16px;">Income Statement (P&L)</div>
      </div>
      <p class="text-muted" style="font-size:13px;margin-bottom:20px;min-height:40px;">Detailed summary of revenues and expenses incurred over the selected academic period.</p>
      <button class="btn btn-sm btn-primary btn-block">Generate P&L Report</button>
    </div>
  </div>

  <div class="card report-card">
    <div class="card-body">
      <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
        <div style="width:40px;height:40px;border-radius:10px;background:rgba(59,130,246,0.1);display:flex;align-items:center;justify-content:center;color:var(--info);">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:20px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" /></svg>
        </div>
        <div class="fw-700" style="font-size:16px;">Balance Sheet</div>
      </div>
      <p class="text-muted" style="font-size:13px;margin-bottom:20px;min-height:40px;">Consolidated view of school assets, liabilities, and equity at this point in time.</p>
      <button class="btn btn-sm btn-primary btn-block">View Balance Sheet</button>
    </div>
  </div>

  <div class="card report-card">
    <div class="card-body">
      <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
        <div style="width:40px;height:40px;border-radius:10px;background:rgba(245,158,11,0.1);display:flex;align-items:center;justify-content:center;color:var(--warning);">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:20px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" /></svg>
        </div>
        <div class="fw-700" style="font-size:16px;">Cash Flow Statement</div>
      </div>
      <p class="text-muted" style="font-size:13px;margin-bottom:20px;min-height:40px;">Track the movement of liquid cash within the institution's designated bank accounts.</p>
      <button class="btn btn-sm btn-primary btn-block">Generate Statement</button>
    </div>
  </div>

  <div class="card report-card">
    <div class="card-body">
      <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
        <div style="width:40px;height:40px;border-radius:10px;background:rgba(16,185,129,0.1);display:flex;align-items:center;justify-content:center;color:var(--primary);">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:20px;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        </div>
        <div class="fw-700" style="font-size:16px;">Fee Collection Report</div>
      </div>
      <p class="text-muted" style="font-size:13px;margin-bottom:20px;min-height:40px;">Breakdown of fee payments categorized by class, term, and payment method.</p>
      <button class="btn btn-sm btn-primary btn-block">Detailed Report</button>
    </div>
  </div>
</div>

<div class="card mt-24">
  <div class="card-header">
    <div class="card-title">Custom Report Builder</div>
  </div>
  <div class="card-body">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:40px;">
      <div style="flex:1;">
        <p class="text-muted" style="font-size:14px;line-height:1.8;">Need a specific data extract? Use our custom report builder to select specific data fields, date ranges, and output formats (PDF/Excel) for your administrative needs.</p>
      </div>
      <button class="btn btn-secondary" style="white-space:nowrap;">Launch Report Builder</button>
    </div>
  </div>
</div>

<?php require ROOT_DIR . '/app/Views/layouts/footer.php'; ?>
