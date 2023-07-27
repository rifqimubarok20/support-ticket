<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Ticket;
use App\Models\Product;
use App\Models\Project;
use App\Models\TicketStatus;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $client = Client::all();

        if (!$user) {
            return view('auth.login');
        }

        if ($user->role === "admin") {
            $ticket = Ticket::all();
            $product = Product::all();
            $project = Project::all();
            $programmerCount = 0;
            $clientCount = 0;
            $doneCount = 0;
        } else if ($user->role === "programmer") {
            $ticket = Ticket::where('user_id', $user->id)->with('ticketStatus')->get();
            $product = Product::all();
            $project = Project::all();
            $programmerCount = 0;
            $clientCount = 0;
            $doneCount = 0;

            foreach ($ticket as $tkt) {
                $latestStatus = $tkt->ticketStatus()->latest()->first();
                if ($latestStatus->status == 'on progress' || $latestStatus->status == 'testing') {
                    $programmerCount++;
                } elseif ($latestStatus->status == 'staging') {
                    $clientCount++;
                    $programmerCount - 1;
                } elseif ($latestStatus->status == 'done') {
                    $doneCount++;
                    $programmerCount - 1;
                }
            }
        } else if ($user->role === 'client') {
            if (!$user->client_id) {
                return view('auth.pilihUnit', compact('client'));
            }
            $ticket = Ticket::where('client_id', $user->client_id)->with('client', 'product', 'user', 'ticketStatus')->get();
            $product = Product::where('client_id', $user->client_id)->with('client')->get();
            $project = Project::where('client_id', $user->client_id)->with('client', 'product', 'documents')->get();
            $programmerCount = 0;
            $clientCount = 0;
            $doneCount = 0;

            foreach ($ticket as $tkt) {
                $latestStatus = $tkt->ticketStatus()->latest()->first();
                if ($latestStatus->status == 'on progress' || $latestStatus->status == 'testing') {
                    $programmerCount++;
                } elseif ($latestStatus->status == 'staging') {
                    $clientCount++;
                    $programmerCount - 1;
                }
            }
        }

        return view('dashboard', [
            'jml_client' => Client::all(),
            'jml_product' => $product,
            'jml_project' => $project,
            'jml_user' => User::all(),
            'jml_ticket' => $ticket,
            'programmerCount' => $programmerCount,
            'clientCount' => $clientCount,
            'doneCount' => $doneCount,
        ]);
    }

    public function pilihUnit(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if ($request->has('client_id')) {
            $request->validate([
                'client_id' => [
                    'required',
                    Rule::unique('users')->where(function ($query) use ($request) {
                        return $query->where('client_id', $request->client_id)
                            ->whereNull('deleted_at');
                    })->ignore($user->id),
                ],
            ], [
                'client_id.unique' => 'Pastikan pilih unit yang belum terpilih !'
            ]);
            $user->client_id = $request->client_id;
            $user->save();
        }

        return redirect()->route('dashboard');
    }
}
