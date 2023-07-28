<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Project;
use App\Models\Documents;
use Illuminate\Http\Request;
use App\Models\ProjectDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // $project = Project::where('client_id', $user->id)->with('client', 'product', 'documents')->get();

        if ($user->role === "admin") {
            $project = Project::all();
        } else {
            $project = Project::where('client_id', $user->client_id)->with('client', 'product', 'documents')->get();
        }

        return view('project.index', [
            'client' => Client::all(),
            'product' => Product::all(),
            'documents' => Documents::all(),
            'project' => $project
        ]);
    }

    public function create()
    {
        return view('project.index', [
            'project' => Project::all()
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required',
            'product_id' => 'required|unique:project,product_id,NULL,id,client_id,' . $request->client_id,
            'start_project' => '',
            'finish_project' => '',
        ], [
            'product_id.unique' => 'Project Pada Klien dan Produk Tersebut Sudah Ada',
            'client_id.required' => 'Klien Tidak Boleh Kosong'
        ]);

        if ($validator->fails()) {
            return redirect()->route('projects.index')
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();
        $project = Project::create($validatedData);
        if ($project) {
            $message = 'Project Berhasil di Buat!';
        } else {
            $message = 'Project Gagal di Buat!';
        }

        return redirect()->route('projects.index')
            ->with('success', $message);
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $project_id = $request->input('project_id');
        $document_id = $request->input('document_id');

        $path = Storage::putFile('documents', $file);

        // save file information to database
        $data = new ProjectDocument;
        $data->file = $path;
        $data->project_id = $project_id;
        $data->document_id = $document_id;
        $data->save();

        return redirect()->route('projects.index')
            ->with('success', 'File Berhasil Di Upload!');
    }

    public function showFile($id)
    {
        $pd = DB::table('projectdocuments')->where('id', $id)->first();
        return view('project.index', [
            'pd' => $pd
        ]);
    }

    public function edit(Project $project)
    {
        return view('project.index', [
            'project' => $project
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'start_project' => '',
            'finish_project' => '',
        ]);

        if ($validator->fails()) {
            return redirect()->route('projects.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();

        $project = Project::findOrFail($id);

        $project->update($validatedData);

        $message = 'Tanggal Project Berhasil diperbarui!';

        return redirect()->route('projects.index')
            ->with('success', $message);
    }

    public function destroy($id)
    {
        $projects = Project::findOrFail($id);

        $projects->delete();
        return redirect()->route('projects.index')
            ->with('delete', 'Data Telah Berhasil Di Hapus!!');
    }
}
