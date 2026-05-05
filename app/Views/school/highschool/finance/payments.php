<?php require ROOT_DIR . '/app/Views/layouts/header.php'; ?>
<div class="page-header">
    <div class="page-header-title">Payments</div>
    <a href="<?= $cfg['url'] ?>/school/finance/invoices" class="btn btn-primary">Make Payment</a>
</div>

<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Ref No</th>
                    <th>Invoice</th>
                    <th>Student</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($payments as $p): ?>
                <tr>
                    <td style="font-family:monospace;font-size:12px;"><?= htmlspecialchars($p['reference'] ?? '—') ?></td>
                    <td style="font-family:monospace;font-size:12px;"><?= htmlspecialchars($p['invoice_no'] ?? '—') ?></td>
                    <td class="fw-600"><?= htmlspecialchars($p['student_name'] ?? '—') ?></td>
                    <td class="text-success fw-600"><?= htmlspecialchars($tenant['currency'] ?? 'Ksh') ?><?= number_format($p['amount'], 2) ?></td>
                    <td><span class="badge badge-info"><?= strtoupper($p['method'] ?? 'Manual') ?></span></td>
                    <td style="font-size:12px;"><?= date('M d, Y', strtotime($p['paid_at'])) ?></td>
                    <td><span class="badge badge-success">Completed</span></td>
                    <td>
                      <a href="<?= $cfg['url'] ?>/school/finance/receipt/<?= $p['id'] ?>" class="btn btn-sm btn-outline" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:14px;height:14px;"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231a1.125 1.125 0 01-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" /></svg>
                        Receipt
                      </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($payments)): ?>
                <tr>
                    <td colspan="8" class="text-center text-muted" style="padding:40px;">No payments recorded yet.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require ROOT_DIR . '/app/Views/layouts/footer.php'; ?>
