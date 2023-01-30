<?php

namespace App\Http\Controllers;

use App\Models\Documents;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function index() {
        $documents = Documents::all();
        
        return view('documents.index', [
            'documents' => $documents
        ]);
    }

    public function create() {
        return view('documents.tambah');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $documents = Documents::create($validatedData);
        if ($documents) {
            $message = 'Dokumen Berhasil Ditambahkan!';
        } else {
            $message = 'Dokumen Gagal Ditambahkan!';
        }

        return redirect('/documents')->with('success', $message);
    }

    public function edit($id)
    {
        $documents = Documents::findOrFail($id);
        return view('documents.edit', compact('documents'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $documents = Documents::findOrFail($id);
        $documents->name = $request->name;
        $documents->save();
        return redirect()->route('documents.index')
            ->with('success', 'Dokumen berhasil diupdate!');
    }

    public function destroy($id)
    {
        $documents = Documents::findOrFail($id);
        $documents->delete();
        return redirect()->route('documents.index')
            ->with('success', 'Dokumen berhasil dihapus!');
    }
}
