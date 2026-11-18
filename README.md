# 📚 BookStore — Curated Online Bookstore Web Application

> **Proyek Uji Kompetensi Keahlian (UKK) / Sertifikasi BNSP**  
> **Skema Sertifikasi**: Junior Web Developer (JWD)  
> **Pengembang**: Haydar Ali Ayyubi  
> **Repositori Resmi**: [github.com/duldeldol/bnsp_booksales](https://github.com/duldeldol/bnsp_booksales)

---

## 🌟 Ringkasan Proyek

**BookStore** adalah platform *e-commerce* toko buku terkurasi berbasis web yang memadukan estetika visual hangat (*Warm Editorial / Paper Haven*) dengan ketangguhan sistem transaksi *backend* berbasis transaksi database atomik (`DB::transaction`).

Aplikasi ini dibangun untuk mengatasi kendala toko buku fisik konvensional, seperti pencatatan manual yang rentan memicu selisih stok fisik (*overselling*), serta menghadirkan pengalaman belanja buku sastra dan literatur Indonesia yang nyaman, cepat, dan transparan.

---

## 🛠️ Tech Stack & Arsitektur

| Komponen | Teknologi | Keterangan |
| :--- | :--- | :--- |
| **Framework Backend** | **Laravel 10.x** (PHP 8.2+) | Arsitektur MVC murni berstandar PSR-4 |
| **Basis Data** | **MySQL 8.x** | Storage Engine **InnoDB** (ACID Transactions & Cascade FK) |
| **Frontend & UI** | **Blade Templating & Bootstrap 5.3** | Custom Styling *Warm Editorial*, Bootstrap Icons |
| **Keamanan** | **Bcrypt, CSRF Token, PDO Prepared Statements** | Silent Authentication & Role-based Authorization |
| **Version Control** | **Git & GitHub** | Riwayat commit aktif dan terstruktur |

---

## ✨ Fitur Utama Sistem

### 1. Etalase Publik & Pengalaman Belanja (Role: Customer)
- **Hero Section 3D Spotlight Arch Slider**: Menampilkan kurasi buku unggulan (*Bumi Manusia*, *Laut Bercerita*, *Filosofi Teras*) dengan animasi taktil yang nyaman.
- **Katalog Koleksi Buku & Live Filter**: Pencarian instan berdasarkan judul, penulis, atau penerbit, serta barisan pil filter kategori eksklusif sekali klik tanpa reload berlebih.
- **Keranjang Belanja Interaktif (Shopping Cart)**: Perhitungan subtotal otomatis, kontrol kuantitas stepper, dan badge notifikasi dinamis pada bilah navigasi.
- **Checkout Adaptif (COD & WhatsApp)**:
  - **Bayar di Tempat (COD)**: Pembayaran tunai saat kurir tiba.
  - **Transfer Bank via WhatsApp**: Terintegrasi tombol konfirmasi otomatis ke WhatsApp CS resmi (`+62 851-7335-0405`) lengkap dengan pesan terformat.
- **Faktur Nota Pesanan Resmi (Receipt-Style)**: Terbit otomatis dengan nomor unik (`ORD-XXXXXXXX`), rincian pesanan, dan tombol siap cetak fisik atau simpan format PDF.
- **Formulir Hubungi Kami & Tentang Kami**: Sarana aspirasi dan komunikasi pengunjung langsung ke kotak masuk admin.
- **Desain Responsif & Mobile Dock Bar**: Navigasi bawah melayang (*floating bottom dock*) yang ergonomis untuk pengguna smartphone.

---

### 2. Pusat Kendali Administrasi (Role: Administrator)
- **Overview Dashboard & Ringkasan Operasional**: Metrik real-time total judul buku terdaftar, total pesanan, omzet penjualan toko, dan pemantauan pesan masuk baru.
- **Manajemen Katalog Data Buku (CRUD Buku)**: Tambah, edit, dan hapus koleksi buku lengkap dengan unggah sampul buku asli ke storage lokal.
- **Manajemen Kategori Buku (CRUD Kategori)**: Pengelompokan taksonomi buku dengan proteksi integritas relasi *Cascade on Delete*.
- **Manajemen & Verifikasi Pesanan Pelanggan**: Pemantauan transaksi masuk dan pembaruan status pesanan (*Pending, Processing, Completed, Cancelled*).
- **Kotak Masuk Pesan Pelanggan (Contact Us Inbox)**: Membaca pesan masuk dengan fitur otomatis penandaan sudah dibaca (*auto-mark read*), balas via email, dan hapus pesan.
- **Daftar Pengguna Terdaftar**: Pemantauan akun pelanggan aktif dan administrator.

---

## 🔒 Fitur Krusial: Transaksi Database Atomik (`DB::transaction`)

Aplikasi menerapkan integritas data tingkat tinggi pada proses pemesanan (`CheckoutController.php`):

```php
$order = DB::transaction(function () use ($request, $cartItems) {
    // 1. Validasi ketersediaan stok fisik riil
    foreach ($cartItems as $item) {
        if ($item->quantity > $item->book->stock) {
            throw new \Exception("Stok buku '{$item->book->title}' tidak mencukupi.");
        }
    }

    // 2. Generate nomor pesanan unik (ORD-XXXXXXXX)
    do {
        $orderNumber = 'ORD-' . strtoupper(Str::random(8));
    } while (Order::where('order_number', $orderNumber)->exists());

    // 3. Buat master pesanan (Order)
    $order = Order::create([...]);

    // 4. Salin item & potong stok buku secara atomik
    foreach ($cartItems as $item) {
        OrderItem::create([...]);
        $item->book->decrement('stock', $item->quantity);
    }

    // 5. Bersihkan keranjang belanja
    Cart::where('user_id', auth()->id())->delete();

    return $order;
});
```

> **Manfaat Teknis**: Menjamin prinsip **ACID**. Jika terjadi gangguan koneksi atau stok habis di tengah proses, seluruh perubahan database otomatis di-*rollback* penuh sehingga tidak terjadi data pesanan gantung atau selisih stok (*overselling*).

---

## 🗄️ Skema Database (7 Tabel Inti)

Struktur tabel database ternormalisasi (3NF) pada basis data `db_bookstore_bnsp`:

```
                  ┌──────────────┐
                  │   contacts   │ (Pesan Kontak Pengunjung)
                  └──────────────┘

┌──────────────┐                  ┌──────────────┐
│  categories  │                  │    orders    │ (Master Faktur Pesanan)
└──────┬───────┘                  └──────▲───────┘
       │ (1:M)                           │ (1:M)
┌──────▼───────┐   ┌──────────────┐      │
│    books     ├──>│    carts     │      │
└──────┬───────┘   └──────────────┘      │
       │ (1:M)            ▲              │
       │                  │ (1:M)        │
       ▼                  │              │
┌──────────────┐          │       ┌──────┴───────┐
│ order_items  ├──────────┴───────┤    users     │ (Kredensial & Role)
└──────────────┘                  └──────────────┘
```

1. **`users`**: Menyimpan kredensial pengguna, profil, nomor telepon, alamat, dan role (`admin` / `customer`).
2. **`categories`**: Taksonomi genre buku sastra, fiksi sejarah, filsafat, sosial politik, dan puisi.
3. **`books`**: Master katalog buku (judul, penulis, penerbit, harga, stok fisik, cover image, category_id).
4. **`carts`**: Keranjang belanja aktif pelanggan (`user_id`, `book_id`, `quantity`).
5. **`orders`**: Faktur induk pesanan (`order_number`, `user_id`, data penerima, total_amount, payment_method, status).
6. **`order_items`**: Rincian buku dalam transaksi (`order_id`, `book_id`, `quantity`, `price`, `subtotal`).
7. **`contacts`**: Kotak masuk saran dan pertanyaan pembaca (`name`, `email`, `subject`, `message`, `is_read`).

---

## 🚀 Panduan Instalasi Lokal (Setup Guide)

Ikuti langkah-langkah berikut untuk menjalankan aplikasi di komputer lokal:

### 1. Prasyarat Sistem
- PHP >= 8.2 (dengan ekstensi `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`)
- Composer >= 2.x
- MySQL >= 8.x / MariaDB (via XAMPP atau Laragon)
- Git

### 2. Kloning Repositori & Instal Dependensi
```bash
# 1. Kloning repositori
git clone https://github.com/duldeldol/bnsp_booksales.git
cd bnsp_booksales

# 2. Instal dependensi PHP via Composer
composer install
```

### 3. Konfigurasi Environment (`.env`)
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
php artisan key:generate
```

Buka file `.env` dan sesuaikan koneksi database MySQL Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_bookstore_bnsp
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrasi & Seeder Database
Pastikan MySQL di XAMPP / Laragon sudah berjalan, lalu buat database dan jalankan seeder:
```bash
# Buat database jika belum ada, lalu jalankan migrasi & data dummy 16 buku sastra lokal
php artisan migrate:fresh --seed

# Hubungkan symlink storage untuk upload sampul buku
php artisan storage:link
```

### 5. Jalankan Web Server
```bash
php artisan serve
```
Akses aplikasi melalui browser di: **`http://127.0.0.1:8000`**

---

## 🔑 Akun Uji Coba Bawaan (Default Test Credentials)

Untuk keperluan pengujian dan demonstrasi oleh Asesor:

| Peran (Role) | Email | Password | Akses Halaman |
| :--- | :--- | :--- | :--- |
| **Administrator** | `admin@bookstore.com` | `password123` | Akses penuh: `/admin/dashboard`, kelola buku, pesanan, dsb. |
| **Customer** | Registrasi Akun Baru | *(Sesuai registrasi)* | Belanja buku, keranjang, checkout, dan nota pesanan. |

---

## 📁 Struktur Direktori Proyek

```
bnsp/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/                  # Controller operasional admin (Books, Orders, Dashboard, dll)
│   │   │   ├── Auth/                   # Autentikasi senyap (Login, Register, Logout)
│   │   │   ├── CartController.php      # Manajemen keranjang belanja
│   │   │   ├── CheckoutController.php  # Transaksi atomik & nota pesanan
│   │   │   └── HomeController.php      # Storefront, katalog buku & kontak
│   │   └── Middleware/
│   │       └── AdminMiddleware.php     # Proteksi rute khusus administrator
│   └── Models/                         # Eloquent Models (Book, Order, User, dll)
├── database/
│   ├── migrations/                     # 10 Skema migrasi DDL database terstruktur
│   └── seeders/                        # Inisialisasi 16 buku sastra Indonesia & akun admin
├── public/
│   ├── images/                         # Aset sampul buku sastra lokal & visual
│   └── index.php                       # Entry point aplikasi web
├── resources/
│   └── views/
│       ├── admin/                      # Blade view dashboard & manajemen data admin
│       ├── auth/                       # Formulir login & register
│       ├── checkout/                   # Formulir checkout pengiriman & pembayaran
│       ├── layouts/                    # Layout induk (app.blade.php & admin.blade.php)
│       ├── orders/                     # Faktur nota sukses & riwayat pesanan
│       ├── catalog.blade.php           # Tampilan grid katalog & filter buku
│       └── home.blade.php              # Beranda & 3D spotlight arch carousel
└── routes/
    └── web.php                         # Pemetaan 41 rute web terpusat
```

---

## 📜 Lisensi & Integritas Akademik

Proyek ini dikembangkan secara independen oleh **Haydar Ali Ayyubi** untuk memenuhi seluruh kriteria unjuk kerja pada instrumen **Materi Uji Kompetensi (MUK) BNSP Skema Junior Web Developer (JWD)**.

*Hak Cipta © 2026 Haydar Ali Ayyubi. Didistribusikan di bawah Lisensi MIT.*
