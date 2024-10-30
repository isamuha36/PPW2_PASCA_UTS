<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Author; // Tambahkan model Author

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    // Read: Menampilkan semua buku
    public function index() {
        // if(Auth::check()) {
            $book_data = Book::all();
            $book_total = count($book_data);
            $price_total = 0;
        
            foreach($book_data as $book){
                $price_total += $book->price; // Menggunakan 'price' sebagai field harga
            }
        
            return view('book.index', compact('book_data', 'book_total', 'price_total'));
        // }
        return redirect()->route('login')
        ->withErrors('Please login to access the dashboard');
    }

    // Show: Menampilkan detail buku tertentu
    public function show($id) {
        $book = Book::findOrFail($id);
        return view('book.show', compact('book'));
    }

    // Create: Menampilkan form untuk membuat buku baru
    public function create() {
        $authors = Author::all(); // Ambil data penulis untuk dropdown
        return view('book.create', compact('authors'));
    }

    // Store: Menyimpan data buku baru
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'date_of_publication' => 'required|date',
            'author_id' => 'required|exists:authors,id'
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Book created successfully!');
    }

    // Edit: Menampilkan form untuk mengedit buku
    public function edit($id) {
        $book = Book::findOrFail($id);
        $authors = Author::all(); // Ambil data penulis untuk dropdown
        return view('book.edit', compact('book', 'authors'));
    }

    // Update: Menyimpan perubahan pada data buku
    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'date_of_publication' => 'required|date',
            'author_id' => 'required|exists:authors,id'
        ]);

        $book = Book::findOrFail($id);
        $book->update($request->all());

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    // Delete: Menghapus data buku
    public function destroy($id) {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }
}
