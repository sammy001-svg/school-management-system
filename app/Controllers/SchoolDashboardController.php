<?php
require_once ROOT_DIR . '/core/Controller.php';

class SchoolDashboardController extends Controller {
    public function index(): void {
        $this->requireAuth(['School Admin','Teacher','Accountant','Staff','Super Admin']);
        $tid = $this->tenantId();
        $tenant = $this->db->fetchOne("SELECT * FROM tenants WHERE id=?", [$tid]);

        $stats = [
            'students'  => $this->db->fetchOne("SELECT COUNT(*) AS c FROM students WHERE tenant_id=? AND status='active'",[$tid])['c']??0,
            'teachers'  => $this->db->fetchOne("SELECT COUNT(*) AS c FROM teachers WHERE tenant_id=?",[$tid])['c']??0,
            'classes'   => $this->db->fetchOne("SELECT COUNT(*) AS c FROM classes WHERE tenant_id=?",[$tid])['c']??0,
            'unpaid'    => $this->db->fetchOne("SELECT COUNT(*) AS c FROM invoices WHERE tenant_id=? AND status IN('unpaid','partial','overdue')",[$tid])['c']??0,
            'today_present' => $this->db->fetchOne("SELECT COUNT(*) AS c FROM attendance WHERE tenant_id=? AND date=CURDATE() AND status='present'",[$tid])['c']??0,
            'today_absent'  => $this->db->fetchOne("SELECT COUNT(*) AS c FROM attendance WHERE tenant_id=? AND date=CURDATE() AND status='absent'",[$tid])['c']??0,
        ];

        $recentStudents = $this->db->fetchAll(
            "SELECT s.*, u.name, u.email FROM students s JOIN users u ON s.user_id=u.id
             WHERE s.tenant_id=? ORDER BY s.id DESC LIMIT 8", [$tid]
        );
        $announcements = $this->db->fetchAll(
            "SELECT a.*, u.name AS author FROM announcements a JOIN users u ON a.author_id=u.id
             WHERE a.tenant_id=? ORDER BY a.published_at DESC LIMIT 5", [$tid]
        );

        $view = ($tenant['institution_type'] === 'university') 
                ? 'school/university/dashboard' 
                : 'school/highschool/dashboard';

        $this->view($view, [
            'pageTitle'      => 'School Dashboard',
            'panelType'      => 'school',
            'tenant'         => $tenant,
            'stats'          => $stats,
            'recentStudents' => $recentStudents,
            'announcements'  => $announcements,
            'flash'          => $this->getFlash(),
        ]);
    }
}
