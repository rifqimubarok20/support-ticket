<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Client;
use App\Models\Product;
use App\Models\Project;
use App\Models\ProjectDocument;
use App\Models\Documents;

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
        $validated = $request->validate([
            'client_id' => 'required',
            'product_id' => 'required',
            'start_project' => '',
            'finish_project' => '',
        ]);

        $project = Project::create($validated);
        if ($project) {
            $message = 'Project berhasil dibuat!';
        } else {
            $message = 'Project gagal dibuat!';
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

    public function destroy(Project $project)
    {
        $project = Project::findOrFail($project);

        Project::destroy($project->id);
        return redirect('/projects')->with('success','Data Telah Berhasil Di Hapus!!');
    }
}
