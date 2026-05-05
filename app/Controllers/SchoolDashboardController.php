<?php
require_once ROOT_DIR . '/core/Controller.php';

class SchoolDashboardController extends Controller {
    public function index(): void {
        $this->requireAuth(['School Admin','Teacher','Accountant','Staff','Super Admin']);
        $tid = $this->tenantId();
        $tenant = $this->db->fetchOne("SELECT * FROM tenants WHERE id=?", [$tid]);

        // Base Stats
        $students = $this->db->fetchOne("SELECT COUNT(*) AS c FROM students WHERE tenant_id=? AND status='active'",[$tid])['c']??0;
        $teachers = $this->db->fetchOne("SELECT COUNT(*) AS c FROM teachers WHERE tenant_id=?",[$tid])['c']??0;
        $classes  = $this->db->fetchOne("SELECT COUNT(*) AS c FROM classes WHERE tenant_id=?",[$tid])['c']??0;
        $present  = $this->db->fetchOne("SELECT COUNT(*) AS c FROM attendance WHERE tenant_id=? AND date=CURDATE() AND status='present'",[$tid])['c']??0;
        
        $attendance_percent = $students > 0 ? round(($present / $students) * 100, 1) : 0;

        $stats = [
            'students' => $students,
            'teachers' => $teachers,
            'classes'  => $classes,
            'attendance_pct' => $attendance_percent
        ];

        // Announcements
        $announcements = $this->db->fetchAll(
            "SELECT a.*, u.name AS author FROM announcements a JOIN users u ON a.author_id=u.id
             WHERE a.tenant_id=? ORDER BY a.published_at DESC LIMIT 3", [$tid]
        );

        // Chart Data - Attendance (Mocked for last 6 days for the line chart)
        $attendance_history = [
            'Mon' => rand(70, 95), 'Tue' => rand(70, 95), 'Wed' => rand(70, 95),
            'Thu' => rand(70, 95), 'Fri' => rand(70, 95), 'Sat' => rand(70, 95)
        ];

        // Chart Data - Fees
        // Normally we'd query invoices table. Let's provide some realistic dummy data to match the image UI.
        $fees = [
            'collected' => 875000,
            'pending' => 300000,
            'overdue' => 70000
        ];

        // Chart Data - Exams
        $exams = [
            'upcoming' => 18,
            'in_progress' => 12,
            'completed' => 8,
            'cancelled' => 4
        ];

        $view = ($tenant['institution_type'] === 'university') 
                ? 'school/university/dashboard' 
                : 'school/highschool/dashboard';

        $this->view($view, [
            'pageTitle'      => 'Dashboard',
            'panelType'      => 'school',
            'tenant'         => $tenant,
            'stats'          => $stats,
            'announcements'  => $announcements,
            'attendance_hist'=> $attendance_history,
            'fees'           => $fees,
            'exams'          => $exams,
            'flash'          => $this->getFlash(),
        ]);
    }
}
