<?php

namespace App\Actions\Images;

use App\Image;
use App\Tag;

class Edit {

    public function handle(Image $image) {
        $template = "images.edit";
        $data = [
            'image' => $image,
            'selected_tags' => $image->tags->map(function ($tag) {
                return $tag->id;
            })->toArray(),
            'tags' => Tag::select(['id', 'name'])->get()
        ];
        // dd($data);
        return view($template, $data);
    }
}