<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 3 Buku Ikonik untuk 3 Arch Pedestals di Hero (Atomic Habits, Ikigai di tengah, The Psychology of Money)
        $heroBooks = Book::whereIn('id', [5, 6, 3])->orderByRaw("FIELD(id, 5, 6, 3)")->get();
        if ($heroBooks->count() < 3) {
            $heroBooks = Book::take(3)->get();
        }

        // 4 Buku Rekomendasi Pilihan Toko dengan Judul & Sampul Asli Terverifikasi
        $recommendedBooks = Book::with('category')->whereIn('id', [1, 4, 9, 10])->orderByRaw("FIELD(id, 1, 4, 9, 10)")->get();
        if ($recommendedBooks->count() < 4) {
            $recommendedBooks = Book::with('category')->whereNotIn('id', $heroBooks->pluck('id'))->take(4)->get();
        }

        // Daftar Kategori untuk Section Kategori Pilihan
        $categories = Category::withCount('books')->get();

        return view('home', compact('heroBooks', 'recommendedBooks', 'categories'));
    }

    public function catalog(Request $request)
    {
        $categories = Category::withCount('books')->get();

        $query = Book::with('category')->latest();

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('publisher', 'like', "%{$search}%");
            });
        }

        $books = $query->paginate(8)->withQueryString();

        return view('catalog', compact('books', 'categories'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'subject.required' => 'Subjek pesan wajib diisi.',
            'message.required' => 'Isi pesan tidak boleh kosong.',
        ]);

        Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'is_read' => false,
        ]);

        return redirect()->route('contact')
            ->with('success', 'Terima kasih! Pesan Anda telah berhasil dikirim ke Administrator kami.');
    }
}
