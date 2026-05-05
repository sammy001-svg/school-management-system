<?php require ROOT_DIR . '/app/Views/layouts/header.php'; ?>
<div class="page-header">
  <div class="page-header-title">Fee Management</div>
  <div class="page-header-actions">
    <button class="btn btn-primary" onclick="openModal('categoryModal')">+ Add Category</button>
    <button class="btn btn-secondary" onclick="openModal('structureModal')">+ Add Structure</button>
  </div>
</div>

<div class="grid" style="grid-template-columns: 1fr 2fr; gap: 24px;">
  <!-- Fee Categories -->
  <div class="card">
    <div class="card-header"><div class="card-title">Fee Categories</div></div>
    <div class="table-wrapper">
      <table>
        <thead><tr><th>Category</th><th>Description</th></tr></thead>
        <tbody>
          <?php foreach($categories as $c): ?>
          <tr>
            <td class="fw-600"><?= htmlspecialchars($c['name']) ?></td>
            <td class="text-muted" style="font-size:12px;"><?= htmlspecialchars($c['description']??'—') ?></td>
          </tr>
          <?php endforeach; ?>
          <?php if(empty($categories)): ?><tr><td colspan="2" class="text-center text-muted" style="padding:24px">No categories.</td></tr><?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Fee Structures -->
  <div class="card">
    <div class="card-header"><div class="card-title">Fee Structures & Cycles</div></div>
    <div class="table-wrapper">
      <table>
        <thead><tr><th>Name</th><th>Amount</th><th>Cycle</th><th>Actions</th></tr></thead>
        <tbody>
          <?php foreach($structures as $s): ?>
          <tr>
            <td class="fw-600"><?= htmlspecialchars($s['name']) ?></td>
            <td><?= htmlspecialchars($tenant['currency']??'Ksh') ?> <?= number_format($s['amount'], 2) ?></td>
            <td><span class="badge badge-info"><?= ucfirst($s['frequency']) ?></span></td>
            <td><button class="btn btn-sm btn-outline" onclick="openModal('assignModal', <?= $s['id'] ?>)">Assign</button></td>
          </tr>
          <?php endforeach; ?>
          <?php if(empty($structures)): ?><tr><td colspan="4" class="text-center text-muted" style="padding:48px">No structures defined yet.</td></tr><?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Category Modal -->
<div id="categoryModal" class="modal">
  <div class="modal-content">
    <form action="<?= $cfg['url'] ?>/school/finance/fee-management/category" method="POST">
      <div class="modal-header">
        <div class="modal-title">Add Fee Category</div>
        <span class="modal-close" onclick="closeModal('categoryModal')">&times;</span>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">Category Name</label>
          <input type="text" name="name" class="form-control" placeholder="e.g. Tuition, Transport" required>
        </div>
        <div class="form-group">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="3"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeModal('categoryModal')">Cancel</button>
        <button type="submit" class="btn btn-primary">Save Category</button>
      </div>
    </form>
  </div>
</div>

<!-- Structure Modal -->
<div id="structureModal" class="modal">
  <div class="modal-content">
    <form action="<?= $cfg['url'] ?>/school/finance/fee-management/structure" method="POST">
      <div class="modal-header">
        <div class="modal-title">Add Fee Structure</div>
        <span class="modal-close" onclick="closeModal('structureModal')">&times;</span>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">Structure Name</label>
          <input type="text" name="name" class="form-control" placeholder="e.g. Grade 1 Termly Fees" required>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Amount (<?= htmlspecialchars($tenant['currency']??'Ksh') ?>)</label>
            <input type="number" name="amount" class="form-control" step="0.01" required>
          </div>
          <div class="form-group">
            <label class="form-label">Frequency</label>
            <select name="frequency" class="form-control">
              <option value="once">Once</option>
              <option value="monthly">Monthly</option>
              <option value="termly" selected>Termly</option>
              <option value="yearly">Yearly</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-control" rows="2"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeModal('structureModal')">Cancel</button>
        <button type="submit" class="btn btn-primary">Save Structure</button>
      </div>
    </form>
  </div>
</div>

<!-- Assign Modal -->
<div id="assignModal" class="modal">
  <div class="modal-content">
    <form action="<?= $cfg['url'] ?>/school/finance/fee-management/assign" method="POST">
      <input type="hidden" name="fee_structure_id" id="assign_structure_id">
      <div class="modal-header">
        <div class="modal-title">Assign Fee to Class</div>
        <span class="modal-close" onclick="closeModal('assignModal')">&times;</span>
      </div>
      <div class="modal-body">
        <div class="info-alert" style="margin-bottom:16px;">
          Assigning a fee to a class will allow you to bulk generate invoices for all students in that class.
        </div>
        <div class="form-group">
          <label class="form-label">Select Class</label>
          <select name="class_id" class="form-control" required>
            <option value="">— Select Class —</option>
            <?php foreach($classes as $c): ?>
            <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeModal('assignModal')">Cancel</button>
        <button type="submit" class="btn btn-primary">Assign Fee</button>
      </div>
    </form>
  </div>
</div>

<script>
function openModal(id, structureId = null) {
  if (structureId) {
    document.getElementById('assign_structure_id').value = structureId;
  }
  document.getElementById(id).classList.add('open');
}
</script>

<?php require ROOT_DIR . '/app/Views/layouts/footer.php'; ?>
