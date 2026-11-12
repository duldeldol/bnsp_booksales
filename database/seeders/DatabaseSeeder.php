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
        $admin = User::firstOrCreate(['email' => 'admin@bookstore.com'], [
            'name' => 'Duul',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Merdeka No. 10, Jakarta Pusat',
        ]);

        $customer = User::firstOrCreate(['email' => 'user@bookstore.com'], [
            'name' => 'Budi Pratama',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'phone' => '089876543210',
            'address' => 'Jl. Sudirman No. 45, Bandung',
        ]);

        $customer2 = User::firstOrCreate(['email' => 'budi@bookstore.com'], [
            'name' => 'Budi Santoso',
            'password' => Hash::make('password123'),
            'role' => 'customer',
            'phone' => '081399887766',
            'address' => 'Jl. Gatot Subroto No. 88, Jakarta Pusat',
        ]);

        // 2. Categories
        $categories = [
            'teknologi' => Category::firstOrCreate(['name' => 'Teknologi & Komputer'], [
                'description' => 'Buku seputar pemrograman web, AI, data science, dan infrastruktur IT.',
            ]),
            'bisnis' => Category::firstOrCreate(['name' => 'Bisnis & Finansial'], [
                'description' => 'Panduan investasi, literasi keuangan, dan strategi pengembangan bisnis.',
            ]),
            'self_dev' => Category::firstOrCreate(['name' => 'Pengembangan Diri'], [
                'description' => 'Buku motivasi, produktivitas, manajemen kebiasaan, dan psikologi praktis.',
            ]),
            'fiksi' => Category::firstOrCreate(['name' => 'Fiksi & Sastra'], [
                'description' => 'Novel inspiratif, fiksi ilmiah, sastra klasik, dan antologi cerita.',
            ]),
            'sains' => Category::firstOrCreate(['name' => 'Sains & Pengetahuan'], [
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
                'cover_image' => 'https://covers.openlibrary.org/b/isbn/9780132350884-L.jpg',
                'description' => 'Buku panduan utama bagi software engineer untuk menulis kode yang rapi, mudah dirawat, dan terhindar dari technical debt.',
            ],
            [
                'category_id' => $categories['teknologi']->id,
                'title' => 'Clean Architecture: A Craftsman\'s Guide to Software Structure',
                'author' => 'Robert C. Martin',
                'publisher' => 'Prentice Hall',
                'price' => 185000,
                'stock' => 15,
                'cover_image' => 'https://covers.openlibrary.org/b/isbn/9780134494166-L.jpg',
                'description' => 'Panduan esensial mengenai arsitektur perangkat lunak, aturan desain sistem modular, dan pemisahan dependensi modern.',
            ],
            [
                'category_id' => $categories['bisnis']->id,
                'title' => 'The Psychology of Money',
                'author' => 'Morgan Housel',
                'publisher' => 'Harriman House',
                'price' => 98000,
                'stock' => 25,
                'cover_image' => 'https://covers.openlibrary.org/b/isbn/9780857197689-L.jpg',
                'description' => 'Pelajaran abadi mengenai kekayaan, keserakahan, dan kebahagiaan serta bagaimana perilaku manusia memengaruhi finansial.',
            ],
            [
                'category_id' => $categories['bisnis']->id,
                'title' => 'Rich Dad Poor Dad',
                'author' => 'Robert T. Kiyosaki',
                'publisher' => 'Gramedia Pustaka',
                'price' => 88000,
                'stock' => 18,
                'cover_image' => 'https://covers.openlibrary.org/b/isbn/9781612680194-L.jpg',
                'description' => 'Buku dasar literasi keuangan yang mengajarkan apa yang diajarkan orang kaya kepada anak-anak mereka tentang uang.',
            ],
            [
                'category_id' => $categories['self_dev']->id,
                'title' => 'Atomic Habits: Perubahan Kecil yang Memberikan Hasil Luar Biasa',
                'author' => 'James Clear',
                'publisher' => 'Gramedia Pustaka Utama',
                'price' => 108000,
                'stock' => 30,
                'cover_image' => 'https://covers.openlibrary.org/b/isbn/9780735211292-L.jpg',
                'description' => 'Cara praktis dan terbukti ilmiah membangun kebiasaan baik dan membuang kebiasaan buruk setiap hari.',
            ],
            [
                'category_id' => $categories['self_dev']->id,
                'title' => 'Ikigai: Rahasia Hidup Bahagia dan Panjang Umur Orang Jepang',
                'author' => 'Héctor García & Francesc Miralles',
                'publisher' => 'Penguin Life',
                'price' => 95000,
                'stock' => 22,
                'cover_image' => 'https://covers.openlibrary.org/b/isbn/9780143130727-L.jpg',
                'description' => 'Menemukan tujuan hidup, filosofi keseimbangan batin, dan rahasia umur panjang penduduk pulau Okinawa, Jepang.',
            ],
            [
                'category_id' => $categories['fiksi']->id,
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'publisher' => 'Scribner',
                'price' => 125000,
                'stock' => 12,
                'cover_image' => 'https://covers.openlibrary.org/b/isbn/9780743273565-L.jpg',
                'description' => 'Mahakarya sastra klasik yang mengisahkan kemewahan, obsesi, cinta, dan ilusi impian Amerika pada era Jazz Age.',
            ],
            [
                'category_id' => $categories['fiksi']->id,
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'publisher' => 'Harper Perennial',
                'price' => 89000,
                'stock' => 14,
                'cover_image' => 'https://covers.openlibrary.org/b/isbn/9780061120084-L.jpg',
                'description' => 'Novel pemenang Hadiah Pulitzer tentang keadilan, empati, dan moralitas melalui sudut pandang seorang anak bernama Scout.',
            ],
            [
                'category_id' => $categories['sains']->id,
                'title' => 'Cosmos: Menjelajah Alam Semesta',
                'author' => 'Carl Sagan',
                'publisher' => 'Kepustakaan Populer Gramedia',
                'price' => 145000,
                'stock' => 10,
                'cover_image' => 'https://covers.openlibrary.org/b/isbn/9780345331359-L.jpg',
                'description' => 'Eksplorasi puitis dan mendalam mengenai 15 miliar tahun evolusi kosmik, sains, peradaban manusia, dan masa depan.',
            ],
            [
                'category_id' => $categories['sains']->id,
                'title' => 'Sapiens: Riwayat Singkat Umat Manusia',
                'author' => 'Yuval Noah Harari',
                'publisher' => 'KPG Press',
                'price' => 135000,
                'stock' => 16,
                'cover_image' => 'https://covers.openlibrary.org/b/isbn/9780062316097-L.jpg',
                'description' => 'Membahas bagaimana sebuah spesies kera yang tidak signifikan kini berhasil menjadi penguasa planet Bumi.',
            ],
        ];

        foreach ($books as $b) {
            Book::updateOrCreate(
                ['title' => $b['title']],
                $b
            );
        }

        if (Order::count() === 0) {
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
        }

        // 4. Sample Contact Message
        if (Contact::count() === 0) {
            Contact::create([
                'name' => 'Dewi Sartika',
                'email' => 'dewi@example.com',
                'subject' => 'Pertanyaan Ketersediaan Stok Buku',
                'message' => 'Halo Admin, apakah buku Clean Code tersedia untuk pemesanan dalam jumlah banyak (10 eksemplar)? Terima kasih.',
                'is_read' => false,
            ]);
        }
    }
}
