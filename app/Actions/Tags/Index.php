<?php

namespace App\Actions\Tags;

use App\Tag;

class Index {

    public function handle() {
        $template = "tags.index";
        $data = ['tags' => Tag::all()];
        return view($template, $data);
    }
}