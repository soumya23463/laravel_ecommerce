<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function brands()
    {
        return $this->hasMany(Product::class);
    }
}