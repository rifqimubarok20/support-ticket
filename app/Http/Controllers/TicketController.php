<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Client;
use App\Models\Ticket;
use App\Models\Product;
use App\Models\Project;
use App\Models\TicketStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class TicketController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === "admin") {
            $tickets = Ticket::with('ticketStatus')->get();
        } else if ($user->role === "programmer") {
            $tickets = Ticket::where('user_id', $user->id)->with('ticketStatus')->get();
        } else {
            $tickets = Ticket::where('client_id', $user->client_id)->with('client', 'product', 'user', 'ticketStatus')->get();
        }

        return view('ticket.index', [
            'ticket' => $tickets
        ]);
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
        $status = TicketStatus::where('ticket_id', $ticket->id)->orderBy('created_at', 'desc')->get();
        $getstatus = Ticket::with('ticketStatus')->get();
        return view('ticket.detail', [
            'ticket' => $ticket,
            'status' => $status,
            'getstatus' => $getstatus
        ]);
    }

    public function store(Request $request)
    {
        $product_id = $request->input('product_id');
        $client_id = $request->input('client_id');
        $issue = $request->input('issue');
        $file = $request->file('file');

        // $status = TicketStatus::firstOrCreate(['status' => 'to do']);

        $path = Storage::putFile('documents', $file);

        $ticket = new Ticket;
        $ticket->product_id = $product_id;
        $ticket->client_id = $client_id;
        $ticket->issue = $issue;
        $ticket->file = $path;

        // Generate a sequentially ordered ticket number (no_ticket)
        $lastTicket = Ticket::orderBy('id', 'desc')->first();
        $ticket->no_ticket = 'TICKET-' . str_pad($lastTicket ? $lastTicket->id + 1 : 1, 5, '0', STR_PAD_LEFT);

        $ticket->save();

        $status = new TicketStatus;
        $status->status = 'pending';
        $status->description = 'Harap Tunggu Admin akan Assign ke IT Teknisi';
        $status->ticket_id = $ticket->id;
        $status->save();

        return redirect()->route('ticket.index')
            ->with('success', 'Ticket Berhasil Diajukan, Harap tunggu!');
    }

    public function edit(Ticket $ticket)
    {
        $product = Product::all();
        $client = Client::all();
        $programmer = User::where('role', 'programmer')->get();
        $status = TicketStatus::where('ticket_id', $ticket->id)->get();

        return view('ticket.edit', [
            'product' => $product,
            'client' => $client,
            'ticket' => $ticket,
            'programmer' => $programmer,
            'status' => $status
        ]);
    }

    public function update(Request $request, Ticket $ticket)
    {
        $status = TicketStatus::firstOrCreate(['status' => 'to do', 'description' => 'IT Teknisi sudah ditentukan oleh Admin, Tiket akan segera dikerjakan.', 'ticket_id' => $ticket->id]);
        $status->ticket_id = $ticket->id;


        $user = auth()->user();
        if ($user->role === "admin") {
            $ticket->user_id = $request->user_id;
        }

        $ticket->save();

        return redirect()->route('ticket.index')
            ->with('success', 'Ticket Berhasil di Assign kepada Programmer');
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
        return redirect()->route('ticket.index')
            ->with('delete', 'Ticket berhasil di Hapus!');
    }

    public function download($id)
    {
        $data = DB::table('tickets')->where('id', $id)->first();
        $filepath = storage_path("app/public/{$data->file}");
        return \Response::download($filepath);
    }

    public function editStatus($id)
    {
        $ticket = Ticket::findOrFail($id);
        $product = Product::all();
        $client = Client::all();
        $status = TicketStatus::where('ticket_id', $ticket->id)->latest()->first();

        return view('ticket.status', [
            'product' => $product,
            'client' => $client,
            'ticket' => $ticket,
            'status' => $status,
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        // $ticket = Ticket::findOrFail($id);
        $status = new TicketStatus;
        $status->status = $request->status;
        $status->description = $request->description;
        $status->ticket_id = $request->ticket_id;
        $status->save();

        return redirect()->route('ticket.index')
            ->with('success', 'Status Berhasil Di Ubah!');
    }

    public function openTicket($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = 'open';
        $ticket->save();

        return redirect()->back()->with('success', 'Ticket Berhasil di Buka.');
    }

    public function closeTicket($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = 'close';
        $ticket->save();

        return redirect()->back()->with('success', 'Ticket Berhasil di Tutup.');
    }
}
