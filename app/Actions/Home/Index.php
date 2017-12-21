<?php

namespace App\Actions\Home;

use App\Tag;
use App\Image;

class Index {

    public function handle() {
        $template = "index";
        $data = [
            'images' => Image::orderBy('created_at', 'desc')->take(4)->get(),
            'tags' => Tag::orderBy('created_at', 'desc')->take(10)->get(),
        ];
        return view($template, $data);
    }

}