<?php

namespace App\Actions\Images;

use App\Image;
use App\Http\Resources\ImageResource;

class Index {

    public function handle() {
        $data = Image::orderBy("created_at", "desc")->paginate(12);
        return ImageResource::collection($data);
    }
}