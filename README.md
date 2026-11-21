# Demo Modul 4 - Laravel 12 API

Project API FlipPlay yang dikembangkan menggunakan Laravel 12. Project ini
memiliki data media dari Modul 3 serta fitur pengelolaan user dan media favorit.

## Teknologi

- Laravel 12
- PHP 8.2 atau lebih baru
- SQLite
- REST API
- Postman

## Cara Menjalankan

1. Masuk ke folder project:

```bash
cd demo-modul4
```

2. Install dependency:

```bash
composer install
```

3. Siapkan environment:

```bash
cp .env.example .env
php artisan key:generate
```

4. Jalankan migrasi dan seeder:

```bash
php artisan migrate:fresh --seed
```

5. Jalankan server:

```bash
php artisan serve
```

Server berjalan di `http://127.0.0.1:8000`.

## Endpoint Media

| Method | Endpoint | Fungsi |
|---|---|---|
| GET | `/api/media` | Menampilkan semua media |
| GET | `/api/media?search=Haik` | Mencari media berdasarkan judul |
| GET | `/api/media/{id}` | Menampilkan detail media |
| POST | `/api/media` | Menambahkan media |
| PATCH | `/api/media/{id}` | Mengubah media |
| DELETE | `/api/media/{id}` | Menghapus media |

Contoh body untuk menambahkan media:

```json
{
  "title": "Naruto",
  "description": "Perjalanan ninja untuk menjadi Hokage.",
  "genre": "Action, Adventure",
  "episodes": 220,
  "release_year": 2002,
  "type": "Anime"
}
```

## Endpoint User

| Method | Endpoint | Fungsi |
|---|---|---|
| GET | `/api/users` | Menampilkan semua user |
| GET | `/api/users?search=Ivan` | Mencari user |
| GET | `/api/users/{id}` | Menampilkan detail user |
| POST | `/api/users` | Menambahkan user |
| PATCH | `/api/users/{id}` | Mengubah user |
| DELETE | `/api/users/{id}` | Menghapus user |

Contoh body user:

```json
{
  "name": "Budi",
  "email": "budi@example.com"
}
```

## Endpoint Media Favorit

| Method | Endpoint | Fungsi |
|---|---|---|
| GET | `/api/users/{user_id}/favorites` | Menampilkan user beserta media favorit |
| POST | `/api/users/{user_id}/favorites/{media_id}` | Menambahkan media ke favorit |
| DELETE | `/api/users/{user_id}/favorites/{media_id}` | Menghapus media dari favorit |

Contoh:

```text
GET http://127.0.0.1:8000/api/users/1/favorites
POST http://127.0.0.1:8000/api/users/1/favorites/1
DELETE http://127.0.0.1:8000/api/users/1/favorites/1
```

## Lisensi

Project ini menggunakan lisensi MIT.
