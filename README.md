# 🧺 Multi-Outlet Laundry Management System (Back-End API)

A robust, enterprise-grade RESTful API built with **Laravel 12**, **Laravel Sanctum**, and **Spatie Laravel Permission**.

This system is designed to support **multi-outlet laundry businesses**, providing secure authentication, outlet-based role management (Teams), inventory management, machine monitoring, order processing, payment handling, and customer management.

---

## ✨ Features

- 🔐 Laravel Sanctum Authentication
- 👥 Role & Permission Management (Spatie)
- 🏢 Multi-Outlet (Teams)
- 👤 Customer Management
- 📦 Laundry Order Management
- 💳 Payment Management
- 🧺 Laundry Service Management
- 🧴 Inventory Management
- ⚙️ Washing Machine Monitoring
- 📊 Dashboard Statistics
- 📝 Activity Logging
- 🚀 RESTful API Architecture
- 🧪 Request Validation
- 📄 API Resource Responses

---

# 🛠 Tech Stack

| Technology | Version |
|------------|----------|
| PHP | 8.2+ |
| Laravel | 12 |
| MySQL | 8+ |
| Composer | Latest |
| Laravel Sanctum | Latest |
| Spatie Laravel Permission | Latest |

---

# 🚀 Getting Started

## Prerequisites

Make sure you have installed:

- PHP 8.2 or later
- Composer
- MySQL 8+ or PostgreSQL
- Git

---

# 📦 Installation

## 1. Clone Repository

```bash
git clone https://github.com/rian0502/be-saklin.git
```

---

## 2. Go to Project Directory

```bash
cd be-saklin
```

---

## 3. Install Dependencies

```bash
composer install
```

---

## 4. Create Environment File

```bash
cp .env.example .env
```

---

## 5. Configure Environment

Open the `.env` file and update your database configuration.

```env
APP_NAME="Laundry API"

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laundry
DB_USERNAME=root
DB_PASSWORD=
```

---

## 6. Generate Application Key

```bash
php artisan key:generate
```

---

## 7. Run Database Migration

```bash
php artisan migrate
```

If your project includes seeders:

```bash
php artisan db:seed
```

Or run both together:

```bash
php artisan migrate --seed
```

---

## 8. Create Storage Link

```bash
php artisan storage:link
```

---

## 9. Start Development Server

```bash
php artisan serve
```

Your API will be available at

```
http://127.0.0.1:8000
```

---

# 🔐 Authentication

This project uses **Laravel Sanctum** for API authentication.

Login endpoint example:

```
POST /api/login
```

Protected routes require the following header:

```
Authorization: Bearer YOUR_ACCESS_TOKEN
```

---

# 📁 Project Structure

```
app
├── Actions
├── Enums
├── Exceptions
├── Helpers
├── Http
│   ├── Controllers
│   ├── Middleware
│   ├── Requests
│   └── Resources
├── Models
├── Providers
├── Repositories
├── Services
└── Traits
```

---

# ⚙️ Useful Artisan Commands

Generate application key

```bash
php artisan key:generate
```

Run migration

```bash
php artisan migrate
```

Run migration with seed

```bash
php artisan migrate --seed
```

Clear application cache

```bash
php artisan optimize:clear
```

Cache configuration

```bash
php artisan config:cache
```

Cache routes

```bash
php artisan route:cache
```

Cache events

```bash
php artisan event:cache
```

Cache views

```bash
php artisan view:cache
```

List all routes

```bash
php artisan route:list
```

---

# 🧪 Running Tests

```bash
php artisan test
```

---

# 📖 API Documentation

API documentation can be accessed after the documentation generator has been configured.

Example:

```
http://localhost:8000/docs
```

or

```
http://localhost:8000/api/documentation
```

---

# 📄 License

This project is licensed under the MIT License.

---

# 👨‍💻 Author

**Muhammad Febrian Hasibuan**

GitHub:
https://github.com/rian0502
