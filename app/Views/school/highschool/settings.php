<?php require ROOT_DIR . '/app/Views/layouts/header.php'; ?>
<div class="page-header"><div class="page-header-title">School Settings</div></div>
<div style="max-width:680px;">
<form method="POST" action="<?= $cfg['url'] ?>/school/settings/update">
  <div class="card"><div class="card-header"><div class="card-title">General Information</div></div>
  <div class="card-body">
    <div class="form-row">
      <div class="form-group"><label class="form-label">School Name</label><input type="text" name="name" class="form-control" value="<?= htmlspecialchars($tenant['name']??'') ?>"></div>
      <div class="form-group"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="<?= htmlspecialchars($tenant['email']??'') ?>"></div>
    </div>
    <div class="form-row">
      <div class="form-group"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($tenant['phone']??'') ?>"></div>
      <div class="form-group"><label class="form-label">Country</label><input type="text" name="country" class="form-control" value="<?= htmlspecialchars($tenant['country']??'') ?>"></div>
    </div>
    <div class="form-group"><label class="form-label">Address</label><textarea name="address" class="form-control"><?= htmlspecialchars($tenant['address']??'') ?></textarea></div>
    <div class="form-row">
      <div class="form-group"><label class="form-label">Timezone</label>
        <select name="timezone" class="form-control">
          <?php foreach(['UTC','Africa/Nairobi','Africa/Lagos','Africa/Cairo','Europe/London','America/New_York','Asia/Dubai'] as $tz): ?>
            <option value="<?= $tz ?>" <?= ($tenant['timezone']??'UTC')===$tz?'selected':'' ?>><?= $tz ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group"><label class="form-label">Academic Year</label><input type="text" name="academic_year" class="form-control" placeholder="2024/2025" value="<?= htmlspecialchars($tenant['academic_year']??'') ?>"></div>
    </div>
  </div></div>
  <div style="margin-top:20px;"><button type="submit" class="btn btn-primary">Save Settings</button></div>
</form>
</div>
<?php require ROOT_DIR . '/app/Views/layouts/footer.php'; ?>
