<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with(['book.category'])
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda masih kosong. Silakan pilih buku terlebih dahulu.');
        }

        // Validasi stok terkini sebelum checkout
        foreach ($cartItems as $item) {
            if ($item->quantity > $item->book->stock) {
                return redirect()->route('cart.index')->with(
                    'error',
                    "Stok buku '{$item->book->title}' tidak mencukupi (sisa: {$item->book->stock} pcs). Silakan sesuaikan jumlah di keranjang."
                );
            }
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->subtotal;
        });

        $user = auth()->user();

        return view('checkout.index', compact('cartItems', 'subtotal', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'payment_method' => 'required|in:cod,whatsapp',
            'notes' => 'nullable|string|max:255',
        ], [
            'customer_name.required' => 'Nama lengkap penerima wajib diisi.',
            'customer_phone.required' => 'Nomor WhatsApp / telepon aktif wajib diisi untuk konfirmasi kurir.',
            'shipping_address.required' => 'Alamat lengkap pengiriman wajib diisi agar kurir dapat mengantarkan paket.',
            'payment_method.required' => 'Metode pembayaran wajib dipilih.',
        ]);

        $cartItems = Cart::with('book')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        try {
            $order = DB::transaction(function () use ($request, $cartItems) {
                // 1. Verifikasi ketersediaan stok
                foreach ($cartItems as $item) {
                    if ($item->quantity > $item->book->stock) {
                        throw new \Exception("Maaf, stok untuk buku '{$item->book->title}' tidak mencukupi (tersedia: {$item->book->stock} pcs).");
                    }
                }

                // 2. Generate nomor pesanan unik
                do {
                    $orderNumber = 'ORD-' . strtoupper(Str::random(8));
                } while (Order::where('order_number', $orderNumber)->exists());

                // 3. Hitung total belanja
                $totalAmount = $cartItems->sum(function ($item) {
                    return $item->subtotal;
                });

                // 4. Buat record Order
                $order = Order::create([
                    'order_number' => $orderNumber,
                    'user_id' => auth()->id(),
                    'customer_name' => trim($request->customer_name),
                    'customer_phone' => trim($request->customer_phone),
                    'shipping_address' => trim($request->shipping_address . ($request->filled('notes') ? "\n\nCatatan: " . $request->notes : '')),
                    'total_amount' => $totalAmount,
                    'status' => 'pending',
                    'payment_method' => $request->payment_method,
                ]);

                // 5. Buat record OrderItem & kurangi stok buku secara atomik
                foreach ($cartItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'book_id' => $item->book_id,
                        'price' => $item->book->price,
                        'quantity' => $item->quantity,
                        'subtotal' => $item->subtotal,
                    ]);

                    // Kurangi stok buku
                    $item->book->decrement('stock', $item->quantity);
                }

                // 6. Kosongkan keranjang belanja pengguna
                Cart::where('user_id', auth()->id())->delete();

                return $order;
            });

            return redirect()->route('orders.success', $order->order_number);

        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function success($orderNumber)
    {
        $order = Order::with(['items.book.category', 'user'])
            ->where('order_number', $orderNumber)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('orders.success', compact('order'));
    }

    public function myOrders()
    {
        $orders = Order::with(['items.book'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('orders.my-orders', compact('orders'));
    }

    public function showOrder($orderNumber)
    {
        $order = Order::with(['items.book.category', 'user'])
            ->where('order_number', $orderNumber)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }
}
