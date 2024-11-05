<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    public function index(){
        $authors_data = Author::all();
        return view('author.index', compact('authors_data'));
    }

    public function create(){
        return view('author.create');
    }

    public function destroy($id){
        $author = Author::findOrFail($id);
        $author->delete();

        return redirect()->route('authors.index')->with('success', 'Author deleted successfully!'); 
    }

    public function edit($id){
        $author = Author::findOrFail($id);
        return view('author.edit', compact('author'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'phone' => 'required|string|max:15',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:500',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('author_photo', 'public');
        }
        
        Author::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
            'photo' => $photoPath,
        ]);
    
        return redirect()->route('authors.index')->with('success', 'Author created successfully!');
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users,email,'.$id,
            'phone' => 'nullable|string|max:15',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string|max:500',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $author = Author::findOrFail($id);
        
        $data = $request->only(['name', 'email', 'phone', 'birth_date', 'address']);
        
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($author->photo) {
                Storage::disk('public')->delete($author->photo);
            }
            $data['photo'] = $request->file('photo')->store('author_photo', 'public');
        }
    
        $author->update($data);
    
        return redirect()->route('authors.index')->with('success', 'Author updated successfully!');
    }
    
    
}
