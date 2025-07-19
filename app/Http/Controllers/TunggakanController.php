<?php

namespace App\Http\Controllers;

use App\Models\Rombel;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TunggakanController extends Controller
{
    public function index(Request $request)
    {
        $tahun_ajarans = TahunAjaran::all();
        $rombels = Rombel::all();

        $query = Tagihan::with(['siswa.rombel', 'siswa.tahunAjaran'])
            ->where('status', '!=', 'lunas');

        if ($request->filled('tahun_ajaran_id')) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('tahun_ajaran_id', $request->tahun_ajaran_id);
            });
        }

        if ($request->filled('rombel_id')) {
            $query->whereHas('siswa', function ($q) use ($request) {
                $q->where('rombel_id', $request->rombel_id);
            });
        }

        $tagihans = $query->get();

        return view('admin.kirim_tunggakan.index', compact('tagihans', 'tahun_ajarans', 'rombels'));
    }
}
