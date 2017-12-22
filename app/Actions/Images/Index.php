<?php

namespace App\Actions\Images;

use App\Image;

class Index {

    public function handle() {
        $template = "images.index";
        $data = ['images' => Image::orderBy("created_at", "desc")->paginate(12)];
        return view($template, $data);
    }
}