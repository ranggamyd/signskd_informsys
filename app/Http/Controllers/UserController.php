<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
        return view('user', ['users' => User::orderBy('name')->get()]);
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
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'nullable|email:rfc,dns|unique:users',
            'phone' => 'nullable|unique:users',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errors->add('create', 'Oops, Terdapat kesalahan.');

            return redirect('/user')
                ->withErrors($validator)
                ->withInput();
        }

        $request['avatar'] = 'default.jpg';
        $request['password'] = Hash::make($request['password']);

        User::create($request->all());

        return redirect('/user')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return redirect('/user')->with('show_profile', $user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return redirect('/user')->with('update_profile', $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'nullable|unique:users,username,' . $user->id,
            'email' => 'nullable|email:rfc,dns|unique:users,email,' . $user->id,
            'phone' => 'nullable|unique:users,phone,' . $user->id,
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => $request->filled('password') ? 'required|confirmed|min:6' : '',
            'password_confirmation' => $request->filled('password') ? 'required' : '',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errors->add('edit', $user->id);

            return redirect('/user')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->filled('password')) $user->password = Hash::make($request->password);

        $user->update($request->only(['name', 'username', 'email', 'phone']));

        return redirect('/user')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->destroy($user->id);

        return redirect('/user')->with('success', 'Data berhasil dihapus.');
    }
}
