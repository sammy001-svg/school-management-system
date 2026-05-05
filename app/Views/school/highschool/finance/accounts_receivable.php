<?php require ROOT_DIR . '/app/Views/layouts/header.php'; ?>
<div class="page-header">
  <div>
    <div class="page-header-title">Accounts Receivable (AR)</div>
    <div class="page-header-sub">Track and manage outstanding student fee balances and overdue accounts.</div>
  </div>
</div>

<div class="stat-grid">
  <div class="stat-card" style="--card-color:var(--danger)">
    <div class="stat-icon">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" /></svg>
    </div>
    <div class="stat-value"><?= htmlspecialchars($tenant['currency']??'Ksh') ?> <?= number_format($stats['total_outstanding'], 2) ?></div>
    <div class="stat-label">Total Outstanding</div>
  </div>
  <div class="stat-card" style="--card-color:var(--warning)">
    <div class="stat-icon">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
    </div>
    <div class="stat-value"><?= $stats['overdue_count'] ?></div>
    <div class="stat-label">Overdue Invoices</div>
  </div>
  <div class="stat-card" style="--card-color:var(--primary)">
    <div class="stat-icon">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" /></svg>
    </div>
    <div class="stat-value"><?= $stats['total_outstanding'] > 0 ? round(($stats['total_outstanding'] / ($stats['total_outstanding'] + 100000)) * 100, 1) : 100 ?>%</div>
    <div class="stat-label">Collection Rate</div>
  </div>
</div>

<div class="grid" style="grid-template-columns: 2fr 1fr; gap: 24px; margin-top: 24px;">
  <div class="card">
    <div class="card-header">
      <div class="card-title">Aging Report (Overdue Days)</div>
      <button class="btn btn-sm btn-outline">Export AR Data</button>
    </div>
    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>Student Name</th>
            <th class="text-right">1-30 Days</th>
            <th class="text-right">31-60 Days</th>
            <th class="text-right">60+ Days</th>
            <th class="text-right">Total Owed</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($aging as $a): ?>
          <tr>
            <td class="fw-700" style="color:var(--text);"><?= htmlspecialchars($a['student_name']) ?></td>
            <td class="text-right <?= $a['age_30'] > 0 ? 'text-warning fw-600' : 'text-muted' ?>"><?= number_format($a['age_30'], 2) ?></td>
            <td class="text-right <?= $a['age_60'] > 0 ? 'text-danger fw-600' : 'text-muted' ?>"><?= number_format($a['age_60'], 2) ?></td>
            <td class="text-right <?= $a['age_90'] > 0 ? 'text-danger fw-800' : 'text-muted' ?>"><?= number_format($a['age_90'], 2) ?></td>
            <td class="text-right fw-800" style="color:var(--text);"><?= number_format($a['total_outstanding'], 2) ?></td>
          </tr>
          <?php endforeach; ?>
          <?php if(empty($aging)): ?>
          <tr><td colspan="5" class="text-center text-muted" style="padding:60px">All student accounts are currently up to date.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="card">
    <div class="card-header"><div class="card-title">Penalty & Compliance</div></div>
    <div class="card-body">
      <div class="info-alert" style="margin-bottom:20px; font-size:13px; line-height:1.6;">
        <strong>Penalty Automation:</strong> Late fees are calculated based on the global institution policy. Current grace period: 7 days.
      </div>
      <div style="display:flex; flex-direction:column; gap:12px;">
        <button class="btn btn-primary btn-sm btn-block">Configure Penalty Rules</button>
        <button class="btn btn-secondary btn-sm btn-block">Send Bulk Overdue Alerts</button>
      </div>
      
      <div style="margin-top:24px; padding-top:20px; border-top:1px solid var(--border);">
        <div class="fw-600" style="font-size:12px; color:var(--text-muted); text-transform:uppercase; margin-bottom:12px;">Next Scheduled Reminders</div>
        <div class="text-muted" style="font-size:12px; display:flex; justify-content:space-between;">
          <span>May 10, 2026</span>
          <span class="badge badge-info">342 Students</span>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require ROOT_DIR . '/app/Views/layouts/footer.php'; ?>
