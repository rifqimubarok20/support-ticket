<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'jml_client' => Client::all(),
            'jml_product' => Product::all(),
            'jml_project' => Project::all(),
            'jml_user' => User::all(),
        ]);
    }

}
