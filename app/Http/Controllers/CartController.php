<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with(['book.category'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->subtotal;
        });

        return view('cart.index', compact('cartItems', 'subtotal'));
    }

    public function add(Request $request, $bookId)
    {
        if (!auth()->check()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'redirect' => route('login'),
                    'message' => 'Silakan masuk akun terlebih dahulu untuk berbelanja.'
                ], 401);
            }
            return redirect()->route('login')->with('error', 'Silakan masuk akun terlebih dahulu untuk menambahkan buku ke keranjang belanja.');
        }

        $book = Book::findOrFail($bookId);

        if ($book->stock <= 0) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Maaf, stok buku "' . $book->title . '" saat ini sedang habis.'
                ], 400);
            }
            return back()->with('error', 'Maaf, stok buku "' . $book->title . '" saat ini sedang habis.');
        }

        $request->validate([
            'quantity' => 'nullable|integer|min:1',
        ]);

        $quantity = (int) $request->input('quantity', 1);

        $cart = Cart::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->first();

        if ($cart) {
            $newQuantity = $cart->quantity + $quantity;

            if ($newQuantity > $book->stock) {
                $newQuantity = $book->stock;
            }

            $cart->update(['quantity' => $newQuantity]);
        } else {
            $quantity = min($quantity, $book->stock);

            Cart::create([
                'user_id' => auth()->id(),
                'book_id' => $book->id,
                'quantity' => $quantity,
            ]);
        }

        $totalCartCount = (int) Cart::where('user_id', auth()->id())->sum('quantity');

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'cart_count' => $totalCartCount,
                'book_title' => $book->title,
            ]);
        }

        return back();
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::with('book')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        $action = $request->input('action');

        if ($action === 'increase') {
            if ($cart->quantity < $cart->book->stock) {
                $cart->increment('quantity');
                return back();
            }
            return back()->with('error', 'Kuantitas telah mencapai batas stok yang tersedia (' . $cart->book->stock . ' pcs).');
        } elseif ($action === 'decrease') {
            if ($cart->quantity > 1) {
                $cart->decrement('quantity');
                return back();
            }
            $cart->delete();
            return back();
        } elseif ($action === 'set') {
            $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);

            $qty = (int) $request->quantity;
            if ($qty > $cart->book->stock) {
                $qty = $cart->book->stock;
            }

            $cart->update(['quantity' => $qty]);
            return back();
        }

        return back();
    }

    public function destroy($id)
    {
        $cart = Cart::where('user_id', auth()->id())->findOrFail($id);
        $cart->delete();

        return back();
    }

    public function clear()
    {
        Cart::where('user_id', auth()->id())->delete();

        return back();
    }
}
