<?php require ROOT_DIR . '/app/Views/layouts/header.php'; ?>
<div class="page-header">
  <div>
    <div class="page-header-title">Fee Management</div>
    <div class="page-header-sub">Configure fee structures, categories, and student billing cycles.</div>
  </div>
  <div class="page-header-actions" style="display:flex; gap:12px;">
    <button class="btn btn-secondary" onclick="openModal('categoryModal')">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:16px;height:16px;margin-right:8px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
      Add Category
    </button>
    <button class="btn btn-primary" onclick="openModal('structureModal')">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:16px;height:16px;margin-right:8px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
      Add Structure
    </button>
  </div>
</div>

<div class="grid" style="grid-template-columns: 1fr 2fr; gap: 24px;">
  <!-- Fee Categories -->
  <div class="card">
    <div class="card-header">
      <div class="card-title">Billing Categories</div>
      <span class="badge badge-info"><?= count($categories) ?> Total</span>
    </div>
    <div class="table-wrapper">
      <table>
        <thead><tr><th>Category</th><th>Details</th></tr></thead>
        <tbody>
          <?php foreach($categories as $c): ?>
          <tr>
            <td>
              <div class="fw-700" style="color:var(--text);"><?= htmlspecialchars($c['name']) ?></div>
            </td>
            <td>
              <div class="text-muted" style="font-size:12px; max-width:180px;"><?= htmlspecialchars($c['description']??'No description.') ?></div>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php if(empty($categories)): ?>
          <tr><td colspan="2" class="text-center text-muted" style="padding:40px">No categories defined.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Fee Structures -->
  <div class="card">
    <div class="card-header">
      <div class="card-title">Fee Structures & Active Pricing</div>
    </div>
    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>Structure Name</th>
            <th>Amount</th>
            <th>Cycle</th>
            <th class="text-right">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($structures as $s): ?>
          <tr>
            <td>
              <div class="fw-700" style="color:var(--text);"><?= htmlspecialchars($s['name']) ?></div>
              <div class="text-muted" style="font-size:11px;">ID: #FS-<?= $s['id'] ?></div>
            </td>
            <td class="fw-700" style="color:var(--primary);"><?= htmlspecialchars($tenant['currency']??'Ksh') ?> <?= number_format($s['amount'], 2) ?></td>
            <td><span class="badge badge-outline" style="border: 1px solid var(--border);"><?= ucfirst($s['frequency']) ?></span></td>
            <td class="text-right">
              <button class="btn btn-sm btn-outline" onclick="openModal('assignModal', <?= $s['id'] ?>)">Assign to Class</button>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php if(empty($structures)): ?>
          <tr><td colspan="4" class="text-center text-muted" style="padding:60px">No fee structures created yet.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modals -->
<div id="categoryModal" class="modal">
  <div class="modal-content">
    <form action="<?= $cfg['url'] ?>/school/finance/fee-management/category" method="POST">
      <div class="modal-header">
        <div class="modal-title">New Billing Category</div>
        <span class="modal-close" onclick="closeModal('categoryModal')">&times;</span>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">Category Name</label>
          <input type="text" name="name" class="form-control" placeholder="e.g. Tuition Fees, Transport, Exam Fees" required>
        </div>
        <div class="form-group">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="3" placeholder="Briefly describe what this category covers..."></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeModal('categoryModal')">Discard</button>
        <button type="submit" class="btn btn-primary">Create Category</button>
      </div>
    </form>
  </div>
</div>

<div id="structureModal" class="modal">
  <div class="modal-content">
    <form action="<?= $cfg['url'] ?>/school/finance/fee-management/structure" method="POST">
      <div class="modal-header">
        <div class="modal-title">New Fee Structure</div>
        <span class="modal-close" onclick="closeModal('structureModal')">&times;</span>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">Structure Name</label>
          <input type="text" name="name" class="form-control" placeholder="e.g. Grade 1 Termly Fees 2026" required>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Amount (<?= htmlspecialchars($tenant['currency']??'Ksh') ?>)</label>
            <input type="number" name="amount" class="form-control" step="0.01" placeholder="0.00" required>
          </div>
          <div class="form-group">
            <label class="form-label">Billing Frequency</label>
            <select name="frequency" class="form-control">
              <option value="once">Once-off</option>
              <option value="monthly">Monthly</option>
              <option value="termly" selected>Termly</option>
              <option value="yearly">Yearly</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Notes (Optional)</label>
          <textarea name="description" class="form-control" rows="2"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeModal('structureModal')">Discard</button>
        <button type="submit" class="btn btn-primary">Create Structure</button>
      </div>
    </form>
  </div>
</div>

<div id="assignModal" class="modal">
  <div class="modal-content">
    <form action="<?= $cfg['url'] ?>/school/finance/fee-management/assign" method="POST">
      <input type="hidden" name="fee_structure_id" id="assign_structure_id">
      <div class="modal-header">
        <div class="modal-title">Bulk Fee Assignment</div>
        <span class="modal-close" onclick="closeModal('assignModal')">&times;</span>
      </div>
      <div class="modal-body">
        <div class="info-alert" style="margin-bottom:20px; font-size:13px; line-height:1.6;">
          Select a class to assign this fee structure to. This will allow you to generate invoices for all enrolled students in that class simultaneously.
        </div>
        <div class="form-group">
          <label class="form-label">Select Target Class</label>
          <select name="class_id" class="form-control" required>
            <option value="">— Choose Class —</option>
            <?php foreach($classes as $c): ?>
            <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeModal('assignModal')">Cancel</button>
        <button type="submit" class="btn btn-primary">Confirm Assignment</button>
      </div>
    </form>
  </div>
</div>

<script>
function openModal(id, structureId = null) {
  if (structureId && document.getElementById('assign_structure_id')) {
    document.getElementById('assign_structure_id').value = structureId;
  }
  const modal = document.getElementById(id);
  if (modal) modal.classList.add('open');
}
</script>

<?php require ROOT_DIR . '/app/Views/layouts/footer.php'; ?>
