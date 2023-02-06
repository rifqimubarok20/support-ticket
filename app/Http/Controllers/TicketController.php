<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Client;
use App\Models\Ticket;
use App\Models\Product;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class TicketController extends Controller
{
    public function __construct()
    {
        Ticket::expired()->delete();
    }

    public function index()
    {
        $user = auth()->user();
        
        if ($user->role === "admin") {
            $ticket = Ticket::all();
        } else if ($user->role === "programmer") {
            $ticket = Ticket::where('user_id', $user->id)->get();
        } else {
            $ticket = Ticket::where('client_id', $user->client_id)->with('client', 'product', 'user')->get();
        }
        $labels = Ticket::whereDate('expired_at', '>', now())->get();
        
        return view('ticket.index', compact('ticket'));
    }

    public function create()
    {
        $user = auth()->user();
        $project = Project::where('client_id', $user->client_id)->with('client', 'product', 'documents')->get();
        $client = Client::all();

        return view('ticket.tambah', [
            'project' => $project,
            'client' => $client
        ]);
    }

    public function show(Ticket $ticket)
    {
        return view('ticket.detail', [
            'ticket' => $ticket
        ]);
    }

    public function store(Request $request)
    {
        $product_id = $request->input('product_id');
        $client_id = $request->input('client_id');
        $issue = $request->input('issue');
        $file = $request->file('file');

        $path = Storage::putFile('documents', $file);

        $ticket = new Ticket;
        $ticket->product_id = $product_id;
        $ticket->client_id = $client_id;
        $ticket->issue = $issue;
        $ticket->file = $path;
        $ticket->expired_at = Carbon::now()->addDays(2);
        $ticket->save();

        return redirect()->route('ticket.index')
            ->with('success', 'Ticket Berhasil Dibuat!');
    }

    public function edit(Ticket $ticket)
    {
        $product = Product::all();
        $client = Client::all();
        $programmer = User::where('role', 'programmer')->get();

        return view('ticket.edit', [
            'product' => $product,
            'client' => $client,
            'ticket' => $ticket,
            'programmer' => $programmer,
        ]);
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validatedData = $request->validate([
            'user_id' => '',
            'status' => '',
            'description' => '',
        ]);

        Ticket::where('id', $ticket->id)
            ->update($validatedData);

        return redirect()->route('ticket.index')
            ->with('success', 'Ticket Berhasil Di Update!');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return redirect()->route('ticket.index')
            ->with('success', 'Ticket berhasil di Hapus!');
    }

    public function download($id)
    {
        $data = DB::table('tickets')->where('id', $id)->first();
        $filepath = storage_path("app/public/{$data->file}");
        return \Response::download($filepath);
    }

}
