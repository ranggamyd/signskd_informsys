<?php

namespace App\Http\Controllers;

use App\Models\SKD;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\SignedSKD;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->partner_id) {
            return view('dashboard_mitra', [
                'total_pasien' => Patient::where('partner_id', $user->partner_id)->count(),
                'total_dokter' => Doctor::all()->count(),
                'patients' => Patient::where('partner_id', $user->partner_id)->get()
            ]);
        }

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
