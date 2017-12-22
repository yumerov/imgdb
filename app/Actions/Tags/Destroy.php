<?php

namespace App\Actions\Tags;

use App\Tag;

class Destroy {

    public function handle(Tag $tag) {
        $tag->delete();

        return redirect()->route("tags.index")
            ->with("success", "The tag is deleted.");

    }
}