<?php require ROOT_DIR . '/app/Views/layouts/header.php'; ?>
<div class="page-header">
  <div class="page-header-title">Budgeting & Financial Planning</div>
  <div class="page-header-actions">
    <button class="btn btn-secondary" onclick="openModal('headModal')">+ Add Category</button>
    <button class="btn btn-primary" onclick="openModal('budgetModal')">+ New Budget Plan</button>
  </div>
</div>

<div class="card">
  <div class="card-header"><div class="card-title">Active Budgets</div></div>
  <div class="table-wrapper">
    <table>
      <thead><tr><th>Budget Name</th><th>Academic Year</th><th>Total Allocated</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        <?php foreach($budgets as $b): ?>
        <tr>
          <td class="fw-600"><?= htmlspecialchars($b['name']) ?></td>
          <td><?= htmlspecialchars($b['academic_year']) ?></td>
          <td class="fw-700"><?= number_format($b['total_amount'], 2) ?></td>
          <td><span class="badge badge-warning"><?= ucfirst($b['status']) ?></span></td>
          <td><button class="btn btn-sm btn-outline">Manage Allocations</button></td>
        </tr>
        <?php endforeach; ?>
        <?php if(empty($budgets)): ?><tr><td colspan="5" class="text-center text-muted" style="padding:64px">No budgets created yet. Start planning your academic year financial goals.</td></tr><?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<div class="grid" style="grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 24px;">
  <div class="card">
    <div class="card-header"><div class="card-title">Budget Categories (Income/Expense Heads)</div></div>
    <div class="table-wrapper">
      <table>
        <thead><tr><th>Code</th><th>Name</th><th>Type</th></tr></thead>
        <tbody>
          <?php foreach($budgetHeads as $h): ?>
          <tr>
            <td style="font-family:monospace;"><?= htmlspecialchars($h['code']??'—') ?></td>
            <td class="fw-600"><?= htmlspecialchars($h['name']) ?></td>
            <td><span class="badge <?= $h['type'] === 'income' ? 'badge-success' : 'badge-danger' ?>"><?= strtoupper($h['type']) ?></span></td>
          </tr>
          <?php endforeach; ?>
          <?php if(empty($budgetHeads)): ?><tr><td colspan="3" class="text-center text-muted" style="padding:24px">No categories defined.</td></tr><?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="card">
    <div class="card-header"><div class="card-title">Financial Forecasting</div></div>
    <div class="card-body">
      <p class="text-muted">Projected collection vs expected expenses based on enrollment data and historical trends.</p>
      <div style="height:120px;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,0.03);border-radius:var(--radius-sm);margin:16px 0;">
        <span class="text-muted" style="font-size:12px;">Forecast chart initialization...</span>
      </div>
      <button class="btn btn-sm btn-secondary btn-block" disabled>Run Forecast Model</button>
    </div>
  </div>
</div>

<!-- Head Modal -->
<div id="headModal" class="modal">
  <div class="modal-content">
    <form action="<?= $cfg['url'] ?>/school/finance/budgeting/head" method="POST">
      <div class="modal-header">
        <div class="modal-title">Add Budget Category</div>
        <span class="modal-close" onclick="closeModal('headModal')">&times;</span>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">Category Name</label>
          <input type="text" name="name" class="form-control" placeholder="e.g. Lab Equipment, Staff Welfare" required>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Type</label>
            <select name="type" class="form-control">
              <option value="expense">Expense</option>
              <option value="income">Income</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Code (Optional)</label>
            <input type="text" name="code" class="form-control" placeholder="e.g. EXP-001">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeModal('headModal')">Cancel</button>
        <button type="submit" class="btn btn-primary">Save Category</button>
      </div>
    </form>
  </div>
</div>

<!-- Budget Modal -->
<div id="budgetModal" class="modal">
  <div class="modal-content">
    <form action="<?= $cfg['url'] ?>/school/finance/budgeting/store" method="POST">
      <div class="modal-header">
        <div class="modal-title">New Budget Plan</div>
        <span class="modal-close" onclick="closeModal('budgetModal')">&times;</span>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">Budget Name</label>
          <input type="text" name="name" class="form-control" placeholder="e.g. Annual Budget 2026" required>
        </div>
        <div class="form-group">
          <label class="form-label">Academic Year</label>
          <select name="academic_year_id" class="form-control" required>
            <?php foreach($academicYears as $ay): ?>
            <option value="<?= $ay['id'] ?>"><?= htmlspecialchars($ay['name']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeModal('budgetModal')">Cancel</button>
        <button type="submit" class="btn btn-primary">Create Plan</button>
      </div>
    </form>
  </div>
</div>

<?php require ROOT_DIR . '/app/Views/layouts/footer.php'; ?>
