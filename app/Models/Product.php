<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $table = "product";

    protected $fillable = [
        'nama',
    ];

    public function kategori() {
        return $this->belongsTo('App\Models\kategori', 'id_kategori');
    }

    public function project() {
        return $this->hasMany(Project::class);
    }
}
