<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public $table = "project";

    protected $fillable = [
        'client_id',
        'product_id',
        'start_project',
        'finish_project'
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function documents() {
        return $this->belongsToMany(Documents::class, 'projectdocuments', 'project_id', 'document_id')->withPivot('file');
    }
}
