<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $poli = Poli::count();
        $dokter = Dokter::count();
        return view('admin.dashboard',compact('poli','dokter'));
    }
}
