<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalRevenue = Order::whereIn('status', ['paid', 'completed'])->sum('total_amount');
        $unreadMessages = Contact::where('is_read', false)->count();

        $recentOrders = Order::with('user')->latest()->take(3)->get();
        $recentBooks = Book::with('category')->latest()->take(2)->get();
        $categoriesList = Category::withCount('books')->latest()->take(4)->get();

        return view('admin.dashboard', compact(
            'totalBooks',
            'totalCategories',
            'totalOrders',
            'totalCustomers',
            'totalRevenue',
            'unreadMessages',
            'recentOrders',
            'recentBooks',
            'categoriesList'
        ));
    }
}
