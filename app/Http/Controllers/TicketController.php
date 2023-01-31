<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index() {
        $ticket = Ticket::with('product', 'client', 'user')->get();
        // dd($ticket);
        return view('ticket.index');
    }

    public function create()
    {
        return view('ticket.tambah');
    }

    public function pengajuan()
    {
        return view('ticket.pengajuan');
    }
}
