<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pengirim;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil semua postingan dengan status 'publish' dan urutkan berdasarkan tanggal terbaru
        $posts = Post::orderBy('post_date', 'desc')->get();
        return view('admin.postalladmin', compact('posts'));
    }

    public function dashboardadmin()
    {
        $posts = Post::orderBy('post_date', 'desc')->get();
        $pengirim = Pengirim::orderBy('tanggal', 'desc')->get();
        return view('admin.index', compact('posts','pengirim'));
    }

    public function tambahadmin()
    {
        return view('admin.form');
    }

    public function simpanadmin(Request $request)
    {
        $request->validate([
            'post_title' => 'required|string|max:255',
            'post_content' => 'required',
            'comment_status' => 'required|in:open,closed',
            'post_status' => 'required|in:draft,publish',
        ]);



        $post = Post::create([
            'post_author' => auth()->id(),
            'post_date' => Carbon::now(),
            'post_date_gmt' => Carbon::now('GMT'),
            'post_content' => substr(strip_tags($request->post_content), 0, 10000),
            'post_title' => $request->post_title,
            'post_name' => $request->post_name,
            'post_excerpt' => substr(strip_tags($request->post_content), 0, 200),
            'comment_status' => $request->comment_status,
            'post_status' => $request->post_status,
            'ping_status' => 'open',
            'post_password' => '1231231',
            'to_ping' => '',
            'pinged' => '',
            'post_modified' => null, // Default ke NULL
            'post_modified_gmt' => null, // Default ke NULL
            'post_parent' => 0,
            'guid' => $request->post_status === 'publish'
                ? url('/post/' . $request->post_name) // Generate URL jika status publish
                : $request->guid, // Biarkan tidak berubah jika status bukan publish,
            'menu_order' => 0,
            'post_type' => 'post',
            'post_mime_type' => '',
            'comment_count' => 0,
        ]);

        // dd($pos);
        return redirect()->route('admin.dash')->with('success', 'Postingan berhasil ditambahkan.');
    }

    public function editadmin($post_name)
    {
        $post = Post::where('post_name', $post_name)->firstOrFail();
        return view('admin.form', compact('post'));
    }

    public function updateadmin(Request $request, $post_name)
    {
        $request->validate([
            'post_title' => 'required|string|max:255',
            'post_content' => 'required',
            'comment_status' => 'required|in:open,closed',
            'post_status' => 'required|in:draft,publish',
        ]);
        $post = Post::where('post_name', $post_name)->firstOrFail();
        $post_date = $request->post_status === 'publish' ? Carbon::now() : null;
        $post->update([
            'post_title' => $request->post_title,
            'post_content' => substr(strip_tags($request->post_content), 0, 10000),
            'post_date' => $post_date, // Tanggal publish jika publish
            'post_name' => $request->post_name,
            'post_excerpt' => substr(strip_tags($request->post_content), 0, 200),
            'comment_status' => $request->comment_status,
            'post_status' => $request->post_status,
            'guid' => $request->post_status === 'publish'
                ? url('/post/' . $request->post_name) // Generate URL jika status publish
                : $post->guid, // Biarkan tidak berubah jika status bukan publish
        ]);

        return redirect()->route('admin.dash')->with('success', 'Postingan berhasil diupdate.');
    }

    public function destroyadmin($post_name)
    {
        $post = Post::where('post_name', $post_name)->firstOrFail();
        $post->delete(); // Hapus postingan
        return redirect()->route('admin.dash')->with('success', 'Postingan berhasil dihapus.');
    }
}
