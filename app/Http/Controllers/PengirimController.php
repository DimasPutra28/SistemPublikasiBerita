<?php

namespace App\Http\Controllers;

use App\Models\Pengirim;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


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
            'harga' => 'required',
            'metodebayar' => 'required',
        ]);

        $filePath = $request->file('file_path')->store('uploads', 'public');
        $pengirim = Pengirim::create([
            'nama' => $request->nama,
            'no_wa' => $request->no_wa,
            'email' => $request->email,
            'judul_berita' => $request->judul_berita,
            'file_path' => $filePath,
            'tanggal' => $request->tanggal,
            'paket' => $request->paket,
            'harga' => $request->harga,
            'metodebayar' => $request->metodebayar,
        ]);

        // Generate nomor invoice
        $pengirim->nomor_invoice = '#' . str_pad($pengirim->id, 3, '0', STR_PAD_LEFT);
        $pengirim->save();

        return response()->json(['id' => $pengirim->id]);
    }

    // public function generateInvoice($id)
    // {
    //     $pengirim = Pengirim::findOrFail($id);
    //     $pdf = pdf::loadView('invoice', ['pengirim' => $pengirim])->setPaper('a5', 'landscape');
    //     return $pdf->stream('invoice.pdf');
    // }

    public function generateInvoice($id)
    {
        $pengirim = Pengirim::findOrFail($id);

        // Buat URL berdasarkan metode pembayaran
        // $paymentUrl = $this->getPaymentUrl($pengirim->metodebayar);

        // Generate QR code
        // $qrCode = QrCode::size(200)->generate($paymentUrl);

        $pdf = pdf::loadView('invoice', [
            'pengirim' => $pengirim
            // 'qrCode' => $qrCode,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('invoice.pdf');
    }

    // private function getPaymentUrl($metodeBayar)
    // {
    //     // Sesuaikan dengan URL pembayaran sebenarnya
    //     if (str_contains($metodeBayar, 'Mandiri')) {
    //         return 'https://bankmandiri.co.id/payment/virtual-account/00987654321';
    //     } elseif (str_contains($metodeBayar, 'Shopeepay')) {
    //         return 'https://www.youtube.com/';
    //     }
    //     return '#';
    // }

    public function uploadBuktiBayar(Request $request, $id)
    {
        $pengirim = Pengirim::findOrFail($id);

        $buktiBayarPath = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

        $pengirim->update(['bukti_bayar' => $buktiBayarPath]);

        return redirect()->back()->with('success', 'Bukti bayar berhasil diupload!');
    }

    public function showTable()
    {
        $pengirims = Pengirim::all();
        return view('admin.kwitansi', compact('pengirims'));
    }

    public function sendKwitansi($id)
    {
        // Cari data pengirim berdasarkan ID
        $pengirim = Pengirim::findOrFail($id);
        // Generate PDF
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('buktikwitansi', compact('pengirim'))->setPaper('a4', 'landscape');

        // Kirim Email
        Mail::send([], [], function ($message) use ($pengirim, $pdf) {
            $message->to($pengirim->email)
                ->subject('Kwitansi Pembayaran')
                ->attachData($pdf->output(), 'kwitansi.pdf');
        });

        return redirect()->back()->with('success', 'Kwitansi berhasil dikirim!');
    }
}
