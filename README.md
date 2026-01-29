# 🚀 Laravel + PostgreSQL via Docker

Practical Test Stechoq

---

## 📦 Tech Stack

* Laravel 12
* PHP 8.3
* PostgreSQL 16
* Docker & Docker Compose

---

## ⚙️ Prasyarat

Pastikan di PC/laptop sudah terinstall:

* Docker
* Docker Compose

---

## 🚀 Quick Start & Setup

```bash
git clone <URL_REPOSITORY_GIT>

cd <folder-project>

#jalankan docker compose
docker compose up -d --build

#buat .env
copy .env.example menjadi .env

#Jalankan composer install & atur ownership
docker exec app composer install --no-interaction --prefer-dist
sudo chown -R 33:33 storage bootstrap/cache


#jalankan app key generate dan migrasi & seeder
docker exec app php artisan key:generate
docker exec app php artisan migrate --seed


#Done ✅
# Jalankan pada postman / Insomnia base url http://localhost:8001


```

---

## 📁 Struktur Folder

```
project-laravel/
├── app/
├── bootstrap/
├── config/
├── public/
├── storage/
├── docker-compose.yml
├── Dockerfile
├── .env
└── README.md
```

---

## 🗄️ Konfigurasi Database  di ENV

```env
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=stechoq_db
DB_USERNAME=stechoq_user
DB_PASSWORD=secret
```

> ⚠️ Jangan ganti `DB_HOST` menjadi `localhost`, Konfigurasi database di `.env` harus seperti ini sesuai dengan environment `docker-compose.yml`.

### Dummy User untuk Login (Seed)

- **Manager**: `manager1@example.com` / `password`
- **Manager**: `manager2@example.com` / `password`
- **Engineer**: `engineer1@example.com` / `password`
- **Engineer**: `engineer2@example.com` / `password`
- **Engineer**: `engineer3@example.com` / `password`
- **Engineer**: `engineer4@example.com` / `password`

---

## ❗ Troubleshooting

* **Database connection refused** → pastikan `DB_HOST=postgres`
* **Port 8001 bentrok** → ubah port di `docker-compose.yml`
* **Container mati setelah restart PC/laptop** → sudah di-handle dengan `restart: unless-stopped`
