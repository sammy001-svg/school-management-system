<?php require ROOT_DIR . '/app/Views/layouts/header.php'; ?>
<div class="page-header"><div class="page-header-title">Subscription Plans</div><a href="<?= $cfg['url'] ?>/admin/plans/create" class="btn btn-primary">+ Create Plan</a></div>
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;">
  <?php foreach($plans as $p): ?>
  <div class="card" style="position:relative;">
    <div class="card-body">
      <div class="fw-600" style="font-size:16px;margin-bottom:4px"><?= htmlspecialchars($p['name']) ?></div>
      <div style="color:var(--text-muted);font-size:13px;margin-bottom:12px"><?= htmlspecialchars($p['description']??'') ?></div>
      <div style="font-size:28px;font-weight:800;color:var(--primary)">$<?= number_format($p['price_monthly'],2) ?><span style="font-size:14px;font-weight:400;color:var(--text-muted)">/mo</span></div>
      <div style="margin-top:12px;font-size:13px;color:var(--text-light)">
        <div>👥 Up to <?= number_format($p['max_students']) ?> students</div>
        <div>👨‍🏫 Up to <?= number_format($p['max_teachers']) ?> teachers</div>
      </div>
      <div style="display:flex;gap:8px;margin-top:16px;">
        <a href="<?= $cfg['url'] ?>/admin/plans/<?= $p['id'] ?>/edit" class="btn btn-sm btn-secondary">Edit</a>
        <span class="badge badge-<?= $p['is_active']?'success':'danger' ?>"><?= $p['is_active']?'Active':'Inactive' ?></span>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<?php require ROOT_DIR . '/app/Views/layouts/footer.php'; ?>
