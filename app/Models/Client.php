<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $connection  = 'mysql2';
    public $table = "client";

    protected $fillable = [
        'name',
        'address',
        'contact',
        'image',
    ];

    public function project() {
        return $this->hasMany(Project::class);
    }
}
