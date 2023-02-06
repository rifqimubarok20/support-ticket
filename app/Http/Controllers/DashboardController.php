<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Ticket;
use App\Models\Product;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->role === "admin") {
            $ticket = Ticket::all();
            $product = Product::all();
            $project = Project::all();
        } else if ($user->role === "programmer") {
            $ticket = Ticket::where('user_id', $user->id)->get();
            $product = Product::all();
            $project = Project::all();
        } else {
            $ticket = Ticket::where('client_id', $user->client_id)->with('client', 'product', 'user')->get();
            $product = Product::where('client_id', $user->client_id)->with('client')->get();
            $project = Project::where('client_id', $user->client_id)->with('client', 'product', 'documents')->get();
        }

        return view('dashboard', [
            'jml_client' => Client::all(),
            'jml_product' => $product,
            'jml_project' => $project,
            'jml_user' => User::all(),
            'jml_ticket' => $ticket,
        ]);
    }

}
