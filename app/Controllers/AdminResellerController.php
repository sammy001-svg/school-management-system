<?php
require_once ROOT_DIR . '/core/Controller.php';

class AdminResellerController extends Controller {

    public function index(): void {
        $this->requireSuperAdmin();
        $search   = $_GET['q'] ?? '';
        $where    = "slug != 'platform'";
        $params   = [];
        if ($search) { $where .= " AND (name LIKE ? OR email LIKE ?)"; $params = ["%$search%", "%$search%"]; }
        $resellers = $this->db->fetchAll("SELECT r.*, (SELECT COUNT(*) FROM tenants t WHERE t.reseller_id = r.id) AS school_count FROM resellers r WHERE $where ORDER BY r.created_at DESC", $params);
        $this->view('super_admin/resellers/index', ['pageTitle'=>'Resellers','panelType'=>'admin','resellers'=>$resellers,'search'=>$search,'flash'=>$this->getFlash()]);
    }

    public function create(): void {
        $this->requireSuperAdmin();
        $this->view('super_admin/resellers/form', ['pageTitle'=>'Add Reseller','panelType'=>'admin','reseller'=>null,'flash'=>$this->getFlash()]);
    }

    public function store(): void {
        $this->requireSuperAdmin();
        $name     = trim($_POST['name'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (!$name || !$email || !$password) {
            $this->flash('error', 'Name, email, and password are required.');
            $this->redirect('/admin/resellers/create');
        }

        $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $name));
        
        // 1. Create the reseller
        $resellerId = $this->db->insert("INSERT INTO resellers (name, slug, email, phone, domain, primary_color, secondary_color, status, commission_rate) VALUES (?,?,?,?,?,?,?,?,?)", [
            $name, $slug, $email, trim($_POST['phone'] ?? ''),
            trim($_POST['domain'] ?? '') ?: null,
            $_POST['primary_color'] ?? '#4F46E5',
            $_POST['secondary_color'] ?? '#7C3AED',
            $_POST['status'] ?? 'pending',
            $_POST['commission_rate'] ?? 0
        ]);

        // 2. Create the Reseller Owner user (Role ID 2)
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $this->db->insert("INSERT INTO users (reseller_id, role_id, name, email, password_hash, status) VALUES (?, ?, ?, ?, ?, ?)", [
            $resellerId, 2, $name . ' Owner', $email, $passwordHash, 'active'
        ]);

        $this->flash('success', 'Reseller and Owner user created successfully.');
        $this->redirect('/admin/resellers');
    }

    public function show(string $id): void {
        $this->requireSuperAdmin();
        $reseller = $this->db->fetchOne("SELECT * FROM resellers WHERE id=?", [$id]);
        if (!$reseller) { $this->redirect('/admin/resellers'); }
        $schools = $this->db->fetchAll("SELECT * FROM tenants WHERE reseller_id=? ORDER BY created_at DESC", [$id]);
        $this->view('super_admin/resellers/show', ['pageTitle'=>$reseller['name'],'panelType'=>'admin','reseller'=>$reseller,'schools'=>$schools,'flash'=>$this->getFlash()]);
    }

    public function edit(string $id): void {
        $this->requireSuperAdmin();
        $reseller = $this->db->fetchOne("SELECT * FROM resellers WHERE id=?", [$id]);
        $this->view('super_admin/resellers/form', ['pageTitle'=>'Edit Reseller','panelType'=>'admin','reseller'=>$reseller,'flash'=>$this->getFlash()]);
    }

    public function update(string $id): void {
        $this->requireSuperAdmin();
        $this->db->execute("UPDATE resellers SET name=?,email=?,phone=?,domain=?,primary_color=?,secondary_color=?,status=?,commission_rate=? WHERE id=?", [
            $_POST['name'],trim($_POST['email']),trim($_POST['phone']??''),trim($_POST['domain']??'')?:null,
            $_POST['primary_color']??'#4F46E5',$_POST['secondary_color']??'#7C3AED',
            $_POST['status']??'pending',$_POST['commission_rate']??0,$id
        ]);
        $this->flash('success','Reseller updated.'); $this->redirect('/admin/resellers');
    }

    public function delete(string $id): void {
        $this->requireSuperAdmin();
        $this->db->execute("DELETE FROM resellers WHERE id=? AND slug!='platform'", [$id]);
        $this->flash('success','Reseller deleted.'); $this->redirect('/admin/resellers');
    }
}
