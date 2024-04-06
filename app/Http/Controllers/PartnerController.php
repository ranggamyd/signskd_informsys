<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Partner;

class PartnerController extends Controller
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
        return view('partner', ['partners' => Partner::latest()->get()]);
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
            'nama_mitra' => 'required|unique:partners',
            'alamat' => 'required',
            'keterangan' => 'nullable',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errors->add('create', 'Error in create modal field.');

            return redirect('/partner')
                ->withErrors($validator)
                ->withInput();
        }

        Partner::create($request->all());

        return redirect('/partner')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        $validator = Validator::make($request->all(), [
            'nama_mitra' => 'required|unique:partners,' . $partner->id,
            'alamat' => 'required',
            'keterangan' => 'nullable',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errors->add('edit', $partner->id);

            return redirect('/partner')
                ->withErrors($validator)
                ->withInput();
        }

        $partner->update($request->all());

        return redirect('/partner')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        $partner->destroy($partner->id);

        return redirect('/partner')->with('success', 'Data berhasil dihapus.');
    }

    public function create_skd($id)
    {
        return redirect('/skd')->with('create_with_partner', $id);
    }
}
