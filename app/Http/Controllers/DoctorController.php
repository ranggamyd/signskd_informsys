<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Doctor;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('doctor', ['doctors' => Doctor::orderBy('nama')->get()]);
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
            'nama' => 'required',
            'email' => 'nullable|email:rfc,dns|unique:doctors',
            'telepon' => 'nullable|unique:doctors',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errors->add('create', 'Oops, Terdapat kesalahan.');

            return redirect('/doctor')
                ->withErrors($validator)
                ->withInput();
        }

        Doctor::create($request->all());

        return redirect('/doctor')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'nullable|email:rfc,dns|unique:doctors,email,' . $doctor->id,
            'telepon' => 'nullable|unique:doctors,telepon,' . $doctor->id,
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errors->add('edit', $doctor->id);

            return redirect('/doctor')
                ->withErrors($validator)
                ->withInput();
        }

        $doctor->update($request->all());

        return redirect('/doctor')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->destroy($doctor->id);

        return redirect('/doctor')->with('success', 'Data berhasil dihapus.');
    }
}
