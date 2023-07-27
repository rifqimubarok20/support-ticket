<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::whereIn('role', ['client', 'programmer'])->get();
        return view('user.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client = Client::all();
        return view('user.tambah', compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($request->user),
            ],
            'email_verified_at' => 'required',
            'password' => 'required|min:5|max:255',
            'image' => 'image|file|mimes:jpg,png,jpeg,gif,svg',
            'role' => '',
            'client_id' => [
                'required',
                Rule::unique('users', 'client_id'),
            ],
        ], [
            'email.unique' => 'Email Sudah Digunakan.',
            'client_id.unique' => 'Perusahaan Klien Sudah Terdaftar.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->email_verified_at = $request->email_verified_at;
        $user->password = Hash::make($request->password);
        $user->image = $request->file('image')->store('images');
        $user->role = $request->role;
        $user->client_id = $request->client_id;
        $user->save();

        return redirect('/user')->with('success', 'Data Baru Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $client = Client::all();
        return view('user.edit', compact(
            'user',
            'client'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => '',
            // 'password' => 'nullable|min:5|max:255',
            'image' => 'image|file|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'client_id' => 'required'
        ];

        // Validasi jika email sudah ada
        $emailRule = Rule::unique('users', 'email')->ignore($id);
        $rules['email'] = ['email', $emailRule];

        $clientRule = Rule::unique('users', 'client_id')->ignore($id);
        $rules['client_id'] = $clientRule;

        $customMessages = [
            'email.unique' => 'Email Sudah Digunakan.',
            'client_id.unique' => 'Perusahaan Klien Sudah Terdaftar.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return redirect()->route('user.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        // Pengambilan data user berdasarkan ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('user.edit', $id)
                ->with('error', 'User tidak ditemukan!');
        }

        $validatedData = $validator->validated(); // Mengambil data yang telah divalidasi

        // if ($validatedData['password']) {
        //     // Jika password diisi pada form update, maka hash password baru menggunakan bcrypt
        //     $validatedData['password'] = Hash::make($validatedData['password']);
        // } else {
        //     // Jika password tidak diisi pada form update, hapus key 'password' dari validatedData
        //     unset($validatedData['password']);
        // }

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('images');
        }

        $user->update($validatedData);

        return redirect('/user')->with('success', 'Data Berhasil Di Update!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/user')->with('success', 'Data Telah Berhasil Di Hapus!!');
    }
}
