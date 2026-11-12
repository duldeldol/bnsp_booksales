<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'unread') {
                $query->where('is_read', false);
            } elseif ($request->status === 'read') {
                $query->where('is_read', true);
            }
        }

        $messages = $query->latest()->paginate(5)->withQueryString();

        return view('admin.contacts.index', compact('messages'));
    }

    public function toggleRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update([
            'is_read' => !$contact->is_read,
        ]);

        $statusText = $contact->is_read ? 'sudah dibaca' : 'belum dibaca';
        return back()->with('success', "Pesan dari {$contact->name} ditandai {$statusText}.");
    }

    public function markAsRead(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        if (!$contact->is_read) {
            $contact->update([
                'is_read' => true,
            ]);
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesan ditandai sudah dibaca.',
            ]);
        }

        return back()->with('success', "Pesan dari {$contact->name} ditandai sudah dibaca.");
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}
