<?php

namespace App\Actions\Tags;

use App\Tag;

class Show {

    public function handle(Tag $tag) {
        $template = "tags.show";
        $data = ['tag' => $tag];
        return view($template, $data);
    }
}