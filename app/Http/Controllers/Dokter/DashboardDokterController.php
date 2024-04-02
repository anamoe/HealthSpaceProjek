<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\CatatanDokter;
use App\Models\Konsul;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardDokterController extends Controller
{
    //
    public function index()
    {

        $diagnosaTerbanyak = CatatanDokter::join('icds', 'catatan_dokters.diagnosa', 'icds.code')
            ->select('icds.name_id', DB::raw('COUNT(*) as total'))
            ->groupBy('diagnosa')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
        $totalDiagnosa = $diagnosaTerbanyak->sum('total');
        // return $totalDiagnosa;
        foreach ($diagnosaTerbanyak as $diagnosa) {
            $labels[] = $diagnosa->name_id;
            $persentase = ($diagnosa->total / $totalDiagnosa) * 100;
            $data[] = round($persentase, 2);
            // return $data;
        }

        // Membuat array final untuk dikirimkan ke view
        $data = [
            'labels' => $labels,
            'data' => $data,
        ];
        // return $data;
        $konsultasi = Konsul::where('tgl_konsultasi', date('Y-m-d'))->count();

        $now = Carbon::now();
        $bulanIni = $now->month;
        $tahunIni = $now->year;

        $konsultasiBulanIni = Konsul::whereMonth('tgl_konsultasi', $bulanIni)
            ->whereYear('tgl_konsultasi', $tahunIni)
            ->count();
        //  return $konsultasiBulanIni;
        // return $konsultasi;
        


        return view('dokter.dashboard', compact('data', 'konsultasi', 'konsultasiBulanIni'));
    }
}
