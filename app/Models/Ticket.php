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
        'product_id',
        'client_id',
        'issue',
        'file',
        'user_id',
        'status_id',
        'expired_at'
    ];

    protected $dates = ['expired_at'];

    public function scopeExpired($query)
    {
        return $query->where('expired_at', '<', Carbon::now());
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function client() {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ticketStatus()
    {
        return $this->hasmany(TicketStatus::class, 'ticket_id');
    }
}
