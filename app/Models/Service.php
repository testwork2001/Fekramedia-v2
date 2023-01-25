<?php

namespace App\Models;

use App\Models\Category;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['name', 'status', 'icon', 'detials', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

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


    public function processes()
    {
        return $this->belongsToMany(Process::class);
    }
}
