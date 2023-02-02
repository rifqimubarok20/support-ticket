<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Client;
use App\Models\Ticket;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{

    public function __construct()
    {
        Ticket::expired()->delete();
    }

    public function index()
    {
        $ticket = Ticket::with('product', 'client', 'user')->get();
        $labels = Ticket::whereDate('expired_at', '>', now()->subDays(2))->get();
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
        $ticket->expired_at = Carbon::now()->addDays(2);
        $ticket->save();

        return redirect()->route('ticket.index')
            ->with('success', 'Ticket Berhasil Diupload!');
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

        // if($request->file('file')){
        //     if($request->oldFile) {
        //         Storage::delete($request->oldFile);
        //     }
        //     $validatedData['file'] = $request->file('file')->store('documents');
        // }

        Ticket::where('id', $ticket->id)
            ->update($validatedData);

        return redirect()->route('ticket.index')
            ->with('success', 'Ticket Berhasil Diupdate!');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return redirect()->route('ticket.index')
            ->with('success', 'Ticket berhasil dihapus!');
    }

    public function download($id)
    {
        $data = DB::table('tickets')->where('id', $id)->first();
        $filepath = storage_path("app/public/{$data->file}");
        return \Response::download($filepath);
    }

}
