# User Management API - Backend Test

API sederhana untuk manajemen pengguna yang dibuat menggunakan Laravel 12 dengan fitur CRUD lengkap.

## Fitur

- **Create** - Membuat pengguna baru
- **Read** - Mengambil daftar semua pengguna & detail pengguna
- **Update** - Memperbarui data pengguna berdasarkan ID
- **Delete** - Menghapus pengguna berdasarkan ID
- **Validasi Input** - Email format valid, nomor telepon minimal 10 digit angka
- **Error Handling** - Pesan error yang informatif dengan HTTP status code yang tepat
- **API Documentation** - Swagger/OpenAPI documentation
- **Docker Support** - Containerized deployment

## Data Pengguna

API mengelola data pengguna dengan field:
- **Nama** (string, required)
- **Email** (string, unique, required)
- **Nomor Telepon** (string, minimal 10 karakter angka, required)
- **Status Aktif** (boolean, default: true)
- **Department** (string, required)
- **Password** (string, minimal 8 karakter, required untuk create)

## Tech Stack

- **Framework**: Laravel 12
- **Database**: MySQL (default) / SQLite / PostgreSQL
- **Documentation**: L5-Swagger (OpenAPI 3.0)
- **Testing**: PHPUnit
- **Containerization**: Docker & Docker Compose

## Instalasi

### Cara 1: Manual Installation

```bash
# Clone repository
git clone <repository-url>
cd backend-test

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database (MySQL)
# Create database 'backend' in MySQL first

# Run migrations dan seeder
php artisan migrate --seed

# Generate API documentation
php artisan l5-swagger:generate

# Start development server
php artisan serve
```

### Cara 2: Docker Installation (Recommended)

```bash
# Clone repository
git clone <repository-url>
cd backend-test

# Build and run with Docker Compose
docker-compose up --build

# API akan tersedia di http://localhost:8000
```

## API Endpoints

### Base URL
```
http://localhost:8000/api
```

### Endpoints

| Method | Endpoint | Description | Status Codes |
|--------|----------|-------------|--------------|
| GET | `/users` | Mengambil semua pengguna | 200, 500 |
| POST | `/users` | Membuat pengguna baru | 201, 422, 500 |
| GET | `/users/{id}` | Mengambil detail pengguna | 200, 404, 500 |
| PUT | `/users/{id}` | Update pengguna | 200, 404, 422, 500 |
| DELETE | `/users/{id}` | Hapus pengguna | 200, 404, 500 |

## Contoh Penggunaan

### 1. Membuat Pengguna Baru (POST /api/users)
```bash
curl -X POST http://localhost:8000/api/users \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Wildan Miladji",
    "email": "wildan@example.com",
    "phone": "08123456789",
    "is_active": true,
    "department": "Backend Developer",
    "password": "password123"
  }'
```

**Response Success (201):**
```json
{
  "success": true,
  "message": "Pengguna berhasil dibuat",
  "data": {
    "id": 1,
    "name": "Wildan Miladji",
    "email": "wildan@example.com",
    "phone": "08123456789",
    "is_active": true,
    "department": "Backend Developer",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
  }
}
```

### 2. Mengambil Semua Pengguna (GET /api/users)
```bash
curl -X GET http://localhost:8000/api/users \
  -H "Accept: application/json"
```

### 3. Update Pengguna (PUT /api/users/1)
```bash
curl -X PUT http://localhost:8000/api/users/1 \
  -H "Content-Type: application/json" \
  -d '{"department": "Senior Backend Developer"}'
```

### 4. Hapus Pengguna (DELETE /api/users/1)
```bash
curl -X DELETE http://localhost:8000/api/users/1
```

## Error Responses

### Validation Error (422)
```json
{
  "message": "Nomor telepon minimal 10 karakter. (and 1 more error)",
  "errors": {
    "phone": ["Nomor telepon minimal 10 karakter."],
    "password": ["Password minimal 8 karakter."]
  }
}
```

### User Not Found (404)
```json
{
  "success": false,
  "message": "Pengguna tidak ditemukan",
  "error": "User dengan ID 999 tidak ditemukan"
}
```

### Server Error (500)
```json
{
  "success": false,
  "message": "Gagal mengambil data pengguna",
  "error": "Database connection failed"
}
```

## API Documentation

Setelah aplikasi berjalan, akses dokumentasi API di:
```
http://localhost:8000/api/documentation
```

Dokumentasi menggunakan Swagger UI dengan OpenAPI 3.0 specification yang mencakup:
- Request/Response schemas lengkap
- Example values untuk setiap field
- Error response examples
- Try it out functionality

## Validasi Input

- **Email**: Harus format email valid dan unique
- **Phone**: Minimal 10 karakter, hanya boleh angka
- **Name**: Required, maksimal 255 karakter
- **Department**: Required, maksimal 255 karakter
- **Password**: Minimal 8 karakter (untuk create)
- **is_active**: Boolean, default: true

## Testing

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=UserApiTest

# Test results: 6 passed (61 assertions)
```

Test coverage mencakup:
- Get all users
- Create user dengan validasi
- Show user by ID
- Update user
- Delete user
- Validation error handling

## Deployment

### Railway/Render/Vercel
1. Push code ke GitHub repository
2. Connect repository ke platform deployment
3. Set environment variables:
   ```
   APP_ENV=production
   APP_DEBUG=false
   APP_KEY=base64:your-app-key
   DB_CONNECTION=mysql
   DB_HOST=your-mysql-host
   DB_DATABASE=backend
   DB_USERNAME=your-username
   DB_PASSWORD=your-password
   ```
4. Deploy

## Project Structure

```
backend-test/
├── app/Http/Controllers/Api/UserController.php  # API Controller
├── app/Http/Requests/                           # Validation Rules
│   ├── StoreUserRequest.php
│   └── UpdateUserRequest.php
├── app/Models/User.php                          # User Model
├── database/migrations/                         # Database Schema
├── database/seeders/                            # Sample Data
├── routes/api.php                              # API Routes
├── tests/Feature/UserApiTest.php               # API Tests
├── docker-compose.yml                          # Docker Config
├── Dockerfile                                  # Docker Image
└── README.md                                   # Documentation
```

## Notes

- Database menggunakan MySQL secara default untuk production-ready setup
- Password di-hash menggunakan bcrypt
- API menggunakan JSON response format yang konsisten
- Error handling comprehensive dengan pesan informatif dalam Bahasa Indonesia
- CORS enabled untuk frontend integration
- Semua endpoint sudah ditest dan berfungsi dengan baik

---

**Dibuat untuk Backend Skill Test**

**Developer:** Wildan Miladji  
**Tech Stack:** Laravel 12 + MySQL + Docker + Swagger