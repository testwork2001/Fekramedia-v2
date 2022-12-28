<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'details', 'icon'];

    /**
     * Get an Admin status.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value == '1' ? ['bg-success', 'Active'] : ['bg-danger', 'Not Active'],
        );
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
