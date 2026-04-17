# 🚀 EnigmaticAura - Professional Portfolio & Admin Dashboard

## What is EnigmaticAura?

EnigmaticAura is a modern, professional portfolio website built with **CodeIgniter 4** framework. It features:
- A beautiful, responsive landing page with dark/light mode toggle
- A comprehensive admin dashboard for content management
- RESTful API endpoints for dynamic interactions
- Secure authentication system with route protection

More information about CodeIgniter can be found at the [official site](https://codeigniter.com).

---

## ✨ Features

### 🌐 Public Landing Page
- Hero section with animated elements
- About, Skills, Projects, and Contact sections
- Dark/Light theme toggle with persistence
- Smooth scroll navigation
- AJAX contact form with toast notifications
- Mobile-first responsive design
- Accessibility improvements (ARIA labels, focus states)

### 🔐 Admin Dashboard (TailAdmin Architecture)
- **Dashboard Overview** - Analytics and stats cards
- **Project Management** - Full CRUD operations for projects
- **Skills Management** - Manage tech stack and skill levels
- **Content Editor** - Edit landing page content dynamically
- **Profile Management** - Update admin profile and logout
- Protected routes with `AuthFilter`

### 📡 API Endpoints
- `POST /api/contact/send` - Contact form submission
- `GET /api/projects/list` - Retrieve projects list
- `GET /api/skills/list` - Retrieve skills list
- `POST /api/theme/preference` - Save theme preference

---

## 🏗️ Project Structure

```
/workspace
├── app/
│   ├── Config/
│   │   ├── Routes.php          # Main routing configuration
│   │   └── Filters.php         # Auth filter registration
│   ├── Controllers/
│   │   ├── Admin/              # Admin panel controllers
│   │   │   ├── Dashboard.php
│   │   │   ├── ProjectController.php
│   │   │   ├── SkillController.php
│   │   │   ├── ContentController.php
│   │   │   └── AuthController.php
│   │   ├── Api/                # API endpoints
│   │   │   ├── ContactController.php
│   │   │   ├── ProjectController.php
│   │   │   ├── SkillController.php
│   │   │   └── ThemeController.php
│   │   ├── Auth/               # Authentication
│   │   │   ├── LoginController.php
│   │   │   └── ForgotPasswordController.php
│   │   ├── BaseController.php
│   │   ├── Home.php
│   │   └── Landing.php         # Main landing page controller
│   ├── Filters/
│   │   └── AuthFilter.php      # Route protection filter
│   ├── Models/                 # Database models (ready for implementation)
│   └── Views/
│       ├── auth/               # Login views
│       ├── dashboard/          # Admin dashboard views
│       ├── landing/            # Landing page views
│       ├── layouts/            # Template layouts
│       └── partials/           # Reusable components
├── public/
│   └── assets/
│       ├── css/style.css       # Tailwind CSS styles
│       └── js/app.js           # Frontend JavaScript
├── tests/                      # PHPUnit tests
├── .env                        # Environment configuration
├── composer.json               # PHP dependencies
└── package.json                # Node.js dependencies
```

---

## 🛠️ Server Requirements

PHP version **8.2 or higher** is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> - The end of life date for PHP 7.4 was November 28, 2022.
> - The end of life date for PHP 8.0 was November 26, 2023.
> - The end of life date for PHP 8.1 was December 31, 2025.
> - If you are still using below PHP 8.2, you should upgrade immediately.
> - The end of life date for PHP 8.2 will be December 31, 2026.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

---

## 📦 Installation

### 1. Clone or Download the Project

```bash
cd /workspace
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies (for asset compilation)
npm install
```

### 3. Environment Setup

```bash
# Copy environment file
cp env .env

# Edit .env with your settings
nano .env
```

**Required `.env` configurations:**

```env
# App Configuration
app.baseURL = 'http://localhost:8080/'

# Database (Optional - for production)
database.default.hostname = localhost
database.default.database = enigmatic_aura
database.default.username = root
database.default.password = your_password
database.default.DBDriver = MySQLi
```

### 4. Set Permissions

```bash
# Make directories writable
chmod -R 777 writable/
```

### 5. Start Development Server

```bash
php spark serve
```

Access the application at: **http://localhost:8080**

---

## 🔑 Demo Credentials

**Admin Login:**
- Email: `admin@example.com`
- Password: `admin123`

---

## 🧪 Testing

### Landing Page
- ✅ Hero section displays correctly
- ✅ Dark/light mode toggle works
- ✅ Smooth scroll to sections
- ✅ Contact form shows toast notifications
- ✅ Mobile responsive design

### Admin Panel
- ✅ Login with demo credentials
- ✅ Redirect to dashboard after login
- ✅ Stats cards display data
- ✅ Sidebar navigation works
- ✅ Logout redirects to login

### API Endpoints
- ✅ `GET /api/projects/list` returns JSON
- ✅ `GET /api/skills/list` returns JSON
- ✅ `POST /api/contact/send` accepts form data

---

## 🔒 Security Features

1. **CSRF Protection** - Enabled on sensitive routes
2. **XSS Prevention** - Using `esc()` for all user output
3. **Auth Filter** - Protects all `/admin` routes
4. **Input Validation** - Server-side validation in controllers
5. **Auto-routing Disabled** - Explicit route definitions only

---

## 🎨 Future Improvements

- [ ] Database Integration - Replace hardcoded data with Models
- [ ] Image Upload - Project thumbnails upload functionality
- [ ] Rich Text Editor - For content management
- [ ] Chart Integration - ApexCharts/Chart.js for analytics
- [ ] Real Authentication - Password hashing with `password_hash()`
- [ ] Role-based Access - Admin vs Editor permissions
- [ ] API Rate Limiting - Throttle filter for API endpoints
- [ ] Caching - Redis/Memcached for performance

---

## 📚 Documentation

- [CodeIgniter 4 User Guide](https://codeigniter.com/user_guide/)
- [TailAdmin Documentation](https://tailadmin.com/docs)
- [Tailwind CSS](https://tailwindcss.com/docs)

---

## 📄 License

This project is open-source and available under the MIT License.

---

## ✅ Current Status: READY FOR DEVELOPMENT

All critical issues have been resolved. The system now:
- ✅ Runs without syntax errors
- ✅ Complete routing structure
- ✅ Auth filter implemented
- ✅ Controllers organized by namespace
- ✅ API endpoints ready
- ✅ Accessibility improved
- ✅ Clean code practices applied

For detailed setup instructions, see [SETUP_GUIDE.md](./SETUP_GUIDE.md)
