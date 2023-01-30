<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDocument extends Model
{
    use HasFactory;

    public $table = "projectdocuments";

    protected $fillable = [
        'project_id',
        'document_id',
        'file'
    ];

    public function getPdfPathAttribute() 
    {
        return asset($this->file);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function document() {
        return $this->belongsTo(Documents::class);
    }
}
