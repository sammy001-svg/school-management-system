<?php require ROOT_DIR . '/app/Views/layouts/header.php'; ?>
<div class="page-header">
  <div class="page-header-title">Fee Management</div>
  <div class="page-header-actions">
    <button class="btn btn-primary" onclick="openModal('categoryModal')">+ Add Category</button>
    <button class="btn btn-secondary" onclick="openModal('assignmentModal')">+ Assign Fees</button>
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

  <!-- Billing Cycles & Structures -->
  <div class="card">
    <div class="card-header"><div class="card-title">Fee Structures & Cycles</div></div>
    <div class="card-body">
      <div class="info-alert" style="margin-bottom:16px;">
        Define how much students should pay for each category per term or year.
      </div>
      <div class="table-wrapper">
        <table>
          <thead><tr><th>Name</th><th>Amount</th><th>Cycle</th><th>Status</th></tr></thead>
          <tbody>
            <tr><td colspan="4" class="text-center text-muted" style="padding:48px">
              <div style="font-size:14px;font-weight:600;margin-bottom:8px;">No structures defined yet.</div>
              <button class="btn btn-sm btn-outline">Create First Structure</button>
            </td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="card mt-24">
  <div class="card-header"><div class="card-title">Discounts, Scholarships & Waivers</div></div>
  <div class="card-body">
    <p class="text-muted">Configure global or student-specific discounts like Academic Scholarships or Staff Child waivers.</p>
    <button class="btn btn-secondary btn-sm" style="margin-top:12px;">Manage Discount Rules</button>
  </div>
</div>

<?php require ROOT_DIR . '/app/Views/layouts/footer.php'; ?>
