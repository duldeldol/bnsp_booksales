<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Users
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@bookstore.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Merdeka No. 10, Jakarta Pusat',
        ]);

        $customer = User::create([
            'name' => 'Rian Pratama',
            'email' => 'user@bookstore.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'phone' => '089876543210',
            'address' => 'Jl. Sudirman No. 45, Bandung',
        ]);

        $customer2 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@bookstore.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'phone' => '081399887766',
            'address' => 'Jl. Gatot Subroto No. 88, Jakarta Pusat',
        ]);

        // 2. Categories
        $categories = [
            'teknologi' => Category::create([
                'name' => 'Teknologi & Komputer',
                'description' => 'Buku seputar pemrograman web, AI, data science, dan infrastruktur IT.',
            ]),
            'bisnis' => Category::create([
                'name' => 'Bisnis & Finansial',
                'description' => 'Panduan investasi, literasi keuangan, dan strategi pengembangan bisnis.',
            ]),
            'self_dev' => Category::create([
                'name' => 'Pengembangan Diri',
                'description' => 'Buku motivasi, produktivitas, manajemen kebiasaan, dan psikologi praktis.',
            ]),
            'fiksi' => Category::create([
                'name' => 'Fiksi & Sastra',
                'description' => 'Novel inspiratif, fiksi ilmiah, sastra klasik, dan antologi cerita.',
            ]),
            'sains' => Category::create([
                'name' => 'Sains & Pengetahuan',
                'description' => 'Eksplorasi alam semesta, biologi, sejarah peradaban, dan ilmu fisika.',
            ]),
        ];

        // 3. Books
        $books = [
            [
                'category_id' => $categories['teknologi']->id,
                'title' => 'Clean Code: A Handbook of Agile Software Craftsmanship',
                'author' => 'Robert C. Martin',
                'publisher' => 'Prentice Hall',
                'price' => 175000,
                'stock' => 15,
                'cover_image' => 'https://images.unsplash.com/photo-1532012164546-f432f2e3dd45?auto=format&fit=crop&w=600&q=80',
                'description' => 'Buku panduan utama bagi software engineer untuk menulis kode yang rapi, mudah dirawat, dan terhindar dari technical debt.',
            ],
            [
                'category_id' => $categories['teknologi']->id,
                'title' => 'Mastering Laravel 10 & Modern Web Development',
                'author' => 'Ahmad Fauzi & Tim',
                'publisher' => 'Informatika Press',
                'price' => 135000,
                'stock' => 20,
                'cover_image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=600&q=80',
                'description' => 'Tutorial lengkap dari nol membangun aplikasi web modern menggunakan framework Laravel 10, Blade, dan integrasi API.',
            ],
            [
                'category_id' => $categories['bisnis']->id,
                'title' => 'The Psychology of Money',
                'author' => 'Morgan Housel',
                'publisher' => 'Harriman House',
                'price' => 98000,
                'stock' => 25,
                'cover_image' => 'https://images.unsplash.com/photo-1553729459-efe14ef6055d?auto=format&fit=crop&w=600&q=80',
                'description' => 'Pelajaran abadi mengenai kekayaan, keserakahan, dan kebahagiaan serta bagaimana perilaku manusia memengaruhi finansial.',
            ],
            [
                'category_id' => $categories['bisnis']->id,
                'title' => 'Rich Dad Poor Dad',
                'author' => 'Robert T. Kiyosaki',
                'publisher' => 'Gramedia Pustaka',
                'price' => 88000,
                'stock' => 18,
                'cover_image' => 'https://images.unsplash.com/photo-1526304640581-d334cdbbf45e?auto=format&fit=crop&w=600&q=80',
                'description' => 'Buku dasar literasi keuangan yang mengajarkan apa yang diajarkan orang kaya kepada anak-anak mereka tentang uang.',
            ],
            [
                'category_id' => $categories['self_dev']->id,
                'title' => 'Atomic Habits: Perubahan Kecil yang Memberikan Hasil Luar Biasa',
                'author' => 'James Clear',
                'publisher' => 'Gramedia Pustaka Utama',
                'price' => 108000,
                'stock' => 30,
                'cover_image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=600&q=80',
                'description' => 'Cara praktis dan terbukti ilmiah membangun kebiasaan baik dan membuang kebiasaan buruk setiap hari.',
            ],
            [
                'category_id' => $categories['self_dev']->id,
                'title' => 'Filosofi Teras: Panduan Menghadapi Kecemasan Hidup',
                'author' => 'Henry Manampiring',
                'publisher' => 'Kompas Buku',
                'price' => 95000,
                'stock' => 22,
                'cover_image' => 'https://images.unsplash.com/photo-1506880018603-83d5b814b5a6?auto=format&fit=crop&w=600&q=80',
                'description' => 'Penerapan filsafat Stoisisme kuno untuk kesehatan mental, mengatasi overthinking, dan mengendalikan emosi negatif.',
            ],
            [
                'category_id' => $categories['fiksi']->id,
                'title' => 'Bumi Manusia',
                'author' => 'Pramoedya Ananta Toer',
                'publisher' => 'Lentera Dipantara',
                'price' => 125000,
                'stock' => 12,
                'cover_image' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=600&q=80',
                'description' => 'Mahakarya sastra Indonesia mengisahkan perjuangan Minke di era kolonial Hindia Belanda yang penuh intrik dan sejarah.',
            ],
            [
                'category_id' => $categories['fiksi']->id,
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'publisher' => 'Bentang Pustaka',
                'price' => 89000,
                'stock' => 14,
                'cover_image' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=600&q=80',
                'description' => 'Kisah inspiratif tentang sepuluh anak laskar pelangi yang menempuh pendidikan di desa terpencil pulau Belitung.',
            ],
            [
                'category_id' => $categories['sains']->id,
                'title' => 'Cosmos: Menjelajah Alam Semesta',
                'author' => 'Carl Sagan',
                'publisher' => 'Kepustakaan Populer Gramedia',
                'price' => 145000,
                'stock' => 10,
                'cover_image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=600&q=80',
                'description' => 'Eksplorasi puitis dan mendalam mengenai 15 miliar tahun evolusi kosmik, sains, peradaban manusia, dan masa depan.',
            ],
            [
                'category_id' => $categories['sains']->id,
                'title' => 'Sapiens: Riwayat Singkat Umat Manusia',
                'author' => 'Yuval Noah Harari',
                'publisher' => 'KPG Press',
                'price' => 135000,
                'stock' => 16,
                'cover_image' => 'https://images.unsplash.com/photo-1461360370896-922624d12aa1?auto=format&fit=crop&w=600&q=80',
                'description' => 'Membahas bagaimana sebuah spesies kera yang tidak signifikan kini berhasil menjadi penguasa planet Bumi.',
            ],
        ];

        foreach ($books as $b) {
            Book::create($b);
        }

        // 4. Sample Order untuk customer
        $sampleBook1 = Book::first();
        $sampleBook2 = Book::skip(1)->first();

        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'user_id' => $customer->id,
            'customer_name' => $customer->name,
            'customer_phone' => $customer->phone,
            'shipping_address' => $customer->address,
            'total_amount' => $sampleBook1->price + $sampleBook2->price,
            'status' => 'paid',
            'payment_method' => 'whatsapp',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'book_id' => $sampleBook1->id,
            'price' => $sampleBook1->price,
            'quantity' => 1,
            'subtotal' => $sampleBook1->price,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'book_id' => $sampleBook2->id,
            'price' => $sampleBook2->price,
            'quantity' => 1,
            'subtotal' => $sampleBook2->price,
        ]);

        // Sample Order 2 (Status: Pending / Menunggu Pembayaran, Metode: COD)
        $sampleBook3 = Book::skip(2)->first();
        if ($sampleBook3) {
            $order2 = Order::create([
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'user_id' => $customer2->id,
                'customer_name' => $customer2->name,
                'customer_phone' => $customer2->phone,
                'shipping_address' => $customer2->address,
                'total_amount' => $sampleBook3->price,
                'status' => 'pending',
                'payment_method' => 'cod',
            ]);

            OrderItem::create([
                'order_id' => $order2->id,
                'book_id' => $sampleBook3->id,
                'price' => $sampleBook3->price,
                'quantity' => 1,
                'subtotal' => $sampleBook3->price,
            ]);
        }

        // 5. Sample Contact Message
        Contact::create([
            'name' => 'Dewi Sartika',
            'email' => 'dewi@example.com',
            'subject' => 'Pertanyaan Ketersediaan Stok Buku',
            'message' => 'Halo Admin, apakah buku Clean Code tersedia untuk pemesanan dalam jumlah banyak (10 eksemplar)? Terima kasih.',
            'is_read' => false,
        ]);
    }
}
