<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Ticket;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    public function index() {
        $ticket = Ticket::with('product', 'client', 'user')->get();
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

    public function store(Request $request)
    {
        $client_id = $request->input('client_id');
        $product_id = $request->input('product_id');
        $issue = $request->input('issue');
        $file = $request->file('file');

        $path = Storage::putFile('documents', $file);

        $ticket = new Ticket;
        $ticket->client_id = $client_id;
        $ticket->product_id = $product_id;
        $ticket->issue = $issue;
        $ticket->file = $path;
        $ticket->save();

        return redirect()->route('ticket.index')
            ->with('success', 'Ticket Berhasil Diupload!');
    }

    public function edit(Ticket $ticket)
    {
        return view('ticket.edit', [
            'ticket' => $ticket
        ]);
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validatedData = $request->validate([
            'client_id' => 'required',
            'product_id' => 'required',
            'issue' => 'required',
            'file' => 'image|file'
        ]);

        if($request->file('file')){
            $validatedData['file'] = $request->file('file')->store('documents');
        }

        Client::create($validatedData);

        return redirect()->route('ticket.index')
            ->with('success', 'Ticket Berhasil Diupdate!');
    }

    public function pengajuan()
    {
        return view('ticket.pengajuan');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return redirect()->route('ticket.index')
            ->with('success', 'Ticket berhasil dihapus!');
    }
}
