<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    public $table = 'documents';

    protected $fillable = [
        'name'
    ];

    public function project() {
        return $this->belongsToMany(Project::class, 'projectdocuments');
    }
}
