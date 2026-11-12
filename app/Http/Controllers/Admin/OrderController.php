<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items.book'])->latest();

        if ($request->filled('search')) {
            $rawSearch = trim($request->search);

            $cleanSearch = ltrim($rawSearch, '# ');

            $noSpaceSearch = str_replace(' ', '', $cleanSearch);

            $dashNormalized = (string) preg_replace('/\s*-\s*/', '-', $cleanSearch);

            $dashFromSpace = (string) preg_replace('/\s+/', '-', $cleanSearch);

            $alphaOnly = (string) preg_replace('/[^A-Za-z0-9]/', '', $cleanSearch);

            $query->where(function ($q) use ($rawSearch, $cleanSearch, $noSpaceSearch, $dashNormalized, $dashFromSpace, $alphaOnly) {
                $q->where('order_number', 'like', "%{$rawSearch}%")
                  ->orWhere('order_number', 'like', "%{$cleanSearch}%")
                  ->orWhere('order_number', 'like', "%{$noSpaceSearch}%")
                  ->orWhere('order_number', 'like', "%{$dashNormalized}%")
                  ->orWhere('order_number', 'like', "%{$dashFromSpace}%");

                if (!empty($alphaOnly) && strlen($alphaOnly) >= 3) {
                    $q->orWhere('order_number', 'like', "%{$alphaOnly}%");
                    if (str_starts_with(strtoupper($alphaOnly), 'ORD')) {
                        $suffix = substr($alphaOnly, 3);
                        if (!empty($suffix)) {
                            $q->orWhere('order_number', 'like', "%{$suffix}%");
                        }
                    }
                }

                if (is_numeric($cleanSearch) || is_numeric($alphaOnly)) {
                    $idSearch = is_numeric($cleanSearch) ? (int)$cleanSearch : (int)$alphaOnly;
                    $q->orWhere('id', $idSearch);
                }

                $q->orWhere('customer_name', 'like', "%{$cleanSearch}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(5)->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['user', 'items.book'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => ['required', 'in:pending,paid,completed,cancelled'],
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.orders.show', $order->id)
            ->with('success', "Status pesanan {$order->order_number} berhasil diubah menjadi '{$order->status_label}'.");
    }
}
