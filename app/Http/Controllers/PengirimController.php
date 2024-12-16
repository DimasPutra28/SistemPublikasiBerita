<?php

namespace App\Http\Controllers;

use App\Models\Pengirim;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class PengirimController extends Controller
{
    public function index()
    {
        return view('pengirim.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_wa' => 'required',
            'email' => 'required|email',
            'judul_berita' => 'required',
            'file_path' => 'required|file',
            'tanggal' => 'required|date',
            'paket' => 'required',
        ]);

        $filePath = $request->file('file_path')->store('uploads', 'public');

        $Pengirim = Pengirim::create([
            'nama' => $request->nama,
            'no_wa' => $request->no_wa,
            'email' => $request->email,
            'judul_berita' => $request->judul_berita,
            'file_path' => $filePath,
            'tanggal' => $request->tanggal,
            'paket' => $request->paket,
        ]);

        return response()->json(['id' => $Pengirim->id]);
    }

    public function generateInvoice($id)
    {
        $Pengirim = Pengirim::findOrFail($id);
        $pdf = pdf::loadView('invoice', ['Pengirim' => $Pengirim]);
        return $pdf->stream('invoice.pdf');
    }

    public function uploadBuktiBayar(Request $request, $id)
    {
        $Pengirim = Pengirim::findOrFail($id);

        $buktiBayarPath = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

        $Pengirim->update(['bukti_bayar' => $buktiBayarPath]);

        return redirect()->back()->with('success', 'Bukti bayar berhasil diupload!');
    }
}
