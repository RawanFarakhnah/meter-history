# Meter Histories Management System

A modern, responsive Laravel application for managing meter history data with bulk import capabilities and advanced search functionality.

## ✨ Features

- **CRUD Operations** - Full Create, Read, Update, Delete functionality
- **Excel/CSV Import** - Bulk import with validation and template download
- **Advanced Search** - Multi-criteria filtering with sortable tables
- **Modern UI** - Responsive Bootstrap 5 design with real-time notifications
- **RESTful API** - Clean MVC architecture with Eloquent ORM

## 🚀 Quick Start

### Prerequisites
- PHP 8.0+, Composer, MySQL, Node.js

### Installation
```bash
git clone https://github.com/yourusername/meter-histories-system.git
cd meter-histories-system

composer install
cp .env.example .env
php artisan key:generate

# Update .env with your database credentials
php artisan migrate

npm install && npm run build
php artisan serve
```

Visit `http://localhost:8000` to access the application.

## 📁 Project Structure
```
app/
├── Models/MeterHistory.php
├── Http/Controllers/MeterHistoryController.php
├── Imports/MeterHistoriesImport.php
database/
├── migrations/ (database schema)
resources/views/
├── meter_histories/ (Blade templates)
```

## 💡 Key Features

### Bulk Import
- Upload Excel/CSV files with validation
- Download sample template for correct formatting
- Option to overwrite existing records

### Advanced Search
- Filter by meter number, community, status, date
- Active filter tags with quick removal
- Sortable table columns

### Responsive Design
- Works on desktop, tablet, and mobile
- Modern card-based UI with Bootstrap 5
- Real-time success/error notifications

## 🔧 API Endpoints
- `GET/POST /meter-histories` - List/Create records
- `GET/PUT/DELETE /meter-histories/{id}` - Read/Update/Delete
- `POST /meter-histories/import` - Bulk import
- `GET /meter-histories/export-template` - Download template

## 🧪 Testing
```bash
php artisan test
```

##  Support

For any inquiries or feedback, feel free to reach out:
- Email: [rFarakhna@gmail.com](mailto:rFarakhna@gmail.com)

---

**Built with Laravel 9+ & Bootstrap 5**