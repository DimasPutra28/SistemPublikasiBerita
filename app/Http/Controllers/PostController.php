<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\session;

class PostController extends Controller
{

 
    public function dashboardkontributor()
    {
        // $posts = Post::select('post_title', 'view_count')->get();
        $posts = Post::where('post_author', Auth::id())
            ->orderBy('view_count', 'desc')
            ->paginate(20);
        return view('kontributor.index', compact('posts'));
    }

    public function postkontributor()
    {
        $posts = Post::where('post_author', Auth::id())
            ->orderBy('view_count', 'desc')->get();
        return view('kontributor.postall', compact('posts'));
    }

    public function tambahposting()
    {
        return view('kontributor.form');
    }

    public function simpanposting(Request $request)
    {
        $request->validate([
            'post_title' => 'required|string|max:255',
            'post_content' => 'required',
        ]);



        $pos = Post::create([
            'post_author' => auth()->id(),
            'post_date' => Carbon::now(),
            'post_date_gmt' => Carbon::now('GMT'),
            // 'post_content' => substr(strip_tags($request->post_content), 0, 10000),
            'post_content' => $request->post_content,
            'post_title' => $request->post_title,
            'post_name' => $request->post_name,
            'post_excerpt' => substr(strip_tags($request->post_content), 0, 10000),
            'post_status' => 'draft',
            'comment_status' => 'open',
            'ping_status' => 'open',
            'post_password' => '1231231',
            'to_ping' => '',
            'pinged' => '',
            'post_modified' => null, // Default ke NULL
            'post_modified_gmt' => null, // Default ke NULL
            'post_parent' => 0,
            'guid' => '',
            'menu_order' => 0,
            'post_type' => 'post',
            'post_mime_type' => '',
            'comment_count' => 0,
        ]);

        // dd($pos);
        return redirect()->route('post.dash')->with('success', 'Postingan berhasil ditambahkan.');
    }

    public function editposting($post_name)
    {
        $post = Post::where('post_name', $post_name)->firstOrFail();
        return view('kontributor.form', compact('post'));
    }

    public function updateposting(Request $request, $post_name)
    {
        $request->validate([
            'post_title' => 'required|string|max:255',
            'post_content' => 'required',
        ]);

        $post = Post::where('post_name', $post_name)->firstOrFail();
        $post->update([
            'post_title' => $request->post_title,
            // 'post_content' => substr(strip_tags($request->post_content), 0, 10000),
            'post_content' => $request->post_content, // Update konten tanpa manipulasi
            // 'post_name' => $request->post_name,
            'post_excerpt' => substr(strip_tags($request->post_content), 0, 10000),
            'post_modified' => Carbon::now(),
            'post_modified_gmt' => Carbon::now('GMT'),
        ]);

        return redirect()->route('post.dash')->with('success', 'Postingan berhasil diupdate.');
    }

    public function destroyposting($post_name)
    {
        $post = Post::where('post_name', $post_name)->firstOrFail();
        $post->delete(); // Hapus postingan
        return redirect()->route('post.dash')->with('success', 'Postingan berhasil dihapus.');
    }

    public function show($post_name)
    {
        // Cari postingan berdasarkan post_name
        $post = Post::where('post_name', $post_name)->firstOrFail();

        // Tambahkan logika untuk meningkatkan view count
        $post->increment('view_count');

        // Kembalikan view dengan data postingan
        return view('kontributor.view', compact('post'));
    }

    public function upload(Request $request)
    {

        if ($request->hasFile('upload')) {

            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('media'), $fileName);

            $url = asset('media/' . $fileName);
            return response()->json([
                'fileName' => $fileName, 'uploaded' => 1, 'url' => $url
            ]);
        }
    }
}
