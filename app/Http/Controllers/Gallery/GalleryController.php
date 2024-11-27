<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{

    // public function index()
    // {
    //     $data = [
    //         'id' => 'post',
    //         'menu' => 'Gallery',
    //         'galleries' => Post::where('picture', '!=', '')->whereNotNull('picture')->orderBy('created_at', 'desc')->paginate(30),
    //     ];
    //     return view('gallery.index')->with($data);
    // }
    public function index()
    {
        return view('gallery.index');
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function edit($id)
    {
        $gallery = Post::findOrFail($id);
        return view('gallery.edit', compact('gallery'));
    }

    public function destroy($id)
    {
        $gallery = Post::findOrFail($id);
        $gallery->delete();

        return redirect()->route('gallery.index')->with('success', 'User deleted successfully!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'picture' => 'image|nullable|max:1999',
        ]);

        if ($request->hasFile('picture')) {
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $basename = uniqid() . time();

            $smallFilename = "small_{$basename}.{$extension}";
            $mediumFilename = "medium_{$basename}.{$extension}";
            $largeFilename = "large_{$basename}.{$extension}";

            $filenameSimpan = "{$basename}.{$extension}";
            $path = $request->file('picture')->storeAs('posts_image', $filenameSimpan);
        } else {
            $filenameSimpan = 'noimage.png';
        }

        $post = new Post();
        $post->picture = $filenameSimpan;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();

        return redirect('gallery')->with('success', 'Berhasil menambahkan data baru');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'picture' => 'image|nullable|max:1999',
        ]);

        $gallery = Post::findOrFail($id);

        if ($request->hasFile('picture')) {
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $basename = uniqid() . time();

            $filenameSimpan = "{$basename}.{$extension}";
            $path = $request->file('picture')->storeAs('posts_image', $filenameSimpan);

            // Hapus gambar lama jika ada dan bukan gambar default
            if ($gallery->picture && $gallery->picture != 'noimage.png') {
                Storage::delete('posts_image/' . $gallery->picture);
            }

            $gallery->picture = $filenameSimpan;
        }

        $gallery->title = $request->input('title');
        $gallery->description = $request->input('description');
        $gallery->save();

        return redirect()->route('gallery.index')->with('success', 'Data berhasil diperbarui');
    }


     /**
 * @OA\Get(
 *     path="/api/gallery",
 *     tags={"gallery"},
 *     summary="Returns a Sample API response",
 *     description="A sample greeting to test out the API",
 *     @OA\Response(
 *         response=200,
 *         description="successful operation",
 *         @OA\JsonContent(
 *             example={
 *                 "success": true,
 *                 "message": "Berhasil mengambil Kategori Berita",
 *                 "data": {
 *                     "output": "Hallo Jon Doe",
 *                     "firstname": "John",
 *                     "lastname": "Doe"
 *                 }
 *             }
 *         )
 *     )
 * )
 */

    public function GalleryApi(){
        $data = Post::where('picture', '!=', '')->whereNotNull('picture')->orderBy('created_at', 'desc')->paginate(30);
        return response()->json($data);
    }
}
