<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $product = Product::all();
        return view('product.index', compact('product'));
    }

    public function create() {
        $kategori = Kategori::all();
        return view('product.tambah', compact('kategori'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
        ], [
            'kategori.required' => 'Kategori tidak boleh kosong'
        ]);

        $product = new Product();
        $product->nama = $request->nama;
        $product->id_kategori = $request->kategori;
        $product->save();
        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dibuat!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $kategori = Kategori::all();
        return view('product.edit', compact('product', 'kategori'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'nama' => 'required',
            'kategori' => 'required',
        ], [
            'kategori.required' => 'Kategori tidak boleh kosong'
        ]);

        $product = Product::findOrFail($id);
        $product->nama = $request->nama;
        $product->id_kategori = $request->kategori;
        $product->save();
        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dibuat!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Dokumen berhasil dihapus!');
    }
}
