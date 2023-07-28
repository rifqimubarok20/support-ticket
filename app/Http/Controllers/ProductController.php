<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === "admin" || $user->role === "programmer") {
            $product = Product::all();
        } else {
            $product = Product::where('client_id', $user->client_id)->with('client')->get();
        }

        return view('product.index', compact('product'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $client = Client::all();
        return view('product.tambah', [
            'kategori' => $kategori,
            'client' => $client,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|unique:product,nama,NULL,id,client_id,' . $request->client_id,
            'id_kategori' => 'required',
            'client_id' => 'required'
        ], [
            'nama.unique' => 'Klien Terkait Sudah Memiliki Produk Tersebut',
            'id_kategori.required' => 'Kategori tidak boleh kosong',
            'client_id.required' => 'Klien tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return redirect()->route('products.create')
                ->withErrors($validator)
                ->withInput();
        }

        $product = new Product();
        $product->nama = $request->nama;
        $product->id_kategori = $request->id_kategori;
        $product->client_id = $request->client_id;
        $product->save();
        return redirect()->route('products.index')
            ->with('success', 'Produk Berhasil di Tambahkan!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $kategori = Kategori::all();
        $client = Client::all();
        return view('product.edit', compact('product', 'kategori', 'client'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_kategori' => 'required',
        ], [
            'id_kategori.required' => 'Kategori tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return redirect()->route('products.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::findOrFail($id);

        // Cek apakah kategori berubah
        if ($product->id_kategori != $request->id_kategori) {
            $kategoriValidator = Validator::make($request->all(), [
                'nama' => [
                    'required',
                    Rule::unique('product')->where(function ($query) use ($product) {
                        return $query->where('client_id', $product->client_id);
                    })->ignore($id)
                ],
                'client_id' => 'required'
            ], [
                'nama.required' => 'Nama produk harus diisi.',
                'nama.unique' => 'Klien Terkait Sudah Memiliki Produk Tersebut',
                'client_id.required' => 'Klien tidak boleh kosong'
            ]);

            if ($kategoriValidator->fails()) {
                return redirect()->route('products.edit', $id)
                    ->withErrors($kategoriValidator)
                    ->withInput();
            }
        }
        // Update hanya jika kategori berubah
        if ($product->id_kategori != $request->id_kategori) {
            $product->id_kategori = $request->id_kategori;
            $product->save();
        }

        return redirect()->route('products.index')
            ->with('update', 'Produk Berhasil di Update!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')
            ->with('delete', 'Produk Berhasil di Hapus!');
    }
}
