<?php

namespace App\Actions\Images;

use App\Image;

class Destroy {

    public function handle(Image $image) {
        \File::delete(public_path("/img/" . $image->file));
        $image->delete();

        return response()->json();
    }
}