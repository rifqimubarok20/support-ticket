<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Ticket;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index() {
        $user = auth()->user();
        
        if ($user->role === "admin") {
            $ticket = Ticket::all();
        } else {
            $ticket = Ticket::where('client_id', $user->client_id)->with('client', 'product', 'user')->get();
        }

        return view('ticket.index', compact('ticket'));
    }

    public function create()
    {
        $client = Client::all();
        $product = Product::all();

        return view('ticket.tambah', [
            'client' => $client,
            'product' => $product
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
