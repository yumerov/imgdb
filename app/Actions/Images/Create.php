<?php

namespace App\Actions\Images;

use App\Tag;

class Create {

    public function handle() {
        $template = "images.create";
        $data = ['tags' => Tag::select(['id', 'name'])->get()];
        return view($template, $data);
    }
}