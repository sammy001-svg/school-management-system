<?php require ROOT_DIR . '/app/Views/layouts/header.php'; ?>

<div class="page-header">
  <div>
    <div class="page-header-title">School Dashboard</div>
    <div class="page-header-sub"><?= htmlspecialchars($tenant['name']??'') ?> — <?= date('l, F j, Y') ?></div>
  </div>
</div>

<!-- STATS -->
<div class="stat-grid">
  <div class="stat-card" style="--card-color:var(--primary)">
    <div class="stat-icon" style="background:rgba(79,70,229,0.15);color:var(--primary)">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"/></svg>
    </div>
    <div class="stat-value"><?= number_format($stats['students']) ?></div>
    <div class="stat-label">Active Students</div>
  </div>

  <div class="stat-card" style="--card-color:var(--accent)">
    <div class="stat-icon" style="background:rgba(6,182,212,0.15);color:var(--accent)">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
    </div>
    <div class="stat-value"><?= number_format($stats['teachers']) ?></div>
    <div class="stat-label">Teachers</div>
  </div>

  <div class="stat-card" style="--card-color:var(--success)">
    <div class="stat-icon" style="background:rgba(16,185,129,0.15);color:var(--success)">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    </div>
    <div class="stat-value"><?= number_format($stats['today_present']) ?></div>
    <div class="stat-label">Present Today</div>
  </div>

  <div class="stat-card" style="--card-color:var(--danger)">
    <div class="stat-icon" style="background:rgba(239,68,68,0.15);color:var(--danger)">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
    </div>
    <div class="stat-value"><?= number_format($stats['today_absent']) ?></div>
    <div class="stat-label">Absent Today</div>
  </div>

  <div class="stat-card" style="--card-color:var(--warning)">
    <div class="stat-icon" style="background:rgba(245,158,11,0.15);color:var(--warning)">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
    </div>
    <div class="stat-value"><?= number_format($stats['unpaid']) ?></div>
    <div class="stat-label">Unpaid Invoices</div>
  </div>

  <div class="stat-card" style="--card-color:var(--secondary)">
    <div class="stat-icon" style="background:rgba(124,58,237,0.15);color:var(--secondary)">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z"/></svg>
    </div>
    <div class="stat-value"><?= number_format($stats['classes']) ?></div>
    <div class="stat-label">Classes</div>
  </div>
</div>

<div style="display:grid;grid-template-columns:2fr 1fr;gap:20px;">
  <!-- Recent Students -->
  <div class="card">
    <div class="card-header">
      <div class="card-title">Recently Admitted Students</div>
      <a href="<?= $cfg['url'] ?>/school/students" class="btn btn-sm btn-outline">All Students</a>
    </div>
    <div class="table-wrapper">
      <table>
        <thead><tr><th>Student</th><th>Admission No</th><th>Class</th><th>Status</th></tr></thead>
        <tbody>
          <?php foreach($recentStudents as $s): ?>
          <tr>
            <td>
              <div style="display:flex;align-items:center;gap:10px;">
                <div class="avatar" style="width:30px;height:30px;font-size:11px;"><?= strtoupper(substr($s['name'],0,1)) ?></div>
                <div>
                  <div class="fw-600"><?= htmlspecialchars($s['name']) ?></div>
                  <div style="font-size:11px;color:var(--text-muted)"><?= htmlspecialchars($s['email']) ?></div>
                </div>
              </div>
            </td>
            <td style="font-family:monospace;font-size:12px"><?= htmlspecialchars($s['admission_no']) ?></td>
            <td><?= htmlspecialchars($s['class_name']??'—') ?></td>
            <td><span class="badge badge-<?= $s['status']==='active'?'success':'warning' ?>"><?= ucfirst($s['status']) ?></span></td>
          </tr>
          <?php endforeach; ?>
          <?php if(empty($recentStudents)): ?>
            <tr><td colspan="4" class="text-center text-muted" style="padding:32px;">No students yet. <a href="<?= $cfg['url'] ?>/school/students/create">Add one</a></td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Announcements -->
  <div class="card">
    <div class="card-header">
      <div class="card-title">Announcements</div>
      <a href="<?= $cfg['url'] ?>/school/announcements/create" class="btn btn-sm btn-primary">+ New</a>
    </div>
    <div class="card-body" style="padding:0;">
      <?php foreach($announcements as $a): ?>
      <div style="padding:14px 20px;border-bottom:1px solid var(--border);">
        <div class="fw-600" style="font-size:13px"><?= htmlspecialchars($a['title']) ?></div>
        <div style="font-size:11px;color:var(--text-muted);margin-top:2px"><?= htmlspecialchars($a['author']) ?> · <?= date('M d',strtotime($a['published_at'])) ?></div>
      </div>
      <?php endforeach; ?>
      <?php if(empty($announcements)): ?>
        <div class="text-center text-muted" style="padding:32px;font-size:13px;">No announcements</div>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Quick Actions -->
<div class="card mt-24">
  <div class="card-header"><div class="card-title">Quick Actions</div></div>
  <div class="card-body" style="display:flex;gap:12px;flex-wrap:wrap;">
    <a href="<?= $cfg['url'] ?>/school/students/create" class="btn btn-primary">+ Admit Student</a>
    <a href="<?= $cfg['url'] ?>/school/attendance" class="btn btn-secondary">Mark Attendance</a>
    <a href="<?= $cfg['url'] ?>/school/finance/invoices/create" class="btn btn-secondary">Create Invoice</a>
    <a href="<?= $cfg['url'] ?>/school/grades/enter" class="btn btn-secondary">Enter Grades</a>
    <a href="<?= $cfg['url'] ?>/school/announcements/create" class="btn btn-secondary">Post Announcement</a>
  </div>
</div>

<?php require ROOT_DIR . '/app/Views/layouts/footer.php'; ?>
