<?php require ROOT_DIR . '/app/Views/layouts/header.php'; ?>
<div class="page-header">
  <div>
    <div class="page-header-title">Finance Communications</div>
    <div class="page-header-sub">Manage automated notifications, fee reminders, and bulk announcements.</div>
  </div>
</div>

<div class="grid" style="grid-template-columns: 1.2fr 2fr; gap: 24px;">
  <!-- Automation Rules -->
  <div class="card">
    <div class="card-header">
      <div class="card-title">Automation Settings</div>
      <span class="badge badge-success">Live</span>
    </div>
    <div class="card-body">
      <div style="display:flex; flex-direction:column; gap:20px;">
        <div style="display:flex; align-items:flex-start; gap:16px;">
          <div style="margin-top:4px;"><input type="checkbox" checked style="width:18px; height:18px; accent-color:var(--primary);"></div>
          <div>
            <div class="fw-700" style="font-size:14px; color:var(--text);">Fee Reminders (Pre-due)</div>
            <div class="text-muted" style="font-size:12px;">Send SMS 3 days before the invoice due date.</div>
          </div>
        </div>
        
        <div style="display:flex; align-items:flex-start; gap:16px;">
          <div style="margin-top:4px;"><input type="checkbox" checked style="width:18px; height:18px; accent-color:var(--primary);"></div>
          <div>
            <div class="fw-700" style="font-size:14px; color:var(--text);">Overdue Notifications</div>
            <div class="text-muted" style="font-size:12px;">Automatic daily alerts for accounts overdue by 7+ days.</div>
          </div>
        </div>

        <div style="display:flex; align-items:flex-start; gap:16px;">
          <div style="margin-top:4px;"><input type="checkbox" checked style="width:18px; height:18px; accent-color:var(--primary);"></div>
          <div>
            <div class="fw-700" style="font-size:14px; color:var(--text);">Payment Confirmations</div>
            <div class="text-muted" style="font-size:12px;">Instant receipt delivery via Email & App Push.</div>
          </div>
        </div>
      </div>
      <button class="btn btn-primary btn-block" style="margin-top:32px;">Update Preferences</button>
    </div>
  </div>

  <!-- Announcement Hub -->
  <div class="card">
    <div class="card-header">
      <div class="card-title">Bulk Announcement Hub</div>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label class="form-label">Target Audience</label>
        <select class="form-control">
          <option>All Parents & Guardians</option>
          <option>Parents with Overdue Balances</option>
          <option>Specific Class (Grade 1)</option>
        </select>
      </div>
      <div class="form-group">
        <label class="form-label">Subject</label>
        <input type="text" class="form-control" placeholder="e.g. Revised Fee Structure for Term 3">
      </div>
      <div class="form-group">
        <label class="form-label">Message Template</label>
        <textarea class="form-control" rows="5" placeholder="Type your financial announcement here..."></textarea>
      </div>
      <div style="display:flex; align-items:center; justify-content:space-between; margin-top:20px;">
        <div class="text-muted" style="font-size:12px;">Channels: <span class="badge badge-info">SMS</span> <span class="badge badge-info">Email</span></div>
        <button class="btn btn-secondary">Dispatch Announcement</button>
      </div>
    </div>
  </div>
</div>

<div class="card mt-24">
  <div class="card-header"><div class="card-title">Recent Delivery Logs</div></div>
  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>Recipient</th>
          <th>Type</th>
          <th>Channel</th>
          <th>Status</th>
          <th class="text-right">Sent Date</th>
        </tr>
      </thead>
      <tbody>
        <tr><td colspan="5" class="text-center text-muted" style="padding:48px">No communication logs recorded in the last 24 hours.</td></tr>
      </tbody>
    </table>
  </div>
</div>

<?php require ROOT_DIR . '/app/Views/layouts/footer.php'; ?>
