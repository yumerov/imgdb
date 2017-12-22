<?php

namespace App\Actions\Tags;

use App\Tag;

class Edit {

    public function handle(Tag $tag) {
        $template = "tags.edit";
        $data = ['tag' => $tag];
        return view($template, $data);
    }
}