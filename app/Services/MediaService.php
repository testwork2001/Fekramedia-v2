<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

trait MediaService
{
    public function changeMedia(string $collection)
    {
        $media = $this->getMedia($collection);
        foreach ($media as $index => $img) {
            $img->delete();
        }
        $this->addMediaFromRequest('image')->toMediaCollection($collection);
        return $this;
    }
}
