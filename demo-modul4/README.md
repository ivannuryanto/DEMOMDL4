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

Setiap item pada `GET /api/media` dan `GET /api/media/{id}` sekarang menyertakan
field `favorited_by`, yaitu daftar user yang menambahkan media tersebut ke favorit.

Contoh respons:

```json
{
  "id": 1,
  "title": "Frieren: Beyond Journey’s End",
  "favorited_by": [
    {
      "id": 1,
      "name": "Ivan",
      "email": "ivan@example.com"
    }
  ]
}
```

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

Setiap item pada `GET /api/users` dan `GET /api/users/{id}` menyertakan field
`favorites`, yaitu daftar media yang ditambahkan user tersebut ke favorit.

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
| GET | `/api/users/{user_id}/collections` | Menampilkan user beserta koleksi media |
| POST | `/api/users/{user_id}/collections/{media_id}` | Menambahkan media ke koleksi |
| DELETE | `/api/users/{user_id}/collections/{media_id}` | Menghapus media dari koleksi |

Contoh:

```text
GET http://127.0.0.1:8000/api/users/1/collections
POST http://127.0.0.1:8000/api/users/1/collections/1
DELETE http://127.0.0.1:8000/api/users/1/collections/1
```

## Lisensi

Project ini menggunakan lisensi MIT.
