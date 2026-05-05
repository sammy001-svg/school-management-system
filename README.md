# SchoolMS - Professional School & University Management System

SchoolMS is a comprehensive, multi-tenant educational management platform designed to streamline administrative tasks, enhance academic tracking, and improve communication between schools, teachers, students, and parents.

## 🚀 Key Features

### 🏛️ Administration & Multi-Tenancy
- **Super Admin Dashboard**: Manage resellers, schools, subscription plans, and system-wide users.
- **Reseller Portal**: Branding customization, school management, and billing tracking.
- **School Management**: Full control over students, teachers, classes, and departments.

### 🎓 Academic Excellence
- **Attendance Tracking**: Easy-to-use interface for marking attendance and generating reports.
- **Grade Management**: Simplified grade entry and automated student progress reports.
- **Timetable Management**: Interactive scheduling for classes and teachers.
- **Analytics Suite**: Advanced academic analytics, student growth tracking, and attendance heatmaps.

### 🏢 University-Specific Modules
- **Program & Course Management**: Structure departments, academic programs, and specific courses.
- **Enrollment System**: Manage student enrollments into specific programs and units.

### 💰 Finance & HR
- **Financial Module**: Invoice generation, payment tracking, and financial reporting.
- **HR & Payroll**: Automated payroll generation and employee leave management.
- **Inventory & Library**: Track school assets and manage library book loans.

### 📱 Portals
- **Student Portal**: Access to personal timetables, grades, and learning materials.
- **Parent Portal**: Real-time updates on children's academic performance, attendance, and financial status.
- **Communication**: Internal messaging system, announcements, and bulk SMS capabilities.

## 🛠️ Technology Stack
- **Backend**: PHP (Custom MVC Framework)
- **Database**: MySQL
- **Frontend**: HTML5, Vanilla CSS, JavaScript
- **Deployment**: Optimized for standard cPanel/Shared Hosting environments.

## ⚙️ Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/YOUR_USERNAME/school-management-system.git
   ```

2. **Database Setup**:
   - Create a new MySQL database (e.g., `school_mgmt`).
   - Import the schema from `sql/schema.sql`.

3. **Configuration**:
   - Copy `config/database.php.example` to `config/database.php`.
   - Update the credentials in `config/database.php` to match your local setup.

4. **Web Server**:
   - Point your web server's document root to the `public/` directory.
   - Ensure `mod_rewrite` is enabled if using Apache.

## 🤝 Contributing
Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License
This project is licensed under the MIT License.
