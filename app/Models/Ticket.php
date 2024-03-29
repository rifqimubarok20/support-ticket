<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_ticket',
        'product_id',
        'client_id',
        'issue',
        'file',
        'user_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ticketStatus()
    {
        return $this->hasMany(TicketStatus::class, 'ticket_id');
    }
}
