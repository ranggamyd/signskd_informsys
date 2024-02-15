<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Patient;

class PatientController extends Controller
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
        return view('patient', ['patients' => Patient::latest()->get()]);
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
            'nik' => 'nullable|unique:patients',
            'nama' => 'required',
            'telepon' => 'nullable|unique:patients',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errors->add('create', 'Error in create modal field.');

            return redirect('/patient')
                ->withErrors($validator)
                ->withInput();
        }

        Patient::create($request->all());

        return redirect('/patient')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'nullable|unique:patients,nik,' . $patient->id,
            'nama' => 'required',
            'telepon' => 'nullable|unique:patients,telepon,' . $patient->id,
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errors->add('edit', $patient->id);

            return redirect('/patient')
                ->withErrors($validator)
                ->withInput();
        }

        $patient->update($request->all());

        return redirect('/patient')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->destroy($patient->id);

        return redirect('/patient')->with('success', 'Data berhasil dihapus.');
    }

    public function create_skd($id)
    {
        return redirect('/skd')->with('create_with_patient', $id);
    }
}
