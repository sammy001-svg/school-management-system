<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Receipt - <?= htmlspecialchars($payment['reference']) ?></title>
  <style>
    body { font-family: 'Inter', sans-serif; color: #333; margin: 0; padding: 40px; }
    .receipt-container { max-width: 600px; margin: 0 auto; border: 1px solid #eee; padding: 30px; border-radius: 8px; }
    .header { text-align: center; border-bottom: 2px solid #f5f5f5; padding-bottom: 20px; margin-bottom: 20px; }
    .school-name { font-size: 20px; font-weight: 800; text-transform: uppercase; margin: 0; }
    .receipt-title { font-size: 14px; color: #666; margin-top: 5px; }
    .row { display: flex; justify-content: space-between; margin-bottom: 12px; font-size: 14px; }
    .label { color: #888; }
    .value { font-weight: 600; }
    .total-section { border-top: 2px solid #f5f5f5; padding-top: 15px; margin-top: 15px; }
    .total-amount { font-size: 24px; font-weight: 800; color: #10B981; }
    .footer { text-align: center; font-size: 11px; color: #aaa; margin-top: 40px; }
    @media print { .no-print { display: none; } }
  </style>
</head>
<body>
  <div class="receipt-container">
    <div class="header">
      <p class="school-name"><?= htmlspecialchars($tenant['name']) ?></p>
      <p class="receipt-title">OFFICIAL PAYMENT RECEIPT</p>
    </div>
    
    <div class="row">
      <span class="label">Receipt No:</span>
      <span class="value">#<?= htmlspecialchars($payment['id']) ?></span>
    </div>
    <div class="row">
      <span class="label">Date:</span>
      <span class="value"><?= date('M d, Y H:i', strtotime($payment['paid_at'])) ?></span>
    </div>
    <div class="row">
      <span class="label">Reference:</span>
      <span class="value"><?= htmlspecialchars($payment['reference'] ?? 'N/A') ?></span>
    </div>
    
    <hr style="border:0;border-top:1px dashed #eee;margin:20px 0;">
    
    <div class="row">
      <span class="label">Student Name:</span>
      <span class="value"><?= htmlspecialchars($payment['student_name']) ?></span>
    </div>
    <div class="row">
      <span class="label">Invoice No:</span>
      <span class="value"><?= htmlspecialchars($payment['invoice_no']) ?></span>
    </div>
    <div class="row">
      <span class="label">Payment Method:</span>
      <span class="value"><?= strtoupper($payment['method']) ?></span>
    </div>
    
    <div class="total-section row">
      <span class="label">Amount Paid:</span>
      <span class="total-amount"><?= htmlspecialchars($tenant['currency']??'Ksh') ?> <?= number_format($payment['amount'], 2) ?></span>
    </div>
    
    <div class="footer">
      <p>This is a computer-generated receipt. No signature is required.</p>
      <p>Thank you for your payment!</p>
    </div>
  </div>

  <div style="text-align:center;margin-top:30px;" class="no-print">
    <button onclick="window.print()" style="padding:10px 20px;cursor:pointer;background:#10B981;color:#fff;border:none;border-radius:4px;font-weight:600;">Print Receipt</button>
  </div>
</body>
</html>
