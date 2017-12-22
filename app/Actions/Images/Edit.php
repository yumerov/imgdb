<?php

namespace App\Actions\Images;

use App\Image;

class Edit {

    public function handle(Image $image) {
        $template = "images.edit";
        $data = ['image' => $image];
        return view($template, $data);
    }
}