<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use DatabaseTransactions;

    public function test_login_page_is_accessible(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_register_page_is_accessible(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_customer_cannot_access_admin_dashboard(): void
    {
        $customer = User::where('role', 'customer')->first();
        $response = $this->actingAs($customer)->get('/admin/dashboard');
        $response->assertRedirect('/');
    }

    public function test_admin_can_access_all_admin_pages(): void
    {
        $admin = User::where('role', 'admin')->first();

        $this->actingAs($admin)->get('/admin/dashboard')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/categories')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/books')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/books/create')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/users')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/orders')->assertStatus(200);
        $this->actingAs($admin)->get('/admin/contacts')->assertStatus(200);
    }

    public function test_admin_can_crud_category(): void
    {
        $admin = User::where('role', 'admin')->first();

        // 1. Create Category
        $response = $this->actingAs($admin)->post('/admin/categories', [
            'name' => 'Kategori Uji Coba',
            'description' => 'Deskripsi uji coba',
        ]);
        $response->assertRedirect('/admin/categories');
        $this->assertDatabaseHas('categories', ['name' => 'Kategori Uji Coba']);

        $category = Category::where('name', 'Kategori Uji Coba')->first();

        // 2. Update Category
        $response = $this->actingAs($admin)->put('/admin/categories/' . $category->id, [
            'name' => 'Kategori Diubah',
            'description' => 'Deskripsi diubah',
        ]);
        $response->assertRedirect('/admin/categories');
        $this->assertDatabaseHas('categories', ['name' => 'Kategori Diubah']);

        // 3. Delete Category
        $response = $this->actingAs($admin)->delete('/admin/categories/' . $category->id);
        $response->assertRedirect('/admin/categories');
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_admin_can_crud_book(): void
    {
        $admin = User::where('role', 'admin')->first();
        $category = Category::first();

        // 1. Create Book
        $response = $this->actingAs($admin)->post('/admin/books', [
            'category_id' => $category->id,
            'title' => 'Buku Baru BNSP',
            'author' => 'Penulis BNSP',
            'publisher' => 'Penerbit BNSP',
            'price' => 120000,
            'stock' => 10,
            'description' => 'Deskripsi buku baru',
        ]);
        $response->assertRedirect('/admin/books');
        $this->assertDatabaseHas('books', ['title' => 'Buku Baru BNSP']);

        $book = Book::where('title', 'Buku Baru BNSP')->first();

        // 2. Update Book
        $response = $this->actingAs($admin)->put('/admin/books/' . $book->id, [
            'category_id' => $category->id,
            'title' => 'Buku BNSP Update',
            'author' => 'Penulis Update',
            'publisher' => 'Penerbit BNSP',
            'price' => 150000,
            'stock' => 15,
            'description' => 'Deskripsi update',
        ]);
        $response->assertRedirect('/admin/books');
        $this->assertDatabaseHas('books', ['title' => 'Buku BNSP Update']);

        // 3. Delete Book
        $response = $this->actingAs($admin)->delete('/admin/books/' . $book->id);
        $response->assertRedirect('/admin/books');
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    public function test_admin_can_update_order_status(): void
    {
        $admin = User::where('role', 'admin')->first();
        $order = Order::first();

        $response = $this->actingAs($admin)->patch('/admin/orders/' . $order->id . '/status', [
            'status' => 'completed',
        ]);

        $response->assertRedirect('/admin/orders/' . $order->id);
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'completed',
        ]);
    }

    public function test_admin_can_toggle_contact_read_status(): void
    {
        $admin = User::where('role', 'admin')->first();
        $contact = Contact::first();

        $initialStatus = $contact->is_read;

        $response = $this->actingAs($admin)->patch('/admin/contacts/' . $contact->id . '/toggle');
        $response->assertRedirect();

        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'is_read' => !$initialStatus,
        ]);
    }
}
