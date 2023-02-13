<?php

namespace App\Models;

use App\Events\UpdateTicketStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'description',
        'ticket_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($status) {
            event(new UpdateTicketStatus($status));
        });
    }

    const STATUS_OPTIONS = [
        'on progress' => 'On Progress',
        'testing' => 'Testing',
        'staging' => 'Staging',
        'done' => 'Done',
    ];

    public static function statusOptions()
    {
        return self::STATUS_OPTIONS;
    }
}
