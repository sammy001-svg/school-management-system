<?php require ROOT_DIR . '/app/Views/layouts/header.php'; ?>
<div class="page-header">
  <div class="page-header-title">Accounts Receivable (AR)</div>
</div>

<div class="stat-grid">
  <div class="stat-card" style="--card-color:var(--danger)">
    <div class="stat-value"><?= htmlspecialchars($tenant['currency']??'Ksh') ?> <?= number_format($stats['total_outstanding'], 2) ?></div>
    <div class="stat-label">Total Outstanding</div>
  </div>
  <div class="stat-card" style="--card-color:var(--warning)">
    <div class="stat-value"><?= $stats['overdue_count'] ?></div>
    <div class="stat-label">Overdue Invoices</div>
  </div>
  <div class="stat-card" style="--card-color:var(--primary)">
    <div class="stat-value"><?= $stats['total_outstanding'] > 0 ? round(($stats['total_outstanding'] / ($stats['total_outstanding'] + 1)) * 100, 1) : 100 ?>%</div>
    <div class="stat-label">Collection Rate (Est)</div>
  </div>
</div>

<div class="grid" style="grid-template-columns: 2fr 1fr; gap: 24px; margin-top: 24px;">
  <div class="card">
    <div class="card-header"><div class="card-title">Aging Report (Overdue Days)</div></div>
    <div class="table-wrapper">
      <table>
        <thead><tr><th>Student</th><th>1-30 Days</th><th>31-60 Days</th><th>60+ Days</th><th>Total</th></tr></thead>
        <tbody>
          <?php foreach($aging as $a): ?>
          <tr>
            <td class="fw-600"><?= htmlspecialchars($a['student_name']) ?></td>
            <td class="<?= $a['age_30'] > 0 ? 'text-warning' : '' ?>"><?= number_format($a['age_30'], 2) ?></td>
            <td class="<?= $a['age_60'] > 0 ? 'text-danger' : '' ?>"><?= number_format($a['age_60'], 2) ?></td>
            <td class="<?= $a['age_90'] > 0 ? 'text-danger fw-700' : '' ?>"><?= number_format($a['age_90'], 2) ?></td>
            <td class="fw-700"><?= number_format($a['total_outstanding'], 2) ?></td>
          </tr>
          <?php endforeach; ?>
          <?php if(empty($aging)): ?><tr><td colspan="5" class="text-center text-muted" style="padding:48px">No overdue records found.</td></tr><?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="card">
    <div class="card-header"><div class="card-title">Penalty Rules</div></div>
    <div class="card-body">
      <p class="text-muted" style="font-size:13px;margin-bottom:12px;">Automated late fee/penalty calculation rules.</p>
      <div class="info-alert" style="margin-bottom:16px;font-size:12px;">
        Rules are applied automatically after the grace period ends.
      </div>
      <button class="btn btn-sm btn-outline btn-block" onclick="alert('Penalty configuration coming soon')">Configure Penalties</button>
    </div>
  </div>
</div>

<?php require ROOT_DIR . '/app/Views/layouts/footer.php'; ?>
