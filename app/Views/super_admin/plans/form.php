<?php require ROOT_DIR . '/app/Views/layouts/header.php'; ?>
<div class="page-header"><div class="page-header-title"><?= $plan?'Edit Plan':'Create Plan' ?></div></div>
<div style="max-width:600px;">
<form method="POST" action="<?= $cfg['url'] ?>/admin/plans/<?= $plan?$plan['id'].'/update':'store' ?>">
  <div class="card"><div class="card-body">
    <div class="form-group"><label class="form-label">Plan Name *</label><input type="text" name="name" class="form-control" value="<?= htmlspecialchars($plan['name']??'') ?>" required></div>
    <div class="form-group"><label class="form-label">Description</label><textarea name="description" class="form-control"><?= htmlspecialchars($plan['description']??'') ?></textarea></div>
    <div class="form-row">
      <div class="form-group"><label class="form-label">Max Students</label><input type="number" name="max_students" class="form-control" value="<?= $plan['max_students']??500 ?>"></div>
      <div class="form-group"><label class="form-label">Max Teachers</label><input type="number" name="max_teachers" class="form-control" value="<?= $plan['max_teachers']??50 ?>"></div>
    </div>
    <div class="form-row">
      <div class="form-group"><label class="form-label">Monthly Price ($)</label><input type="number" name="price_monthly" class="form-control" step="0.01" value="<?= $plan['price_monthly']??0 ?>"></div>
      <div class="form-group"><label class="form-label">Yearly Price ($)</label><input type="number" name="price_yearly" class="form-control" step="0.01" value="<?= $plan['price_yearly']??0 ?>"></div>
    </div>
    <div class="form-group"><label class="form-label">Billed By</label>
      <select name="billing_owner" class="form-control">
        <option value="platform" <?= ($plan['billing_owner']??'platform')==='platform'?'selected':'' ?>>Platform</option>
        <option value="reseller" <?= ($plan['billing_owner']??'')==='reseller'?'selected':'' ?>>Reseller</option>
      </select>
    </div>
  </div></div>
  <div style="display:flex;gap:12px;margin-top:20px;">
    <button type="submit" class="btn btn-primary"><?= $plan?'Update':'Create' ?> Plan</button>
    <a href="<?= $cfg['url'] ?>/admin/plans" class="btn btn-secondary">Cancel</a>
  </div>
</form>
</div>
<?php require ROOT_DIR . '/app/Views/layouts/footer.php'; ?>
