<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['article', 'name', 'status', 'data'];


    public function scopeStatus($query)
    {
        return $query->where('status', '=', 'available');
    }

}
