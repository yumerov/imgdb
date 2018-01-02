<?php

namespace App\Actions\Images;

use App\Image;
use App\Http\Resources\ImageResource;

class Show {

    public function handle(Image $image) {
        return new ImageResource($image);
    }
}