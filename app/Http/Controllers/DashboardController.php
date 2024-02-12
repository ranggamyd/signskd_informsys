<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\SignedSKD;
use App\Models\SKD;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard', [
            'total_pasien' => Patient::all()->count(),
            'total_dokter' => Doctor::all()->count(),
            'total_skd' => SKD::all()->count(),
            'total_signed_skd' => SignedSKD::all()->count(),
            'total_users' => User::all()->count(),
            'skds' => SKD::whereNotIn('id', function ($query) {
                $query->select('skd_id')->from('signed_skds');
            })->latest()->get(),
        ]);
    }
}
