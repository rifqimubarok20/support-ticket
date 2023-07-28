<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::all();

        return view('client.index', [
            'client' => $client
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.tambah');
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
            'name' => 'required|max:255|unique:client',
            'address' => 'required',
            'contact' => 'required|max:255',
            'image' => 'image|file|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'linkedin' => '',
            'instagram' => '',
            'website' => ''
        ], [
            'name.unique' => 'Perusahaan Client Sudah Terdaftar.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('image');
        }

        Client::create($validatedData);

        return redirect('/clients')->with('success', 'Data Client Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('client.detail', [
            'client' => $client
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('client.edit', [
            'client' => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $rules = [
            'name' => 'required|unique:client,name,' . $client->id,
            'address' => 'required',
            'contact' => '',
            'image' => 'image|file|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'linkedin' => '',
            'instagram' => '',
            'website' => ''
        ];

        $customMessages = [
            'name.unique' => 'Perusahaan Klien Sudah Terdaftar.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return redirect()->route('clients.edit', $client)
                ->withErrors($validator)
                ->withInput();
        }

        // Pengambilan data user berdasarkan ID
        // $client = Client::find($client);

        // if (!$client) {
        //     return redirect()->route('clients.edit', $client)
        //         ->with('error', 'Client tidak ditemukan!');
        // }

        $validatedData = $validator->validated();

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('images');
        }

        $client->update($validatedData);

        return redirect('/clients')->with('update', 'Data Client Telah Berhasil Di Update!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        if ($client->image) {
            Storage::delete($client->image);
        }

        Client::destroy($client->id);
        return redirect('/clients')->with('delete', 'Data Client Telah Berhasil Di Hapus!!');
    }
}
