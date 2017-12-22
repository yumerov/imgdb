<?php

namespace App\Actions\Images;

use App\Image;

class Show {

    public function handle(Image $image) {
        $template = "images.show";
        $data = ['image' => $image];
        return view($template, $data);
    }
}