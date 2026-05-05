<?php require ROOT_DIR . '/app/Views/layouts/header.php'; ?>
<div class="page-header">
    <div class="page-header-title">University Overview</div>
    <div class="text-muted"><?= htmlspecialchars($tenant['name']) ?> · Academic Year <?= htmlspecialchars($tenant['academic_year'] ?? '2025/26') ?></div>
</div>

<div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(240px, 1fr));gap:20px;margin-bottom:30px;">
    <div class="card">
        <div class="card-body">
            <div class="stat-label">Total Students</div>
            <div class="stat-value"><?= number_format($stats['students']) ?></div>
            <div style="margin-top:10px;"><span class="badge badge-success">+12% this semester</span></div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="stat-label">Faculty Members</div>
            <div class="stat-value"><?= number_format($stats['teachers']) ?></div>
            <div class="stat-sub">Across 8 Departments</div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="stat-label">Active Programs</div>
            <div class="stat-value">14</div>
            <div class="stat-sub">Degree & Diploma</div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="stat-label">Unpaid Invoices</div>
            <div class="stat-value"><?= number_format($stats['unpaid']) ?></div>
            <div style="margin-top:10px;"><a href="<?= $cfg['url'] ?>/school/finance/invoices" class="btn btn-sm btn-outline">View Arrears</a></div>
        </div>
    </div>
</div>

<div style="display:grid;grid-template-columns:2fr 1fr;gap:20px;">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Recent Student Registrations</div>
            <a href="<?= $cfg['url'] ?>/school/students" class="btn btn-sm btn-outline">All Students</a>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Reg No</th>
                        <th>Program</th>
                        <th>Semester</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($recentStudents as $s): ?>
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div class="avatar avatar-sm"><?= strtoupper(substr($s['name'], 0, 1)) ?></div>
                                <div class="fw-600"><?= htmlspecialchars($s['name']) ?></div>
                            </div>
                        </td>
                        <td style="font-family:monospace;font-size:12px;"><?= htmlspecialchars($s['admission_no']) ?></td>
                        <td><span class="badge badge-info"><?= htmlspecialchars($s['program_name'] ?? 'General') ?></span></td>
                        <td>Sem <?= $s['current_semester'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="card-title">Campus Announcements</div>
            <a href="<?= $cfg['url'] ?>/school/announcements/create" class="btn btn-sm btn-primary">+ Post</a>
        </div>
        <div class="card-body" style="padding:0;">
            <?php foreach($announcements as $a): ?>
            <div style="padding:16px 20px; border-bottom:1px solid var(--border-color);">
                <div class="fw-600" style="margin-bottom:4px;"><?= htmlspecialchars($a['title']) ?></div>
                <div class="text-muted" style="font-size:12px; margin-bottom:8px;">By <?= htmlspecialchars($a['author']) ?> · <?= date('M d', strtotime($a['published_at'])) ?></div>
                <div style="font-size:13px; line-height:1.4; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                    <?= htmlspecialchars($a['body']) ?>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if(empty($announcements)): ?>
            <div style="padding:40px;text-align:center;" class="text-muted">No campus news.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require ROOT_DIR . '/app/Views/layouts/footer.php'; ?>
