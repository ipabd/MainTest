<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['ARTICLE', 'NAME', 'STATUS', 'DATA'];


    public function scopeStatus($query)
    {
        return $query->where('STATUS', '=', 'available');
    }

}
