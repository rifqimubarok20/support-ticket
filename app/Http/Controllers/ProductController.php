<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $user = auth()->user();
        
        if ($user->role === "admin" || $user->role === "programmer") {
            $product = Product::all();
        } else {
            $product = Product::where('client_id', $user->client_id)->with('client')->get();
        }

        return view('product.index', compact('product'));
    }

    public function create() {
        $kategori = Kategori::all();
        $client = Client::all();
        return view('product.tambah', [
            'kategori' => $kategori,
            'client' => $client,
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nama' => 'required',
            'id_kategori' => 'required',
            'client_id' => 'required'
        ], [
            'kategori.required' => 'Kategori tidak boleh kosong'
        ]);

        $product = new Product();
        $product->nama = $request->nama;
        $product->id_kategori = $request->id_kategori;
        $product->client_id = $request->client_id;
        $product->save();
        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dibuat!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $kategori = Kategori::all();
        $client = Client::all();
        return view('product.edit', compact('product', 'kategori', 'client'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'nama' => 'required',
            'id_kategori' => 'required',
            'client_id' => 'required'
        ], [
            'id_kategori.required' => 'Kategori tidak boleh kosong'
        ]);

        $product = Product::findOrFail($id);
        $product->nama = $request->nama;
        $product->id_kategori = $request->id_kategori;
        $product->client_id = $request->client_id;
        $product->save();
        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil di Update!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Dokumen berhasil di Hapus!');
    }
}
