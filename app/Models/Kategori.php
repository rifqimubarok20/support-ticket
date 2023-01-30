<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    public $table = "kategori";

    protected $fillable = [
        'name',
    ];

    public function product()
    {
        return $this->hasMany('App\Models\Product', 'id_product');
    }


}
