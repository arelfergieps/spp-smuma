<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KirimTunggakanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:tagihans,id',
        ]);

        try {
            // Ambil tagihan yang dipilih
            $tagihans = Tagihan::whereIn('id', $request->ids)->get();

            foreach ($tagihans as $tagihan) {
                // Di sini kamu bisa menambahkan logika misalnya update status
                // atau mencatat bahwa tunggakan ini "dikirim" ke siswa/ortu.
                // Contoh: update kolom 'dikirim' jika ada

                // $tagihan->update(['dikirim' => true]); // jika ada kolomnya
            }

            return redirect()->back()->with('success', 'Tunggakan berhasil dikirim.');
        } catch (\Exception $e) {
            Log::error('Gagal kirim tunggakan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim tunggakan.');
        }
    }
}
