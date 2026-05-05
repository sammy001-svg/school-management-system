<?php require ROOT_DIR . '/app/Views/layouts/header.php'; ?>
<div class="page-header">
  <div class="page-header-title">Notifications & Financial Communication</div>
</div>

<div class="grid" style="grid-template-columns: 1fr 2fr; gap: 24px;">
  <div class="card">
    <div class="card-header"><div class="card-title">Automation Rules</div></div>
    <div class="card-body">
      <div style="margin-bottom:20px;">
        <label class="form-label" style="display:flex;align-items:center;gap:10px;">
          <input type="checkbox" checked>
          SMS Fee Reminders (3 days before due)
        </label>
      </div>
      <div style="margin-bottom:20px;">
        <label class="form-label" style="display:flex;align-items:center;gap:10px;">
          <input type="checkbox" checked>
          Email Payment Confirmations
        </label>
      </div>
      <div style="margin-bottom:20px;">
        <label class="form-label" style="display:flex;align-items:center;gap:10px;">
          <input type="checkbox">
          App Push Alerts for Overdue Accounts
        </label>
      </div>
      <button class="btn btn-primary btn-sm btn-block">Save Rules</button>
    </div>
  </div>

  <div class="card">
    <div class="card-header"><div class="card-title">Recent Financial Communications</div></div>
    <div class="table-wrapper">
      <table>
        <thead><tr><th>Student/Parent</th><th>Type</th><th>Channel</th><th>Message Preview</th><th>Date</th></tr></thead>
        <tbody>
          <tr><td colspan="5" class="text-center text-muted" style="padding:48px">No recent logs.</td></tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="card mt-24">
  <div class="card-header"><div class="card-title">Bulk Announcement to Parents</div></div>
  <div class="card-body">
    <div class="form-group">
      <label class="form-label">Subject</label>
      <input type="text" class="form-control" placeholder="e.g. New Fee Structure for Term 2">
    </div>
    <div class="form-group">
      <label class="form-label">Message Content</label>
      <textarea class="form-control" rows="4"></textarea>
    </div>
    <button class="btn btn-secondary">Send Announcement</button>
  </div>
</div>

<?php require ROOT_DIR . '/app/Views/layouts/footer.php'; ?>
