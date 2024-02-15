<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\SKD;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\SignedSKD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SKDController extends Controller
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
        return view('skd', [
            'skds' => SKD::latest()->get(),
            'no_surat' => $this->generateNoSurat(),
            'patients' => Patient::latest()->get(),
            'doctors' => Doctor::orderBy('nama')->get(),
        ]);
    }

    protected function generateNoSurat()
    {
        // Contoh: SKD/2022/001
        $prefix = 'SKD/';
        $year = Carbon::now()->year;
        $lastNumber = SKD::whereYear('created_at', $year)->count() + 1;

        $number = sprintf('%03d', $lastNumber);

        return $prefix . $year . '/' . $number;
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
        $validator = Validator::make($request->all(), [
            'no_surat' => 'required|unique:skds',
            'patient_id' => 'required',
            'diagnosa' => 'required',
            'doctor_id' => 'required',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'required|date',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errors->add('create', 'Error in create modal field.');

            return redirect('/skd')
                ->withErrors($validator)
                ->withInput();
        }

        SKD::create($request->all());

        return redirect('/skd')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SKD $skd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SKD $skd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skd $skd)
    {
        $validator = Validator::make($request->all(), [
            'no_surat' => 'required|unique:skds,no_surat,' . $skd->id,
            'patient_id' => 'required',
            'diagnosa' => 'required',
            'doctor_id' => 'required',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'required|date',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errors->add('edit', $skd->id);

            return redirect('/skd')
                ->withErrors($validator)
                ->withInput();
        }

        $skd->update($request->all());

        return redirect('/skd')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SKD $skd)
    {
        $skd->destroy($skd->id);

        return redirect('/skd')->with('success', 'Data berhasil dihapus.');
    }

    public function sign_skd($id)
    {
        $skd = SKD::findOrFail($id);
        if (SignedSKD::where('skd_id', $id)->first()) {
            return redirect('/skd')
                ->with('error', 'SKD sudah ter-assign.');
        }

        $hash = Hash::make($skd->no_surat);
        $qrCode = QrCode::generate(route('signed_skd.check', base64_encode($hash)));

        $dompdf = new Dompdf();
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->loadHtml(view('pdf', ['skd' => $skd, 'qrCode' => $qrCode])->render());
        $dompdf->render();
        $output = $dompdf->output();
        $fileName = 'SKD-' . date('YmdHis') . '.pdf';
        file_put_contents('pdfs/' . $fileName, $output);

        SignedSKD::create([
            'skd_id' => $id,
            'hash' => $hash,
            'pdf' => $fileName,
        ]);

        return redirect('/signed_skd')->with('success', 'Data berhasil disimpan.');
    }
}
