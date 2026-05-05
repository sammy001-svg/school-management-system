<?php
require_once ROOT_DIR . '/core/Controller.php';

class AuthController extends Controller {
    
    public function loginPage(): void {
        if ($this->isLoggedIn()) {
            $this->redirectByRole();
        }

        // Load branding if domain is matched (simplified for now)
        $branding = [
            'name' => 'School Management System',
            'primary_color' => '#4F46E5',
            'secondary_color' => '#7C3AED',
            'logo' => null
        ];

        $this->view('auth/login', [
            'pageTitle' => 'Login',
            'branding' => $branding,
            'flash' => $this->getFlash()
        ]);
    }

    public function loginPost(): void {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (!$email || !$password) {
            $this->flash('danger', 'Please enter email and password.');
            $this->redirect('/login');
        }

        $user = $this->db->fetchOne(
            "SELECT u.*, r.name as role_name 
             FROM users u 
             JOIN roles r ON u.role_id = r.id 
             WHERE u.email = ? AND u.status = 'active'", 
            [$email]
        );

        if ($user && password_verify($password, $user['password_hash'])) {
            // Set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role_name'];
            $_SESSION['tenant_id'] = $user['tenant_id'];
            $_SESSION['reseller_id'] = $user['reseller_id'];
            $_SESSION['user_name']   = $user['name'];
            $_SESSION['user']        = $user;

            // Update last login
            $this->db->execute("UPDATE users SET last_login = NOW() WHERE id = ?", [$user['id']]);

            // Handle Branding for session if reseller/school
            if ($user['reseller_id']) {
                $reseller = $this->db->fetchOne("SELECT * FROM resellers WHERE id = ?", [$user['reseller_id']]);
                if ($reseller) {
                    $_SESSION['branding'] = [
                        'name' => $reseller['name'],
                        'primary_color' => $reseller['primary_color'],
                        'secondary_color' => $reseller['secondary_color'],
                        'logo' => $reseller['logo']
                    ];
                }
            }

            // Store institution type
            if ($user['tenant_id']) {
                $tenant = $this->db->fetchOne("SELECT institution_type FROM tenants WHERE id = ?", [$user['tenant_id']]);
                $_SESSION['institution_type'] = $tenant['institution_type'] ?? 'high_school';
            }

            // Store Student/Parent specific IDs
            if ($user['role_name'] === 'Student') {
                $student = $this->db->fetchOne("SELECT id, class_id FROM students WHERE user_id = ?", [$user['id']]);
                $_SESSION['student_id'] = $student['id'] ?? null;
                $_SESSION['class_id']   = $student['class_id'] ?? null;
            } elseif ($user['role_name'] === 'Parent') {
                $parent = $this->db->fetchOne("SELECT id FROM parents WHERE user_id = ?", [$user['id']]);
                $_SESSION['parent_id'] = $parent['id'] ?? null;
            }

            $this->redirectByRole();
        } else {
            $this->flash('danger', 'Invalid credentials or account inactive.');
            $this->redirect('/login');
        }
    }

    public function logout(): void {
        session_destroy();
        $this->redirect('/login');
    }

    private function redirectByRole(): void {
        $role = $_SESSION['role'] ?? '';
        
        switch ($role) {
            case 'Super Admin':
                $this->redirect('/admin/dashboard');
                break;
            case 'Reseller':
                $this->redirect('/reseller/dashboard');
                break;
            case 'School Admin':
            case 'Teacher':
            case 'Accountant':
            case 'Staff':
                $this->redirect('/school/dashboard');
                break;
            case 'Student':
                $this->redirect('/student/dashboard');
                break;
            case 'Parent':
                $this->redirect('/parent/dashboard');
                break;
            default:
                $this->redirect('/login');
                break;
        }
    }

    private function isLoggedIn(): bool {
        return isset($_SESSION['user_id']);
    }
}
