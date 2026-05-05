<?php require ROOT_DIR . '/app/Views/layouts/header.php'; ?>
<div class="page-header">
  <div>
    <div class="page-header-title">Budgeting & Financial Planning</div>
    <div class="page-header-sub">Manage institutional budgets, department allocations, and fiscal projections.</div>
  </div>
  <div class="page-header-actions" style="display:flex; gap:12px;">
    <button class="btn btn-secondary" onclick="openModal('headModal')">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:16px;height:16px;margin-right:8px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
      Add Category
    </button>
    <button class="btn btn-primary" onclick="openModal('budgetModal')">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:16px;height:16px;margin-right:8px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
      New Budget Plan
    </button>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <div class="card-title">Fiscal Year Budget Plans</div>
  </div>
  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>Budget Name</th>
          <th>Academic Year</th>
          <th class="text-right">Total Allocated</th>
          <th>Status</th>
          <th class="text-right">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($budgets as $b): ?>
        <tr>
          <td>
            <div class="fw-700" style="color:var(--text);"><?= htmlspecialchars($b['name']) ?></div>
          </td>
          <td><span class="badge badge-info"><?= htmlspecialchars($b['academic_year']) ?></span></td>
          <td class="text-right fw-800" style="color:var(--text);"><?= number_format($b['total_amount'], 2) ?></td>
          <td><span class="badge badge-warning"><?= ucfirst($b['status']) ?></span></td>
          <td class="text-right">
            <button class="btn btn-sm btn-outline">Manage Allocations</button>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php if(empty($budgets)): ?>
        <tr><td colspan="5" class="text-center text-muted" style="padding:60px">No active budget plans found for this period.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<div class="grid" style="grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 24px;">
  <div class="card">
    <div class="card-header"><div class="card-title">Budget Categories (Chart of Accounts)</div></div>
    <div class="table-wrapper">
      <table>
        <thead><tr><th>Code</th><th>Name</th><th>Type</th></tr></thead>
        <tbody>
          <?php foreach($budgetHeads as $h): ?>
          <tr>
            <td style="font-family:monospace; font-size:12px;"><?= htmlspecialchars($h['code']??'—') ?></td>
            <td class="fw-700" style="color:var(--text);"><?= htmlspecialchars($h['name']) ?></td>
            <td><span class="badge <?= $h['type'] === 'income' ? 'badge-success' : 'badge-danger' ?>"><?= strtoupper($h['type']) ?></span></td>
          </tr>
          <?php endforeach; ?>
          <?php if(empty($budgetHeads)): ?><tr><td colspan="3" class="text-center text-muted" style="padding:30px">No categories defined.</td></tr><?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  
  <div class="card">
    <div class="card-header"><div class="card-title">Financial Forecasting</div></div>
    <div class="card-body">
      <p class="text-muted" style="font-size:13px; line-height:1.6; margin-bottom:20px;">Use our AI-driven forecasting engine to project end-of-year balances based on current enrollment and spending trends.</p>
      <div style="height:140px; border:1px dashed var(--border); border-radius:12px; display:flex; align-items:center; justify-content:center; background:rgba(255,255,255,0.01); margin-bottom:20px;">
        <div class="text-center">
          <div class="text-muted" style="font-size:11px; text-transform:uppercase; letter-spacing:1px; margin-bottom:8px;">Ready for Analysis</div>
          <button class="btn btn-xs btn-outline" disabled>Initialize Model</button>
        </div>
      </div>
      <button class="btn btn-secondary btn-block" disabled>Generate Projection Report</button>
    </div>
  </div>
</div>

<!-- Modals -->
<div id="headModal" class="modal">
  <div class="modal-content">
    <form action="<?= $cfg['url'] ?>/school/finance/budgeting/head" method="POST">
      <div class="modal-header">
        <div class="modal-title">New Budget Category</div>
        <span class="modal-close" onclick="closeModal('headModal')">&times;</span>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">Category Name</label>
          <input type="text" name="name" class="form-control" placeholder="e.g. Science Lab Supplies, Teacher Salaries" required>
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
            <label class="form-label">GL Code (Optional)</label>
            <input type="text" name="code" class="form-control" placeholder="e.g. 500-101">
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

<div id="budgetModal" class="modal">
  <div class="modal-content">
    <form action="<?= $cfg['url'] ?>/school/finance/budgeting/store" method="POST">
      <div class="modal-header">
        <div class="modal-title">Create Budget Plan</div>
        <span class="modal-close" onclick="closeModal('budgetModal')">&times;</span>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="form-label">Budget Plan Name</label>
          <input type="text" name="name" class="form-control" placeholder="e.g. Academic Budget 2026/27" required>
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
        <button type="button" class="btn btn-secondary" onclick="closeModal('budgetModal')">Discard</button>
        <button type="submit" class="btn btn-primary">Initialize Plan</button>
      </div>
    </form>
  </div>
</div>

<?php require ROOT_DIR . '/app/Views/layouts/footer.php'; ?>
