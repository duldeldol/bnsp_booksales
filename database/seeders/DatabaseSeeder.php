<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin Utama (Duul)
        User::firstOrCreate(['email' => 'admin@bookstore.com'], [
            'name' => 'Duul',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Merdeka No. 10, Jakarta Pusat',
        ]);

        // 2. Kategori Buku Indonesia
        $categories = [
            'sastra_sejarah' => Category::firstOrCreate(['name' => 'Sastra & Fiksi Sejarah'], [
                'description' => 'Novel berlatar peristiwa bersejarah, memoar perjuangan, dan roman peradaban Nusantara.',
            ]),
            'sastra_novel' => Category::firstOrCreate(['name' => 'Sastra & Novel Indonesia'], [
                'description' => 'Karya fiksi sastra modern, novel realisme magis, dan cerita pendek karya sastrawan Indonesia.',
            ]),
            'filsafat_diri' => Category::firstOrCreate(['name' => 'Filsafat & Pengembangan Diri'], [
                'description' => 'Renungan filsafat kehidupan, panduan kesehatan mental, dan pengenalan batin yang membumi.',
            ]),
            'sosial_politik' => Category::firstOrCreate(['name' => 'Pemikiran & Sosial Politik'], [
                'description' => 'Kajian pemikiran kritis, catatan aktivisme, dinamika sosial, dan esai kebangsaan Indonesia.',
            ]),
            'puisi_antologi' => Category::firstOrCreate(['name' => 'Sastra & Antologi Puisi'], [
                'description' => 'Kumpulan bait puisi reflektif, sajak kontemplatif, dan antologi literasi puitis Nusantara.',
            ]),
        ];

        // 3. 16 Buku Pilihan Indonesia Berkualitas
        $books = [
            [
                'category_id' => $categories['sastra_sejarah']->id,
                'title' => 'Laut Bercerita',
                'author' => 'Leila S. Chudori',
                'publisher' => 'Kepustakaan Populer Gramedia',
                'price' => 115000,
                'stock' => 20,
                'cover_image' => 'images/covers/laut-bercerita.jpg',
                'description' => 'Menelusuri kepedihan dan keteguhan keluarga korban penghilangan paksa aktivis mahasiswa era Reformasi 1998 yang tenggelam di dasar laut namun suaranya tak pernah padam.',
            ],
            [
                'category_id' => $categories['sastra_sejarah']->id,
                'title' => 'Bumi Manusia',
                'author' => 'Pramoedya Ananta Toer',
                'publisher' => 'Lentera Dipantara',
                'price' => 135000,
                'stock' => 22,
                'cover_image' => 'images/covers/bumi-manusia.jpg',
                'description' => 'Kisah kebangkitan kesadaran nasional Minke di tengah pergulatan feodalisme Jawa dan kekuasaan hukum kolonial Hindia Belanda awal abad ke-20.',
            ],
            [
                'category_id' => $categories['sastra_sejarah']->id,
                'title' => 'Burung-Burung Manyar',
                'author' => 'Y.B. Mangunwijaya',
                'publisher' => 'Penerbit Buku Kompas',
                'price' => 95000,
                'stock' => 18,
                'cover_image' => 'images/covers/burung-burung-manyar.jpg',
                'description' => 'Roman berlatar revolusi kemerdekaan Indonesia yang menelusuri pergulatan batin Setadewa dan Larasati di antara cinta, ideologi, dan humanisme sejati.',
            ],
            [
                'category_id' => $categories['sastra_sejarah']->id,
                'title' => 'Gadis Kretek',
                'author' => 'Ratih Kumala',
                'publisher' => 'Gramedia Pustaka Utama',
                'price' => 95000,
                'stock' => 19,
                'cover_image' => 'images/covers/gadis-kretek.jpg',
                'description' => 'Menelusuri jejak cinta Jeng Yah dan racikan saus kretek legendaris di tanah Jawa yang menyatukan romansa, bisnis tembakau, dan rahasia keluarga.',
            ],
            [
                'category_id' => $categories['sastra_sejarah']->id,
                'title' => 'Namaku Alam',
                'author' => 'Leila S. Chudori',
                'publisher' => 'Kepustakaan Populer Gramedia',
                'price' => 120000,
                'stock' => 20,
                'cover_image' => 'images/covers/namaku-alam.jpg',
                'description' => 'Menelusuri pergulatan batin Segara Alam yang tumbuh besar dengan memori fotografis dan stigma anak eks-tapol peristiwa 1965, berjuang menegakkan martabat diri di tengah penghakiman sosial.',
            ],
            [
                'category_id' => $categories['sastra_novel']->id,
                'title' => 'Orang-Orang Bloomington',
                'author' => 'Budi Darma',
                'publisher' => 'Noura Books',
                'price' => 88000,
                'stock' => 15,
                'cover_image' => 'images/covers/orang-orang-bloomington.jpg',
                'description' => 'Kumpulan kisah psikologis yang membedah keterasingan, prasangka, dan kesepian jiwa manusia di sebuah kota kecil di Indiana, Amerika Serikat.',
            ],
            [
                'category_id' => $categories['sastra_novel']->id,
                'title' => 'Cantik Itu Luka',
                'author' => 'Eka Kurniawan',
                'publisher' => 'Gramedia Pustaka Utama',
                'price' => 110000,
                'stock' => 16,
                'cover_image' => 'images/covers/cantik-itu-luka.jpg',
                'description' => 'Kisah epik berbalut realisme magis di Halimunda yang merajut tragedi kolonialisme, kutukan kecantikan, dan sejarah kelam Nusantara.',
            ],
            [
                'category_id' => $categories['sastra_novel']->id,
                'title' => 'Saman',
                'author' => 'Ayu Utami',
                'publisher' => 'Kepustakaan Populer Gramedia',
                'price' => 85000,
                'stock' => 15,
                'cover_image' => 'images/covers/saman.jpg',
                'description' => 'Karya pendobrak sastra Indonesia modern yang mengangkat kebebasan perempuan, pergolakan batin seorang pastor, dan aktivisme perkebunan karet.',
            ],
            [
                'category_id' => $categories['sastra_novel']->id,
                'title' => 'Ronggeng Dukuh Paruk',
                'author' => 'Ahmad Tohari',
                'publisher' => 'Gramedia Pustaka Utama',
                'price' => 105000,
                'stock' => 17,
                'cover_image' => 'images/covers/ronggeng-dukuh-paruk.jpg',
                'description' => 'Kisah menggetarkan tentang Srintil, penari ronggeng di pedukuhan terpencil yang nasibnya terseret pusaran tragis pergolakan politik 1965.',
            ],
            [
                'category_id' => $categories['sastra_novel']->id,
                'title' => 'Khotbah di Atas Bukit',
                'author' => 'Kuntowijoyo',
                'publisher' => 'Bentang Pustaka',
                'price' => 82000,
                'stock' => 16,
                'cover_image' => 'images/covers/khotbah-di-atas-bukit.jpg',
                'description' => 'Novel eksistensial mistik tentang pencarian makna hidup sejati di atas bukit sunyi setelah pensiun dari keduniawian.',
            ],
            [
                'category_id' => $categories['sastra_novel']->id,
                'title' => 'Seporsi Mie Ayam Sebelum Mati',
                'author' => 'Brian Khrisna',
                'publisher' => 'Grasindo',
                'price' => 88000,
                'stock' => 20,
                'cover_image' => 'images/covers/seporsi-mie-ayam-sebelum-mati.jpg',
                'description' => 'Kisah tentang Ale yang berencana mengakhiri hidupnya namun memutuskan menyantap semangkuk mie ayam terenak untuk terakhir kalinya, membuka perjalanan hangat tentang luka batin, harapan, dan arti melanjutkan hidup.',
            ],
            [
                'category_id' => $categories['filsafat_diri']->id,
                'title' => 'Filosofi Teras',
                'author' => 'Henry Manampiring',
                'publisher' => 'Penerbit Buku Kompas',
                'price' => 98000,
                'stock' => 25,
                'cover_image' => 'images/covers/filosofi-teras.jpg',
                'description' => 'Panduan praktis filsafat Stoisisme kuno yang disesuaikan secara membumi untuk mengatasi kecemasan dan overthinking generasi masa kini.',
            ],
            [
                'category_id' => $categories['sosial_politik']->id,
                'title' => 'Madilog: Materialisme, Dialektika, dan Logika',
                'author' => 'Tan Malaka',
                'publisher' => 'Narasi',
                'price' => 120000,
                'stock' => 14,
                'cover_image' => 'images/covers/madilog.jpg',
                'description' => 'Mahakarya pemikiran Tan Malaka yang mengajak bangsa Indonesia membebaskan akal budi dari kungkungan tahayul menuju cara berpikir rasional dan ilmiah.',
            ],
            [
                'category_id' => $categories['sosial_politik']->id,
                'title' => 'Catatan Seorang Demonstran',
                'author' => 'Soe Hok Gie',
                'publisher' => 'LP3ES',
                'price' => 92000,
                'stock' => 20,
                'cover_image' => 'images/covers/catatan-seorang-demonstran.jpg',
                'description' => 'Buku harian jujur seorang pemuda idealis tentang integritas nurani, kecintaan pada alam, serta kegelisahan atas keadilan sosial.',
            ],
            [
                'category_id' => $categories['puisi_antologi']->id,
                'title' => 'Melihat Api Bekerja',
                'author' => 'M. Aan Mansyur',
                'publisher' => 'Gramedia Pustaka Utama',
                'price' => 78000,
                'stock' => 15,
                'cover_image' => 'images/covers/melihat-api-bekerja.jpg',
                'description' => 'Antologi puisi puitis dan reflektif yang merekam kehilangan, rindu, dan kobaran api emosi manusia urban dalam bait-bait bernas.',
            ],
            [
                'category_id' => $categories['puisi_antologi']->id,
                'title' => 'Hujan Bulan Juni: Sepilihan Puisi',
                'author' => 'Sapardi Djoko Damono',
                'publisher' => 'Gramedia Pustaka Utama',
                'price' => 75000,
                'stock' => 20,
                'cover_image' => 'images/covers/hujan-bulan-juni.jpg',
                'description' => 'Kumpulan sajak magis dan liris Sapardi Djoko Damono tentang ketabahan, kearifan, dan kerinduan cinta yang tak terucapkan kepada pohon berbunga.',
            ],
        ];

        foreach ($books as $b) {
            Book::updateOrCreate(
                ['title' => $b['title']],
                $b
            );
        }
    }
}
