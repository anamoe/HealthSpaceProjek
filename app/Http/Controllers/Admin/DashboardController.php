<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Konsul;
use App\Models\Pasien;
use App\Models\Poli;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $poli = Poli::count();
        $dokter = Dokter::count();
        $pasien = Pasien::count();

        // $tanggalAwal = Carbon::now()->subYear()->startOfYear();

        // $labels = [];
        // for ($i = 0; $i < 12; $i++) {
        //     $labels[] = $tanggalAwal->format('F'); 
        //     $tanggalAwal->addMonth(); 
        // }
        
        
        // $dataKonsultasi = Konsul::select(
        //         DB::raw('MONTHNAME(tgl_konsultasi) AS month'),
        //         DB::raw('COUNT(*) AS total_konsultasi'),
        //         DB::raw('YEAR(tgl_konsultasi) AS year')
        //     )
        //     ->where('tgl_konsultasi', '>=', now()->subMonths(12))
        //     ->groupBy('year', 'month')
        //     ->orderBy('year', 'DESC')
        //     ->orderBy('month', 'DESC')
        //     ->get();
      
        // $data = [];
        // foreach ($labels as $label) {
        //     $konsultasi = $dataKonsultasi->where('month', $label)->first();
        //     $totalKonsultasi = $konsultasi ? $konsultasi->total_konsultasi : 0;
        //     $data['labels'][] = $label;
        //     $data['data'][] = $totalKonsultasi;
        // }
        $tanggalAwal = Carbon::now()->subYear()->startOfYear();
        $tanggalAwal->setYear(Carbon::now()->year);
        // return $tanggalAwal;

        // Membuat array bulan dari rentang tanggal awal sampai sekarang
        $labels = [];
        $dataPoliUmum = [];
        $dataPoliGigi = [];
        $dataJumlahKonsultasi = [];
        
        for ($i = 0; $i < 12; $i++) {
            $bulanIni = $tanggalAwal->copy()->addMonths($i);
            $tanggalAwalBulanIni = $tanggalAwal->copy()->addMonths($i);
            $tanggalAkhirBulanIni = $tanggalAwalBulanIni->copy()->endOfMonth();
            // return $bulanIni->month;
            // return $tanggalAwalBulanIni;
        
            // Ambil data konsultasi untuk bulan ini
            $konsultasi = Konsul::select('users.poli_id', DB::raw('COUNT(*) as total_konsultasi'))
                ->join('users', 'konsuls.dokter_id', '=', 'users.id')
                ->join('polis', 'users.poli_id', '=', 'polis.id')
                ->whereYear('konsuls.tgl_konsultasi', $bulanIni->year)
                ->whereBetween('konsuls.tgl_konsultasi', [$tanggalAwalBulanIni, $tanggalAkhirBulanIni])
                // ->whereMonth('konsuls.tgl_konsultasi', $bulanIni->month)
                ->where('role','dokter')
                ->groupBy('users.poli_id')
                ->get();

                // return $konsultasi;
        
            // Inisialisasi jumlah konsultasi per poli
            $jumlahKonsultasiPoliUmum = 0;
            $jumlahKonsultasiPoliGigi = 0;
            $jumlahKonsultasi = 0;
        
            // Loop untuk menghitung jumlah konsultasi per poli
            foreach ($konsultasi as $data) {
                if ($data->poli_id === 1) { // Contoh: ID poli umum adalah 1
                    $jumlahKonsultasiPoliUmum += $data->total_konsultasi;
                } elseif ($data->poli_id === 2) { // Contoh: ID poli gigi adalah 2
                    $jumlahKonsultasiPoliGigi += $data->total_konsultasi;
                }
                // Anda dapat menambahkan logika untuk poli lain di sini jika diperlukan
            }
        
            // Tambahkan jumlah konsultasi per bulan ke dalam array data
            $labels[] = $bulanIni->format('F'); // Format nama bulan
            $dataPoliUmum[] = $jumlahKonsultasiPoliUmum;
            $dataPoliGigi[] = $jumlahKonsultasiPoliGigi;
            $dataJumlahKonsultasi[] = $jumlahKonsultasiPoliUmum + $jumlahKonsultasiPoliGigi;
        }
        
        $data = [
            'labels' => $labels,
            'data_poli_umum' => $dataPoliUmum,
            'data_poli_gigi' => $dataPoliGigi,
            'data_jumlah_konsultasi' => $dataJumlahKonsultasi,
        ];
        return view('admin.dashboard',compact('poli','pasien','dokter','data'));
    }
}
