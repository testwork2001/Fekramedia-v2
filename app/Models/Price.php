<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Price extends Model
{
    use HasFactory;

    protected $table = "pricing";
    
    protected $fillable = ['name', 'status', 'price', 'icon', 'features', 'slug'];

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value == '1' ? ['bg-success', 'Active'] : ['bg-danger', 'Not Active'],
        );
    }
}
