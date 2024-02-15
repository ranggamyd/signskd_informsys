<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Patient;
use App\Models\Doctor;
use App\Models\SignedSKD;

class SignedSKDController extends Controller
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
        return view('signed_skd', [
            'signed_skds' => SignedSKD::latest()->get(),
            // 'no_surat' => $this->generateNoSurat(),
            // 'patients' => Patient::all(),
            // 'doctors' => Doctor::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SignedSKD $signedSKD)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SignedSKD $signedSKD)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SignedSKD $signedSKD)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        SignedSKD::destroy($id);

        return redirect('/signed_skd')->with('success', 'Data berhasil dihapus.');
    }

    public function check($hash)
    {
        $hash = base64_decode($hash);
        $signed_skd = SignedSKD::where('hash', $hash)->first();

        if (Hash::check($signed_skd->skd->no_surat, $hash)) {
            session()->flash('success', 'Selamat, SKD anda valid.');

            return view('check_skd', [
                'signed_skd' => $signed_skd,
                'patients' => Patient::latest()->get(),
                'doctors' => Doctor::orderBy('nama')->get(),
            ]);
        };

        $this->failed();
    }

    public function failed()
    {
        session()->flash('error', 'Maaf, SKD anda tidak valid..');

        return view('check_skd');
    }
}
